@extends('adminlte::page')

@section('content')
<h3 class="page-title">{{ $employee->position->division->company }}</h3>
<div class="row">
    <div class="col-md-3">
        @include('admin.employee.profile', ['employee' => $employee])
    </div>
    <div class="col-md-9">
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.store_resign', $contract->id]]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            Resign 
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('tanggal_berhenti', 'Tanggal Berhenti', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('tanggal_berhenti', $employee->tanggal_berhenti, ['class' => 'form-control', 'placeholder' => 'tanggal_berhenti']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('last_day', 'Last Day at Office', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('last_day', $employee->last_day, ['class' => 'form-control', 'placeholder' => 'Last Day']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('alasan_berhenti', 'Alasan Berhenti', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('alasan_berhenti', $data['resign_cause'], old('alasan_berhenti'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
          {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) 
          !!}
          {!! link_to(route('admin.employee.edit', $employee->id), 'Cancel', ['class' => 'btn btn-default']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    </div>
</div>
@stop