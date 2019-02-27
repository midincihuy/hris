<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;
use Excel;
use DB;
use Session;
use App\Contract;
use App\DataTables\ContractsDataTable;
use App\Events\Event;
use Auth;

use App\Reference;
use App\Employee;

use Illuminate\Support\Facades\Gate;

class ContractsController extends Controller
{
  public function index(ContractsDataTable $dataTable)
  {
      // return view('admin.contracts.index');
      return $dataTable->render('admin.contracts.index');
  }
  public function import(Request $request){
      //validate the xls file
      $this->validate($request, array(
          'file'      => 'required'
      ));
      if($request->hasFile('file')){
          $extension = File::extension($request->file->getClientOriginalName());
          if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
            $username = Auth::user()->name;
              $path = $request->file->getRealPath();
              $data = Excel::load($path, function($reader) use ($username){
                foreach ($reader->toArray() as $row) {
                    $row['upload_by'] = $username;
                    \Log::info($row);
                    $contract = Contract::firstOrNew(['nik' => $row['nik']]);
                    $contract->fill($row);
                    $contract->save();
                }
              })->get();
              return back();

          }else {
              Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
              return back();
          }
      }
  }

  public function edit($id)
  {
    if (! Gate::allows('contracts_manage')) {
          return abort(401);
      }
      $contract = Contract::findOrFail($id);
      $data['employee_status'] = Reference::where('code','EMPLOYEE_STATUS')->orderBy('sort')->get()->pluck('item','value');
      $data['status_active'] = Reference::where('code','STATUS_ACTIVE')->orderBy('sort')->get()->pluck('item','value');
      $data['reminder_status'] = Reference::where('code','REMINDER_STATUS')->orderBy('sort')->get()->pluck('item','value');
      return view('admin.contracts.edit', compact('contract','data'));
  }

  public function update(Request $request, $id)
  {
    if (! Gate::allows('contracts_manage')) {
        return abort(401);
    }
    $contract = Contract::findOrFail($id);
    $contract->update($request->all());

    return redirect()->route('admin.contracts.index');
  }

  public function renew($id)
  {
      $contract = Contract::findOrFail($id);
      $contract_type = Reference::where('code','JENIS_KONTRAK')->orderBy('sort')->get()->pluck('item','value');
      $contract_duration = Reference::where('code','JANGKA_WAKTU')->orderBy('sort')->get()->pluck('item','value');
      return view('admin.contracts.renew', compact('contract', 'contract_type', 'contract_duration'));
  }

  public function renew_store(Request $request, $id)
  {
        $old_contract = Contract::findOrFail($id)->toArray();

        // save contract from recruitments
        $contract = new Contract();
        $contract->fill($old_contract);
        $contract->fill($request->all());
        $contract->save();

        $employee = Employee::where('contract_id', $id)->first();
        $employee->contract_id = $contract->id;
        $employee->save();
        

        return redirect()->route('admin.contracts.index');
  }
}
