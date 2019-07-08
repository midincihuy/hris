<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contract;
use App\DataTables\EmployeeDataTable;
use App\DataTables\FamilyDataTable;
use App\DataTables\SkDataTable;
use App\DataTables\EmployeeContractDataTable;

use Illuminate\Support\Facades\Gate;

use App\Reference;
use App\Employee;
use App\Position;
use App\Sk;

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
        $data['employee_status'] = Reference::where('code','EMPLOYEE_STATUS')->orderBy('sort')->get()->pluck('item','value');
        $data['status_active'] = Reference::where('code','STATUS_ACTIVE')->orderBy('sort')->get()->pluck('item','value');
        $data['reminder_status'] = Reference::where('code','REMINDER_STATUS')->orderBy('sort')->get()->pluck('item','value');

        $employee = Employee::findOrFail($id);
        $contract = $employee->contract->first();
        // return view('admin.employee.edit', compact('contract', 'data'));
        $documents = $employee->documents;
        return $dataTable->with('employee_id',$employee->id)->render('admin.employee.edit', compact('employee', 'contract', 'data', 'documents'));

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
      $employee = Employee::findOrFail($id);
      
      $contract = $employee->contract;
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
        $nips = explode(',',$request->update_nik);

        foreach($nips as $nip){
          $data = Contract::where('nip', $nip)->first();
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
        $employee = Employee::findOrFail($id);
        $contract = $employee->contract->first();
        $data['golongan']         = Reference::where('code','GOLONGAN')->orderBy('sort')->get()->pluck('item','value');
        $data['kelas']            = Reference::where('code','KELAS')->orderBy('sort')->get()->pluck('item','value');
        $data['status_karyawan']  = Reference::where('code','STATUS_KARYAWAN')->orderBy('sort')->get()->pluck('item','value');
        $data['lokasi_kerja']     = Reference::where('code','LOKASI_KERJA')->orderBy('sort')->get()->pluck('item','value');
        $data['status_pajak']     = Reference::where('code','STATUS_PAJAK')->orderBy('sort')->get()->pluck('item','value');
        $data['plan_asuransi']    = Reference::where('code','PLAN_ASURANSI')->orderBy('sort')->get()->pluck('item','value');
        $data['resign_cause']     = Reference::where('code','RESIGN_CAUSE')->orderBy('sort')->get()->pluck('item','value');
        $data['list_employee'] = Employee::where('id','<>',$id)->pluck('nama', 'nik')->toArray();
        return view('admin.employee.detail', compact('contract', 'employee', 'data'));
    }

    public function update_detail(Request $request, $id)
    {
        // return $request;
        $employee = Employee::findOrFail($id);
        $employee->fill($request->all());
        $employee->save();
        // return $employee;
        return redirect()->route('admin.employee.edit', $id);
    }

    public function detailemployee($id)
    {
      $employee = Employee::findOrFail($id);
      $contract = $employee->contract->first();
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
      $employee = Employee::findOrFail($id);
      $contract = $employee->contract->first();
      $data['resign_cause']     = Reference::where('code','RESIGN_CAUSE')->orderBy('sort')->get()->pluck('item','value');
      return view('admin.employee.resign', compact('employee', 'contract', 'data'));
    }

    public function store_resign(Request $request, $id)
    {
      $employee = Employee::findOrFail($id);
      $employee->fill($request->all());
      

      // Do Nonaktif Employee
      // $employee->employee_status = "Resign";
      $employee->status_active = "Resign";

      $employee->save();

      return redirect(route('admin.employee.edit',$id));
    }

    public function sk(SkDataTable $dataTable, $id)
    {
      $employee = Employee::findOrFail($id);
      $contract = $employee->contract->first();
      $position = Position::all();
      
      $data['list_jabatan'] = Position::list_position();
      $data['jenis_surat'] = Reference::where('code','JENIS_SK')->orderBy('sort')->get()->pluck('item','value');
      return $dataTable->render('admin.employee.sk', compact('employee', 'contract', 'data'));
    }

    public function store_sk(Request $request, $id)
    {
      $employee = Employee::findOrFail($id);

      $sk = new Sk();
      $sk->fill($request->all());
      $sk->employee_id = $id;
      $sk->position_id = $employee->position_id;
      $sk->save();

      $employee->position_id = $request->input('jabatan');
      $employee->save();

      return redirect(route('admin.employee.edit',$id));
    }

    public function contract(EmployeeContractDataTable $dataTable, $id)
    {
      $employee = Employee::findOrFail($id);
      $contract = $employee->contract->first();
      $position = Position::all();
      
      $data['list_jabatan'] = Position::list_position();
      $data['jenis_kontrak'] = Reference::where('code','JENIS_KONTRAK')->orderBy('sort')->get()->pluck('item','value');
      return $dataTable->with('employee_id', $id)->render('admin.employee.contract', compact('employee', 'contract', 'data'));
    }

    public function store_contract(Request $request, $id)
    {
      $employee = Employee::findOrFail($id);
      $old_contract = Contract::findOrFail($employee->contract_id);

      // save contract from recruitments
      $contract = new Contract();
      $contract->fill($request->all());
      $contract->employee_id = $id;
      
      // Fill Contract Detail From Old Contract
      $contract->name = $old_contract->name;
      $contract->employee_status = $old_contract->employee_status;
      $contract->status_active = $old_contract->employee_status;
      $contract->position_id = $old_contract->position_id;
      $contract->save();

      
      $employee->contract_id = $contract->id;
      $employee->save();
      return redirect(route('admin.employee.edit',$id));
    }
}
