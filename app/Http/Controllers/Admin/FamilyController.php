<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Reference;
use App\Family;
use App\Employee;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // return $id;
        $employee = Employee::findOrFail($id);
        $hubungan_keluarga = Reference::where('code','HUBUNGAN_KELUARGA')->orderBy('sort')->get()->pluck('item','value');
        return view('admin.families.create', compact('hubungan_keluarga', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $employee)
    {
        $family = new Family();

        $family->fill($request->all());
        $family->employee_id = $employee;
        $family->save();
        return redirect(route('admin.employee.edit', $employee));
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
    public function edit($employee_id, $family_id)
    {
        $hubungan_keluarga = Reference::where('code','HUBUNGAN_KELUARGA')->orderBy('sort')->get()->pluck('item','value');
        $family = Family::findOrFail($family_id);
        return view('admin.families.edit', compact('hubungan_keluarga', 'employee_id', 'family'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employee, $family)
    {
        $family = Family::findOrFail($family);

        $family->fill($request->all());
        $family->employee_id = $employee;
        $family->save();

        return redirect(route('admin.employee.edit', $employee));
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
