@extends('adminlte::page')

@section('content')
<h3 class="page-title">{{ $employee->position->division->company }}</h3>
<div class="row">
    <div class="col-md-3">
        @include('admin.employee.profile', ['employee' => $employee])
    </div>
    <div class="col-md-9">
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.update_detail', $employee->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Detail
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('no_kk', 'No KK', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('no_kk', old('no_kk') , ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('no_bpjs_ketenagakerjaan', 'No BPJS Ketenagakerjaan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('no_bpjs_ketenagakerjaan', old('no_bpjs_ketenagakerjaan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('no_bpjs_kesehatan', 'No BPJS Kesehatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('no_bpjs_kesehatan', old('no_bpjs_kesehatan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('no_bpjs_pensiun', 'No BPJS Pensiun', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('no_bpjs_pensiun', old('no_bpjs_pensiun'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('no_npwp', 'No NPWP', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('no_npwp', old('no_npwp'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('no_rek_bca', 'No Rek BCA', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('no_rek_bca', old('no_rek_bca'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('no_va_dana', 'No VA Dana', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('no_va_dana', old('no_va_dana'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('nama_ayah', 'Nama Ayah', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('nama_ayah', old('nama_ayah'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('nama_ibu', 'Nama Ibu', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('nama_ibu', old('nama_ibu'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
            {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) !!}
            {!! link_to(route('admin.employee.edit', $employee->id), 'Cancel', ['class' => 'btn btn-default']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    </div>
</div>
@stop