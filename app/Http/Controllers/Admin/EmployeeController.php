<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contract;
use App\DataTables\EmployeeDataTable;
use App\DataTables\FamilyDataTable;

use Illuminate\Support\Facades\Gate;

use App\Reference;
use App\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeeDataTable $dataTable)
    {
      $data['employee_status'] = Reference::where('code','EMPLOYEE_STATUS')->orderBy('sort')->get()->pluck('item','value');
      $data['status_active'] = Reference::where('code','STATUS_ACTIVE')->orderBy('sort')->get()->pluck('item','value');
      $data['reminder_status'] = Reference::where('code','REMINDER_STATUS')->orderBy('sort')->get()->pluck('item','value');

      return $dataTable->render('admin.employee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyDataTable $dataTable, $id)
    {
      if (! Gate::allows('contracts_manage')) {
            return abort(401);
        }
        $contract = Contract::findOrFail($id);
        $data['employee_status'] = Reference::where('code','EMPLOYEE_STATUS')->orderBy('sort')->get()->pluck('item','value');
        $data['status_active'] = Reference::where('code','STATUS_ACTIVE')->orderBy('sort')->get()->pluck('item','value');
        $data['reminder_status'] = Reference::where('code','REMINDER_STATUS')->orderBy('sort')->get()->pluck('item','value');

        $employee = Employee::where('contract_id', $id)->first();
        // return view('admin.employee.edit', compact('contract', 'data'));
        return $dataTable->with('employee_id',$employee->id)->render('admin.employee.edit', compact('contract', 'data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (! Gate::allows('contracts_manage')) {
          return abort(401);
      }
      $contract = Contract::findOrFail($id);
      $contract->fill($request->all());

      $contract->save();

      return redirect()->route('admin.employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function mass_update(Request $request)
    {
      if($request->update_nik !== null){
        $niks = explode(',',$request->update_nik);

        foreach($niks as $nik){
          $data = Contract::where('nik', $nik)->first();
          $data->employee_status  = $request->employee_status;
          $data->status_active    = $request->status_active;
          $data->reminder_hr      = $request->reminder_hr;
          $data->reminder_user    = $request->reminder_user;
          $data->save();
        }
        return redirect()->back()->with('message', 'Successfully Update Data');
      }else{
        return redirect()->back()->with('error', 'No Data Selected');
      }
    }

    public function detail($id)
    {
        $contract = Contract::findOrFail($id);
        $employee = Employee::where('contract_id',$contract->id)->first();
        $data['golongan']         = Reference::where('code','GOLONGAN')->orderBy('sort')->get()->pluck('item','value');
        $data['kelas']            = Reference::where('code','KELAS')->orderBy('sort')->get()->pluck('item','value');
        $data['status_karyawan']  = Reference::where('code','STATUS_KARYAWAN')->orderBy('sort')->get()->pluck('item','value');
        $data['lokasi_kerja']     = Reference::where('code','LOKASI_KERJA')->orderBy('sort')->get()->pluck('item','value');
        $data['status_pajak']     = Reference::where('code','STATUS_PAJAK')->orderBy('sort')->get()->pluck('item','value');
        $data['plan_asuransi']    = Reference::where('code','PLAN_ASURANSI')->orderBy('sort')->get()->pluck('item','value');
        $data['resign_cause']     = Reference::where('code','RESIGN_CAUSE')->orderBy('sort')->get()->pluck('item','value');
        return view('admin.employee.detail', compact('contract', 'employee', 'data'));
    }

    public function update_detail(Request $request, $id)
    {
        // return $request;
        $contract = Contract::findOrFail($id);
        $employee = Employee::where('contract_id',$contract->id)->first();
        $employee->fill($request->all());
        $employee->save();
        // return $employee;
        return redirect()->route('admin.employee.index');
    }

    public function detailemployee($id)
    {
      $contract = Contract::findOrFail($id);
      $employee = Employee::where('contract_id',$contract->id)->first();
      $data['golongan']         = Reference::where('code','GOLONGAN')->orderBy('sort')->get()->pluck('item','value');
      $data['kelas']            = Reference::where('code','KELAS')->orderBy('sort')->get()->pluck('item','value');
      $data['status_karyawan']  = Reference::where('code','STATUS_KARYAWAN')->orderBy('sort')->get()->pluck('item','value');
      $data['lokasi_kerja']     = Reference::where('code','LOKASI_KERJA')->orderBy('sort')->get()->pluck('item','value');
      $data['status_pajak']     = Reference::where('code','STATUS_PAJAK')->orderBy('sort')->get()->pluck('item','value');
      $data['plan_asuransi']    = Reference::where('code','PLAN_ASURANSI')->orderBy('sort')->get()->pluck('item','value');
      $data['resign_cause']     = Reference::where('code','RESIGN_CAUSE')->orderBy('sort')->get()->pluck('item','value');
      return view('admin.employee.detailemployee', compact('contract', 'employee', 'data'));
    }

    public function resign($id)
    {
      $contract = Contract::findOrFail($id);
      $employee = $contract->employee;
      $data['resign_cause']     = Reference::where('code','RESIGN_CAUSE')->orderBy('sort')->get()->pluck('item','value');
      return view('admin.employee.resign', compact('employee', 'contract', 'data'));
    }

    public function store_resign(Request $request, $id)
    {
      $employee = Contract::findOrFail($id)->employee;
      $employee->fill($request->all());
      $employee->save();
      return redirect(route('admin.employee.edit',$id));
    }
}
