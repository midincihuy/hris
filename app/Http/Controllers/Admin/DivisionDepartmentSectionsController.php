<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\DivisionDepartmentSectionsDataTable;
use App\Department;
use App\Section;
class DivisionDepartmentSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        $division_id,
        $department_id,
        DivisionDepartmentSectionsDataTable $dataTable
    )
    {
        $department = Department::findOrFail($department_id);
        return $dataTable->with('department_id', $department_id)->render('admin.divisions_departments_sections.index', compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($division_id, $department_id)
    {
        return view('admin.divisions_departments_sections.create', compact('division_id','department_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $division_id, $department_id)
    {
        $section = new Section();
        $section->name = $request->name;
        $section->department_id = $department_id;
        $section->save();

        return redirect()->route('admin.divisions.departments.sections.index', [$division_id, $department_id]);
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
    public function edit($division_id, $department_id, $section_id)
    {
        $section = Section::findOrFail($section_id);
        return view('admin.divisions_departments_sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $division_id, $department_id, $section_id)
    {
        $section = Section::findOrFail($section_id);
        $section->fill($request->all());
        $section->save();
        
        return redirect(route('admin.divisions.departments.sections.index', [$division_id, $department_id]));
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
