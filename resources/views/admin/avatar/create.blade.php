@extends('adminlte::page')

@section('content')
<h3 class="page-title">{{ $employee->position->division->company }}</h3>
<div class="row">
    <div class="col-md-3">
        @include('admin.employee.profile', ['employee' => $employee])
    </div>
    <div class="col-md-9">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
      @endif
      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
<div class="panel panel-default">
  <div class="panel-heading">
    Change Avatar
  </div>
  <div class="panel-body">
    {{ Form::open(['url' => route('admin.employee.avatar.store', $employee->id), 'method' => 'POST', 'enctype' => "multipart/form-data"]) }}
    <div class="row">
      <div class="col-md-3 form-group">
        {{ Form::label('avatar', 'Avatar') }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::file('avatar', old('avatar'), ['class' => 'form-control', 'placeholder' => 'Avatar', 'required']) }}
      </div>
    </div>
  </div>
  <div class="panel-footer">
      {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) 
          !!}
      {!! link_to(route('admin.employee.edit', $employee->id), 'Cancel', ['class' => 'btn btn-default']) !!}
  </div>
</div>
    {{ Form::close() }}
    </div>
</div>

@endsection