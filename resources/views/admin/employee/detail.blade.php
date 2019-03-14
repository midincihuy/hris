@extends('adminlte::page')

@section('content')
<h3 class="page-title">{{ $employee->position->division->company }}</h3>
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary box-outline">
            <div class="box-body box-profile">
            <div class="text-muted text-center">
                <img class="profile-user-img img-fluid img-circle"
                    src="/uploads/avatar/profile.png"
                    alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">
                {{ $employee->nama }}
            </h3>
            <p class="text-center">
                {{ $employee->nik }}
            </p>
            <p class="text-muted text-center">
                {{ $employee->position->name }}
            </p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                <b>Division</b>
                {{ $employee->position->division->name }}
                </li>
                <li class="list-group-item">
                <b>Department</b>
                @if($employee->position->department)
                {{ $employee->position->department->name }}
                @else 
                -
                @endif
                </li>
                <li class="list-group-item">
                <b>Section</b>
                @if($employee->position->section)
                {{ $employee->position->section->name }}
                @else 
                -
                @endif
                </li>

                <li class="list-group-item">
                <b>Head</b>
                {{ $employee->position->parent->name }}
                </li>
            </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-9">
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.update_detail', $contract->id]]) !!}
    <div class="panel panel-primary">
        <div class="panel-heading">
            Detail
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('golongan', 'Golongan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('golongan', $data['golongan'], old('golongan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('kelas', 'Kelas', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('kelas', $data['kelas'], old('kelas'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('status_karyawan', 'Status Karyawan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('status_karyawan', $data['status_karyawan'], old('status_karyawan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('lokasi_kerja', 'Lokasi Kerja', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('lokasi_kerja', $data['lokasi_kerja'], old('lokasi_kerja'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('tanggal_penetapan', 'Tanggal Penetapan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('tanggal_penetapan', old('tanggal_penetapan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('status_kawin', 'Status Kawin', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('status_kawin', $data['status_pajak'], old('status_kawin'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('status_pajak', 'Status Pajak', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('status_pajak', $data['status_pajak'], old('status_pajak'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('kode_kecamatan', 'Kode Kecamatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('kode_kecamatan', old('kode_kecamatan'), ['class' => 'form-control', 'placeholder' => 'Kode Kecamatan']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('nama_kecamatan', 'Nama Kecamatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('nama_kecamatan', old('nama_kecamatan'), ['class' => 'form-control', 'placeholder' => 'Nama Kecamatan']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('kode_desa', 'Kode Desa', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('kode_desa', old('kode_desa'), ['class' => 'form-control', 'placeholder' => 'Kode Desa']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('nama_desa', 'Nama Desa', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('nama_desa', old('nama_desa'), ['class' => 'form-control', 'placeholder' => 'Nama Desa']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('kode_pos', 'Kode Pos', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('kode_pos', old('kode_pos'), ['class' => 'form-control', 'placeholder' => 'Kode Pos']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('kode_faskes_tk_1', 'Kode Faskes TK 1', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('kode_faskes_tk_1', old('kode_faskes_tk_1'), ['class' => 'form-control', 'placeholder' => 'Kode Faskes TK 1']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('faskes_tk_1', 'Faskes TK 1', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('faskes_tk_1', old('faskes_tk_1'), ['class' => 'form-control', 'placeholder' => 'Faskes TK 1']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('plan_asuransi', 'Plan Asuransi', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('plan_asuransi', $data['plan_asuransi'], old('plan_asuransi'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('tanggal_efektif_asuransi', 'Tanggal Efektif Asuransi', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('tanggal_efektif_asuransi', old('tanggal_efektif_asuransi'), ['class' => 'form-control', 'placeholder' => 'tanggal_efektif_asuransi']) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
            {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
            {!! link_to(route('admin.employee.edit', $employee->id), 'Cancel', ['class' => 'btn btn-default']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    </div>
</div>
@stop