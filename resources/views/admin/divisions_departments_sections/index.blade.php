@extends('adminlte::page')

@section('content')
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      <div>
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    </div>
  @endif
  <div class="panel panel-default">
    <div class="panel-heading">
      {{ $department->division->company }}
      <h3>Division => [{{ $department->division->name }}] </h3>
      <h4>Department => {{ $department->name }}</h4>
    </div>
    {!! Form::model($department, ['method' => 'PUT', 'route' => ['admin.divisions.departments.update', $department->division->id, $department->id]]) !!}
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-2 form-group">
                {!! Form::label('id', 'ID', ['class' => 'control-label']) !!}
                {!! Form::text('id', old('id'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
            </div>
            <div class="col-xs-2 form-group">
                {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            </div>
        </div>
    </div>
    <div class="panel-footer">
        {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    </div>
    {!! Form::close() !!}
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading">
      Sections
    </div>
    <div class="panel-body">
      {!! $dataTable->table([], true) !!}
    </div>
  </div>

  <div class="panel panel-success">
    <div class="panel-heading">
      Positions
    </div>
    <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Position</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($department->positions as $position)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $position->name }}</td>
              <td>{{ $position->created_at }}</td>
              <td>{{ $position->updated_at }}</td>
              <td>
                <a href="{{ route('admin.positions.edit', $position->id) }}" class="btn btn-primary btn-xs">
                  <i class="fa fa-edit"></i> Edit
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('js')
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush
