<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use App\DataTables\SchedulersDataTable;
use App\Scheduler;

class SchedulersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SchedulersDataTable $dataTable)
    {
      return $dataTable->render('admin.schedulers.index');        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = array('0' => 'Inactive','1' => 'Active');

        return view('admin.schedulers.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('schedulers_manage')) {
            return abort(401);
        }
        Scheduler::create($request->all());

        return redirect()->route('admin.schedulers.index');
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
        if (! Gate::allows('schedulers_manage')) {
            return abort(401);
        }
        $scheduler = Scheduler::findOrFail($id);
        $status = array('0' => 'Inactive','1' => 'Active');
        return view('admin.schedulers.edit', compact('scheduler', 'status'));
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
        if (! Gate::allows('schedulers_manage')) {
            return abort(401);
        }
        $scheduler = Scheduler::findOrFail($id);
        $scheduler->update($request->all());
  
        return redirect()->route('admin.schedulers.index');
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
