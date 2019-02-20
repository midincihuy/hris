@extends('adminlte::page')

@section('content')
    <h3 class="page-title">@lang('global.applicants.title')</h3>

    {!! Form::model($division, ['method' => 'PUT', 'route' => ['admin.divisions.update', $division->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
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
                <div class="col-xs-2 form-group">
                    {!! Form::label('company', 'Company', ['class' => 'control-label']) !!}
                    {!! Form::text('company', old('company'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
            Departments
        </div>
        <div class="panel-body">
        </div>
        <div class="panel-footer">
        </div>
    </div>
@stop
