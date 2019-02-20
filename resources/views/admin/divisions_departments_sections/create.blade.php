@extends('adminlte::page')

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    Add
  </div>
  <div class="panel-body">
    {{ Form::open(['url' => route('admin.divisions.departments.sections.store', [$division_id, $department_id]), 'method' => 'POST']) }}
    
    <div class="row">
      <div class="col-xs-3 form-group">
        {{ Form::label('name', 'Name') }}
      </div>
      <div class="col-xs-3 form-group">
        {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name', 'required']) }}
      </div>
    </div>
  </div>
  <div class="panel-footer">
    <input type="submit" class="btn btn-primary" value="Save" />
  </div>
  {{ Form::close() }}
</div>
@endsection