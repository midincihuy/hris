@extends('adminlte::page')

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    Add
  </div>
  <div class="panel-body">
    {{ Form::open(['url' => route('admin.divisions.store'), 'method' => 'POST']) }}
    
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
        {{ Form::label('company', 'Company Name') }}
      </div>
      <div class="col-xs-3 form-group">
        {{ Form::text('company', old('company'), ['class' => 'form-control', 'placeholder' => 'Company Name', 'required']) }}
      </div>
    </div>
  </div>
  <div class="panel-footer">
    <input type="submit" class="btn btn-primary" value="Save" />
  </div>
  {{ Form::close() }}
</div>
@endsection