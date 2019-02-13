@extends('adminlte::page')

@section('content')
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.update_detail', $contract->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Detail
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('no_kk', 'No KK', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('no_kk', old('no_kk'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('no_bpjs_ketenagakerjaan', 'No BPJS Ketenagakerjaan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('no_bpjs_ketenagakerjaan', old('no_bpjs_ketenagakerjaan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('no_bpjs_kesehatan', 'No BPJS Kesehatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('no_bpjs_kesehatan', old('no_bpjs_kesehatan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('no_bpjs_pensiun', 'No BPJS Pensiun', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('no_bpjs_pensiun', old('no_bpjs_pensiun'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('no_npwp', 'No NPWP', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('no_npwp', old('no_npwp'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('no_rek_bca', 'No Rek BCA', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('no_rek_bca', old('no_rek_bca'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('no_va_dana', 'No VA Dana', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('no_va_dana', old('no_va_dana'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nama_ayah', 'Nama Ayah', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nama_ayah', old('nama_ayah'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('no_ktp_ibu', 'No KTP Ibu', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('no_ktp_ibu', old('no_ktp_ibu'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nama_ibu', 'Nama Ibu', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nama_ibu', old('nama_ibu'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Additional Info
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('golongan', 'Golongan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('golongan', $data['golongan'], old('golongan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kelas', 'Kelas', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('kelas', $data['kelas'], old('kelas'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('status_karyawan', 'Status Karyawan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('status_karyawan', $data['status_karyawan'], old('status_karyawan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('lokasi_kerja', 'Lokasi Kerja', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('lokasi_kerja', $data['lokasi_kerja'], old('lokasi_kerja'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('tanggal_penetapan', 'Tanggal Penetapan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::date('tanggal_penetapan', old('tanggal_penetapan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('status_kawin', 'Status Kawin', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('status_kawin', $data['status_pajak'], old('status_kawin'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('status_pajak', 'Status Pajak', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('status_pajak', $data['status_pajak'], old('status_pajak'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kode_kecamatan', 'Kode Kecamatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('kode_kecamatan', old('kode_kecamatan'), ['class' => 'form-control', 'placeholder' => 'Kode Kecamatan']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nama_kecamatan', 'Nama Kecamatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nama_kecamatan', old('nama_kecamatan'), ['class' => 'form-control', 'placeholder' => 'Nama Kecamatan']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kode_desa', 'Kode Desa', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('kode_desa', old('kode_desa'), ['class' => 'form-control', 'placeholder' => 'Kode Desa']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nama_desa', 'Nama Desa', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nama_desa', old('nama_desa'), ['class' => 'form-control', 'placeholder' => 'Nama Desa']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kode_pos', 'Kode Pos', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('kode_pos', old('kode_pos'), ['class' => 'form-control', 'placeholder' => 'Kode Pos']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kode_faskes_tk_1', 'Kode Faskes TK 1', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('kode_faskes_tk_1', old('kode_faskes_tk_1'), ['class' => 'form-control', 'placeholder' => 'Kode Faskes TK 1']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('faskes_tk_1', 'Faskes TK 1', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('faskes_tk_1', old('faskes_tk_1'), ['class' => 'form-control', 'placeholder' => 'Faskes TK 1']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('plan_asuransi', 'Plan Asuransi', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('plan_asuransi', $data['plan_asuransi'], old('plan_asuransi'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('tanggal_efektif_asuransi', 'Tanggal Efektif Asuransi', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::date('tanggal_efektif_asuransi', old('tanggal_efektif_asuransi'), ['class' => 'form-control', 'placeholder' => 'tanggal_efektif_asuransi']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('tanggal_berhenti', 'Tanggal Berhenti', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::date('tanggal_berhenti', old('tanggal_berhenti'), ['class' => 'form-control', 'placeholder' => 'tanggal_berhenti']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('alasan_berhenti', 'Alasan Berhenti', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('alasan_berhenti', $data['resign_cause'], old('alasan_berhenti'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            
        </div>
    </div>
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}

    {!! Form::close() !!}
@stop