@extends('adminlte::page')

@section('content')
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.update_detail', $contract->id]]) !!}
    <div class="panel panel-primary">
        <div class="panel-heading">
            Detail
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
        </div>
        <div class="panel-footer">
            {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop