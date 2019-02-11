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
                    {!! Form::text('golongan', old('golongan'), ['class' => 'form-control', 'placeholder' => 'Golongan', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kelas', 'Kelas', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('kelas', old('kelas'), ['class' => 'form-control', 'placeholder' => 'Kelas', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('status_karyawan', 'status_karyawan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('status_karyawan', old('status_karyawan'), ['class' => 'form-control', 'placeholder' => 'status_karyawan', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('lokasi_kerja', 'lokasi_kerja', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('lokasi_kerja', old('lokasi_kerja'), ['class' => 'form-control', 'placeholder' => 'lokasi_kerja', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('tanggal_penetapan', 'tanggal_penetapan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('tanggal_penetapan', old('tanggal_penetapan'), ['class' => 'form-control', 'placeholder' => 'tanggal_penetapan', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('status_kawin', 'status_kawin', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('status_kawin', old('status_kawin'), ['class' => 'form-control', 'placeholder' => 'status_kawin', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('status_pajak', 'status_pajak', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('status_pajak', old('status_pajak'), ['class' => 'form-control', 'placeholder' => 'status_pajak', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kode_kecamatan', 'kode_kecamatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('kode_kecamatan', old('kode_kecamatan'), ['class' => 'form-control', 'placeholder' => 'kode_kecamatan', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nama_kecamatan', 'nama_kecamatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nama_kecamatan', old('nama_kecamatan'), ['class' => 'form-control', 'placeholder' => 'nama_kecamatan', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kode_desa', 'kode_desa', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('kode_desa', old('kode_desa'), ['class' => 'form-control', 'placeholder' => 'kode_desa', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nama_desa', 'nama_desa', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nama_desa', old('nama_desa'), ['class' => 'form-control', 'placeholder' => 'nama_desa', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kode_pos', 'kode_pos', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('kode_pos', old('kode_pos'), ['class' => 'form-control', 'placeholder' => 'kode_pos', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('kode_faskes_tk1', 'kode_faskes_tk1', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('kode_faskes_tk1', old('kode_faskes_tk1'), ['class' => 'form-control', 'placeholder' => 'kode_faskes_tk1', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('faskes_tk1', 'faskes_tk1', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('faskes_tk1', old('faskes_tk1'), ['class' => 'form-control', 'placeholder' => 'faskes_tk1', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('plan_asuransi', 'plan_asuransi', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('plan_asuransi', old('plan_asuransi'), ['class' => 'form-control', 'placeholder' => 'plan_asuransi', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('tanggal_efektif_asuransi', 'tanggal_efektif_asuransi', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('tanggal_efektif_asuransi', old('tanggal_efektif_asuransi'), ['class' => 'form-control', 'placeholder' => 'tanggal_efektif_asuransi', 'required' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('golongan', 'Golongan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('golongan', old('golongan'), ['class' => 'form-control', 'placeholder' => 'Golongan', 'required' => '']) !!}
                </div>
            </div>
            
        </div>
    </div>
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}

    {!! Form::close() !!}
@stop