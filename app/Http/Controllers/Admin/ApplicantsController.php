<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;
use Excel;
use DB;
use Session;
use App\Applicant;
use App\DataTables\ApplicantsDataTable;
use App\Events\Event;
use Auth;

use App\Reference;

use Illuminate\Support\Facades\Gate;

class ApplicantsController extends Controller
{
  public function index(ApplicantsDataTable $dataTable)
  {
      return $dataTable->render('admin.applicants.index');
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
                    unset($row[0]);
                    \Log::info($row);
                    $exist = Applicant::where('id_pelamar',$row['id_pelamar'])->first();
                    if($exist){
                      // update data here
                      $exist->update($row);
                      $applicant = $exist;
                    }else{
                      // insert data here
                      $applicant = Applicant::firstOrCreate($row);
                    }
                    // event(new Event($applicant));
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
    if (! Gate::allows('applicants_manage')) {
          return abort(401);
      }
      $applicant = Applicant::findOrFail($id);
      $data['employee_status'] = Reference::where('code','EMPLOYEE_STATUS')->orderBy('sort')->get()->pluck('item','value');
      $data['status_active'] = Reference::where('code','STATUS_ACTIVE')->orderBy('sort')->get()->pluck('item','value');
      $data['reminder_status'] = Reference::where('code','REMINDER_STATUS')->orderBy('sort')->get()->pluck('item','value');
      return view('admin.applicants.edit', compact('applicant','data'));
  }

  public function show($id)
  {
    if (! Gate::allows('applicants_manage')) {
        return abort(401);
    }
    $applicant = Applicant::findOrFail($id);
    return view('admin.applicants.view', compact('applicant'));
  }

  public function update(Request $request, $id)
  {
    if (! Gate::allows('applicants_manage')) {
        return abort(401);
    }
    $applicant = Applicant::findOrFail($id);
    $applicant->update($request->all());

    return redirect()->route('admin.applicants.index');
  }

  public function recruit($id)
  {
    $applicant = Applicant::findOrFail($id);
    $jenis_ptk = Reference::where('code','JENIS_PTK')->orderBy('sort')->get()->pluck('item','value');
    $status_recruitment = Reference::where('code','STATUS_RECRUITMENT')->orderBy('sort')->get()->pluck('item','value');
    return view('admin.applicants.recruit', compact('applicant', 'jenis_ptk', 'status_recruitment'));
  }
}
