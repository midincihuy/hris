@extends('adminlte::page')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    Edit
  </div>
  <div class="panel-body">
    {{ Form::model($family, ['url' => route('admin.employee.family.update', [$employee_id, $family->id]), 'method' => 'PUT']) }}
    <div class="row">
      <div class="col-xs-3 form-group">
        {{ Form::label('relation', 'Hubungan Keluarga') }}
      </div>
      <div class="col-xs-3 form-group">
        {{ Form::select('relation', $hubungan_keluarga, old('relation'), ['class' => 'form-control', 'placeholder' => 'Hubungan Keluarga', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3 form-group">
        {{ Form::label('nik', 'NIK') }}
      </div>
      <div class="col-xs-3 form-group">
        {{ Form::text('nik', old('nik'), ['class' => 'form-control', 'placeholder' => 'NIK', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3 form-group">
        {{ Form::label('name', 'Name') }}
      </div>
      <div class="col-xs-3 form-group">
        {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3 form-group">
        {{ Form::label('gender', 'Gender') }}
      </div>
      <div class="col-xs-3 form-group">
        {{ Form::select('gender',['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'], old('gender'), ['class' => 'form-control', 'placeholder' => 'Gender', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3 form-group">
        {{ Form::label('place_of_birth', 'Place Of Birth') }}
      </div>
      <div class="col-xs-3 form-group">
        {{ Form::text('place_of_birth', old('place_of_birth'), ['class' => 'form-control', 'placeholder' => 'Place Of Birth', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3 form-group">
        {{ Form::label('date_of_birth', 'Date Of Birth') }}
      </div>
      <div class="col-xs-3 form-group">
        {{ Form::date('date_of_birth', old('date_of_birth'), ['class' => 'form-control', 'placeholder' => 'Date Of Birth', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <input type="submit" class="btn btn-primary" value="Save" />
      </div>
    </div>
    {{ Form::close() }}
  </div>
  <div class="panel-footer">
  </div>
</div>

@endsection