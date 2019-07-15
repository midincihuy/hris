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
use File;
use Excel;
use Auth;
use Session;

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

      // Do Nonaktif Contract
      $contract = Contract::find($employee->contract_id);
      $contract->status_active = "Resign";
      $contract->save();

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

    public function import(Request $request)
    {
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
                $position = Position::where('name', $row['jabatan'])
                ->whereHas('division', function($query) use ($row){
                    $query->where('company', $row['company']);
                })
                ->first();
                $data = [
                    'nip' => $row['nip'],
                    'nama' => $row['nama'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tanggal_lahir' => $row['tanggal_lahir']->toDateString(),
                    'pendidikan_terakhir' => $row['pendidikan_terakhir'],
                    'agama' => $row['agama'],
                    'golongan_darah' => $row['gol._darah'],
                    'nik' => $row['nik'],
                    'no_kk' => $row['kk'],
                    'no_bpjs_ketenagakerjaan' => $row['bpjstk'],
                    'no_bpjs_kesehatan' => $row['bpjs_kesehatan'],
                    'no_npwp' => $row['npwp'],
                    'no_rek_bca' => $row['no_rek_bca'],
                    'kelas' => $row['kelas'],
                    'status_karyawan' => $row['status_karyawan'],
                    'lokasi_kerja' => $row['lokasi_kerja'],
                    'status_kawin' => $row['status_kawin'],
                    'status_pajak' => $row['status_pajak'],
                    'kode_faskes_tk_1' => $row['kode_faskes_tk_i'] != '' ? $row['kode_faskes_tk_i'] : '-',
                    'faskes_tk_1' => $row['faskes_tk_i'] != '' ? $row['faskes_tk_i'] : '-',
                    'plan_asuransi' => $row['plan_asuransi'] != '' ? $row['plan_asuransi'] : '-',
                    'alamat' => $row['alamat'],
                    'alamat_ktp' => $row['alamat'],
                    'rt' => $row['rt'],
                    'rw' => $row['rw'],
                    'kelurahan' => $row['kelurahan'] != '' ? $row['kelurahan'] : '-',
                    'kecamatan' => $row['kecamatan'] != '' ? $row['kecamatan'] : '-',
                    'kode_pos' => $row['kode_pos'] != '' ? $row['kode_pos'] : '-',

                    'tanggal_penetapan' => $row['tanggal_masuk']->toDateString(),
                    'tmt' => ($row['tanggal_real_masuk'] != '') ? $row['tanggal_real_masuk']->toDateString() : $row['tanggal_masuk']->toDateString(),
                    'employee_status' => $row['status_karyawan'],
                    'status_active' => 'Aktif',
                    'position_id' => (count($position) == 1) ? $position->id : '-',
                    'contract_number' => ($row['last_contract_number'] == "" ? $row['nip'] : $row['last_contract_number']),
                    // 'head_nik' => $head_nik,
                ];
                $employee = Employee::create($data);

                $data_contract = [
                    'employee_id' => $employee->id,
                    'contract_number' => $data['contract_number'],
                    'nip' => $data['nip'],
                    'name' => $data['nama'],
                    'gender' => $data['jenis_kelamin'],
                    'contract_date' => $data['tanggal_penetapan'],
                    'position_id' => $data['position_id'],
                    'tmt' => $data['tmt'],
                    'upload_by' => $username,
                    'employee_status' => $data['status_karyawan'],
                    'status_active' => 'Aktif',
                ];

                if($data['status_karyawan'] == 'KK'){
                  $contract_date = $data_contract['contract_date'];

                  $contract_number = $data['contract_number'];
                  $pos = strrpos($contract_number, '/');
                  if($pos){
                    $year = substr($contract_number, $pos+1);
                    if(strlen($year) == 2){
                      $year = "20".$year;
                    }
                    $expire_year = $year+1;
                  }
                  $contract_expire_date = $expire_year.substr($contract_date, 4);
                  $data_contract['contract_expire_date'] = $contract_expire_date;
                }

                $contract = Contract::create($data_contract);
                $contract_id = $contract->id;

                $employee->contract_id = $contract_id;
                $employee->save();
              }
            });
            Excel::load($path, function($reader) use ($username){
              foreach ($reader->toArray() as $row) {
                if($row['nama_atasan'] != ""){
                  $employee = Employee::where('nip', $row['nip'])->first();
                  $head_nik = Employee::where('nama', $row['nama_atasan'])->first()->nik;
                  print_r($row);
                  $employee->head_nik = $head_nik;
                  $employee->save();
              }
              }
            });
            return back();

        }else {
            Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
            return back();
        }
    }
    }
}
