<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;
use Excel;
use DB;
use Session;
use App\Contract;
use App\DataTables\DraftContractsDataTable;
use App\Events\Event;
use Auth;
use Illuminate\Support\Facades\Gate;


class DraftContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DraftContractsDataTable $dataTable)
    {
        return $dataTable->render('admin.draft_contracts.index');
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
        if (! Gate::allows('draft_contracts_manage')) {
            return abort(401);
        }
        $contract = Contract::findOrFail($id);
        return view('admin.draft_contracts.edit', compact('contract'));
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
        if (! Gate::allows('draft_contracts_manage')) {
            return abort(401);
        }
        $contract = Contract::findOrFail($id);
        $contract->fill($request->all());
        $contract->fill([
            'employee_status' => 'KK',
            'status_active' => 'Aktif',
        ]);
  
        $contract->save();
  
        return redirect()->route('admin.contracts.index');
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
}
