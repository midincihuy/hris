@extends('adminlte::page')

@section('content')
    <h3 class="page-title">@lang('global.contracts.title')</h3>

    {!! Form::model($contract, ['method' => 'PUT', 'route' => ['admin.contracts.update', $contract->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('nik', 'NIK', ['class' => 'control-label']) !!}
                    {!! Form::text('nik', old('nik'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('position', 'Position', ['class' => 'control-label']) !!}
                    {!! Form::text('position', old('position'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('contract_date', 'Contract Date', ['class' => 'control-label']) !!}
                    {!! Form::text('contract_date', old('contract_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('employee_status', 'Employee Status', ['class' => 'control-label']) !!}
                    {!! Form::text('employee_status', old('employee_status'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', '']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('status_active', 'Status Active', ['class' => 'control-label']) !!}
                    {!! Form::text('status_active', old('status_active'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', '']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('reminder_hr', 'Reminder HR', ['class' => 'control-label']) !!}
                    {!! Form::text('reminder_hr', old('reminder_hr'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('reminder_user', 'Reminder User', ['class' => 'control-label']) !!}
                    {!! Form::text('reminder_user', old('reminder_user'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
