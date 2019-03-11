@extends('adminlte::page')

@section('content')
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.store_resign', $contract->id]]) !!}
    <div class="panel panel-danger">
        <div class="panel-heading">
            Resign 
            <br/>
            <h4>{{ $employee->position->division->company }}</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nik', 'NIK', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nik', old('nik'), ['class' => 'form-control', 'placeholder' => 'nik', 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nama', old('nama'), ['class' => 'form-control', 'placeholder' => 'nama', 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('division', 'Division', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('division', $employee->position->division->name, ['class' => 'form-control', 'placeholder' => 'division', 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('department', 'Department', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('department', $employee->position->department->name, ['class' => 'form-control', 'placeholder' => 'department', 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('tanggal_berhenti', 'Tanggal Berhenti', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::date('tanggal_berhenti', $employee->tanggal_berhenti, ['class' => 'form-control', 'placeholder' => 'tanggal_berhenti']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('last_day', 'Last Day at Office', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::date('last_day', $employee->last_day, ['class' => 'form-control', 'placeholder' => 'Last Day']) !!}
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
        <div class="panel-footer">
          {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) 
          !!}
          {!! link_to(route('admin.employee.edit', $employee->id), 'Cancel', ['class' => 'btn btn-default']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop