<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DataTables\DivisionDepartmentsDataTable;
use App\Division;
use App\Department;

class DivisionDepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        $division_id, 
        DivisionDepartmentsDataTable $dataTable)
    {
        $division = Division::findOrFail($division_id);
        return $dataTable->with('division_id', $division_id)->render('admin.divisions_departments.index', compact('division'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($division_id)
    {
        return view('admin.divisions_departments.create', compact('division_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $division_id)
    {
        $department = new Department();
        $department->fill($request->all());
        $department->division_id = $division_id;
        $department->save();

        return redirect()->route('admin.divisions.departments.index', $division_id);
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
        //
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
        $department = Department::findOrFail($id);
        $department->fill($request->all());
        $department->save();

        return redirect(route('admin.divisions.departments.index', $department->division->id, $department->id));
        
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
