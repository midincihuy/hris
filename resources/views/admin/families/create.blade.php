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
<div class="panel panel-default">
  <div class="panel-heading">
    Add Family
  </div>
  <div class="panel-body">
    {{ Form::open(['url' => route('admin.employee.family', $employee->id), 'method' => 'POST']) }}
    <div class="row">
      <div class="col-md-3 form-group">
        {{ Form::label('relation', 'Hubungan Keluarga') }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::select('relation', $hubungan_keluarga, old('relation'), ['class' => 'form-control', 'placeholder' => 'Hubungan Keluarga', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 form-group">
        {{ Form::label('nik', 'NIK') }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::text('nik', old('nik'), ['class' => 'form-control', 'placeholder' => 'NIK', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 form-group">
        {{ Form::label('name', 'Name') }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 form-group">
        {{ Form::label('gender', 'Gender') }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::select('gender',['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'], old('gender'), ['class' => 'form-control', 'placeholder' => 'Gender', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 form-group">
        {{ Form::label('place_of_birth', 'Place Of Birth') }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::text('place_of_birth', old('place_of_birth'), ['class' => 'form-control', 'placeholder' => 'Place Of Birth', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 form-group">
        {{ Form::label('date_of_birth', 'Date Of Birth') }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::date('date_of_birth', old('date_of_birth'), ['class' => 'form-control', 'placeholder' => 'Date Of Birth', 'required']) }}
      </div>
    </div>
  </div>
  <div class="panel-footer">
      {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-primary']) 
          !!}
      {!! link_to(route('admin.employee.edit', $employee->id), 'Cancel', ['class' => 'btn btn-default']) !!}
  </div>
</div>
    {{ Form::close() }}
    </div>
</div>

@endsection