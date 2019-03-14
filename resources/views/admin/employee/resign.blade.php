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
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.store_resign', $contract->id]]) !!}
    <div class="panel panel-danger">
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
          {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) 
          !!}
          {!! link_to(route('admin.employee.edit', $employee->id), 'Cancel', ['class' => 'btn btn-default']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    </div>
</div>
@stop