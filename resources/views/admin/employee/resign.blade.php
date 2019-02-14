@extends('adminlte::page')

@section('content')
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.store_resign', $contract->id]]) !!}
    <div class="panel panel-danger">
        <div class="panel-heading">
            Resign
        </div>
        <div class="panel-body">
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
                  {!! Form::label('last_day', 'Last Day at Office', ['class' => 'control-label']) !!}
              </div>
              <div class="col-xs-3 form-group">
                  {!! Form::date('last_day', old('last_day'), ['class' => 'form-control', 'placeholder' => 'Last Day']) !!}
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
          {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop