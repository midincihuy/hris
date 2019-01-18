<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;
use Excel;
use DB;
use Session;
use App\Recruitment;
use App\DataTables\RecruitmentsDataTable;
use App\Events\Event;
use Auth;

use App\Reference;

use Illuminate\Support\Facades\Gate;

class RecruitmentsController extends Controller
{
  public function index(RecruitmentsDataTable $dataTable)
  {
      return $dataTable->render('admin.recruitments.index');
  }

  public function edit($id)
  {
    if (! Gate::allows('recruitments_manage')) {
        return abort(401);
    }
    $recruitment = Recruitment::findOrFail($id);
    $jenis_ptk = Reference::where('code','JENIS_PTK')->orderBy('sort')->get()->pluck('item','value');
    $status_recruitment = Reference::where('code','STATUS_RECRUITMENT')->orderBy('sort')->get()->pluck('item','value');
    return view('admin.recruitments.edit', compact('recruitment','jenis_ptk', 'status_recruitment'));
  }

  public function show($id)
  {
    if (! Gate::allows('recruitments_manage')) {
        return abort(401);
    }
    $recruitment = Recruitment::findOrFail($id);
    return view('admin.recruitments.view', compact('recruitment'));
  }

  public function update(Request $request, $id)
  {
    if (! Gate::allows('recruitments_manage')) {
        return abort(401);
    }
    $username = Auth::user()->name;

    $recruitment = Recruitment::findOrFail($id);
    $recruitment->fill($request->all());
    $recruitment->updated_by = $username;
    $recruitment->save();

    return redirect()->route('admin.recruitments.index');
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_ptk = Reference::where('code','JENIS_PTK')->orderBy('sort')->get()->pluck('item','value');
        $status_recruitment = Reference::where('code','STATUS_RECRUITMENT')->orderBy('sort')->get()->pluck('item','value');
        return view('admin.recruitments.create', compact('jenis_ptk', 'status_recruitment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('recruitments_manage')) {
            return abort(401);
        }
        $username = Auth::user()->name;

        $recruitment = new Recruitment();
        $recruitment->fill($request->all());
        $recruitment->created_by = $username;
        $recruitment->updated_by = $username;
        $recruitment->save();

        return redirect()->route('admin.recruitments.index');
    }

    public function create_contract($id)
    {
        if (! Gate::allows('recruitments_manage')) {
            return abort(401);
        }
        $recruitment = Recruitment::findOrFail($id);
        return view('admin.recruitments.create_contract', compact('recruitment'));
    }

    public function store_contract(Request $request)
    {
        if (! Gate::allows('recruitments_manage')) {
            return abort(401);
        }
        //  save contract from recruitments
        return redirect()->route('admin.recruitments.index');
    }
}
