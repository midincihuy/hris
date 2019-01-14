@extends('adminlte::page')

@section('content')
    <h3 class="page-title">@lang('global.schedulers.title')</h3>

    {!! Form::model($scheduler, ['method' => 'PUT', 'route' => ['admin.schedulers.update', $scheduler->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('command', 'Command*', ['class' => 'control-label']) !!}
                    {!! Form::text('command', old('command'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('command'))
                        <p class="help-block">
                            {{ $errors->first('command') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cron_expression', 'Cron Expression*', ['class' => 'control-label']) !!}
                    {!! Form::text('cron_expression', old('cron_expression'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cron_expression'))
                        <p class="help-block">
                            {{ $errors->first('cron_expression') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('status', 'Status*', ['class' => 'control-label']) !!}
                    {!! Form::select('status',$status,old('status'),['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
