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
}
