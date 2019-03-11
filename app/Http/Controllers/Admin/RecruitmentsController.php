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
use App\Contract;
use App\Employee;
use App\Position;

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
    $list_jabatan = Position::list_position();
    return view('admin.recruitments.edit', compact('recruitment','jenis_ptk', 'status_recruitment','list_jabatan'));
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
        $contract_type = Reference::where('code','JENIS_KONTRAK')->orderBy('sort')->get()->pluck('item','value');
        $contract_duration = Reference::where('code','JANGKA_WAKTU')->orderBy('sort')->get()->pluck('item','value');
        return view('admin.recruitments.create_contract', compact('recruitment', 'contract_type','contract_duration'));
    }

    public function store_contract(Request $request)
    {
        if (! Gate::allows('recruitments_manage')) {
            return abort(401);
        }
        $recruitment = Recruitment::findOrFail($request->recruitment_id);
        
        // save contract from recruitments
        $contract = new Contract();
        $contract->fill($request->all());

        // Additional parameter For New Employee
        $contract->name = $recruitment->applicant->nama;
        $contract->employee_status = "Draft";
        $contract->status_active = "Draft";
        $contract->position_id = $recruitment->jabatan_final;
        $contract->save();

        $contract_id = $contract->id;

        $employee = new Employee();
        $employee->contract_id = $contract_id;
        $employee->nama = $recruitment->applicant->nama;
        $employee->no_ktp = $recruitment->applicant->no_ktp;
        $employee->alamat_ktp = $recruitment->applicant->alamat_ktp;
        $employee->rt = $recruitment->applicant->rt;
        $employee->rw = $recruitment->applicant->rw;
        $employee->kelurahan = $recruitment->applicant->kelurahan;
        $employee->kecamatan = $recruitment->applicant->kecamatan;
        $employee->kota = $recruitment->applicant->kota;
        $employee->kode_pos = $recruitment->applicant->kode_pos;
        $employee->telephone_rumah = $recruitment->applicant->telephone_rumah;
        $employee->handphone = $recruitment->applicant->handphone;
        $employee->email = $recruitment->applicant->email;
        $employee->skype_id = $recruitment->applicant->skype_id;
        $employee->agama = $recruitment->applicant->agama;
        $employee->golongan_darah = $recruitment->applicant->golongan_darah;
        $employee->pendidikan_terakhir = $recruitment->applicant->pendidikan_terakhir;
        $employee->institusi_pendidikan = $recruitment->applicant->institusi_pendidikan;
        $employee->jurusan = $recruitment->applicant->jurusan;
        $employee->tahun_masuk = $recruitment->applicant->tahun_masuk;
        $employee->tahun_keluar = $recruitment->applicant->tahun_keluar;
        $employee->informasi_lowongan = $recruitment->applicant->informasi_lowongan;
        $employee->jenis_kelamin = $recruitment->applicant->jenis_kelamin;
        $employee->tempat_lahir = $recruitment->applicant->tempat_lahir;
        $employee->tanggal_lahir = $recruitment->applicant->tanggal_lahir;
        $employee->kewarganegaraan = $recruitment->applicant->kewarganegaraan;
        $employee->position_id = $recruitment->jabatan_final;
        $employee->employee_status = "Draft";
        $employee->status_active = "Draft";
        $employee->save();

        $contract->employee_id = $employee->id;
        $contract->save();
        // End parameter

        return redirect()->route('admin.recruitments.index');
    }
}
