@extends('adminlte::page')

@section('content')
<h3 class="page-title">{{ $employee->position->division->company }}</h3>
<div class="row">
    <div class="col-md-3">
        @include('admin.employee.profile', ['employee' => $employee])
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