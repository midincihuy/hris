<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;
use Excel;
use DB;
use Session;
use App\Contract;
use App\DataTables\ContractsDataTable;
use App\Events\Event;
use Auth;
class ContractsController extends Controller
{
  public function index(ContractsDataTable $dataTable)
  {
      // return view('admin.contracts.index');
      return $dataTable->render('admin.contracts.index');
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
                    \Log::info($row);
                    $exist = Contract::where('nik',$row['nik'])->first();
                    if($exist){
                      // update data here
                      $exist->update($row);
                      $contract = $exist;
                    }else{
                      // insert data here
                      $contract = Contract::firstOrCreate($row);
                    }
                    event(new Event($contract));
                }
              })->get();
              return back();

          }else {
              Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
              return back();
          }
      }
  }
}
