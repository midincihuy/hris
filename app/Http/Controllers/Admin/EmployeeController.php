<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contract;
use App\DataTables\EmployeeDataTable;

use Illuminate\Support\Facades\Gate;

use App\Reference;

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
    public function edit($id)
    {
      if (! Gate::allows('contracts_manage')) {
            return abort(401);
        }
        $contract = Contract::findOrFail($id);
        $data['employee_status'] = Reference::where('code','EMPLOYEE_STATUS')->orderBy('sort')->get()->pluck('item','value');
        $data['status_active'] = Reference::where('code','STATUS_ACTIVE')->orderBy('sort')->get()->pluck('item','value');
        $data['reminder_status'] = Reference::where('code','REMINDER_STATUS')->orderBy('sort')->get()->pluck('item','value');

        return view('admin.employee.edit', compact('contract', 'data'));
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
      $contract->update($request->all());
      // $roles = $request->input('roles') ? $request->input('roles') : [];
      // $user->syncRoles($roles);

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
}
