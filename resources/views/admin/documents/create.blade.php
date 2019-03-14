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
    Add Document
  </div>
  <div class="panel-body">
    {{ Form::open(['url' => route('admin.employee.documents.store', $employee->id), 'method' => 'POST', 'enctype' => "multipart/form-data"]) }}
    <div class="row">
      <div class="col-md-3 form-group">
        {{ Form::label('description', 'Description') }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description', 'required']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 form-group">
        {{ Form::label('url', 'File') }}
      </div>
      <div class="col-md-6 form-group">
        {{ Form::file('url', old('url'), ['class' => 'form-control', 'placeholder' => 'File', 'required']) }}
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