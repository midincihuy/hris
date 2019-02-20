@extends('adminlte::page')

@section('content')
    {!! Form::model($section, ['method' => 'PUT', 'route' => ['admin.divisions.departments.sections.update', $section->department->division->id, $section->department->id, $section->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $section->department->division->company }}
            <h3>Division => [{{ $section->department->division->name }}] </h3>
            <h4>Department => {{ $section->department->name }}</h4>
            <h5>Section => {{ $section->name }}</h5>
        </div>

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
                @foreach($section->positions as $position)
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
@stop
