@extends('adminlte::page')

@section('content')
  <h3 class="page-title">@lang('global.references.title')</h3>
  {!! Form::open(['method' => 'POST', 'route' => ['admin.references.store']]) !!}
  <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('code', 'Code*', ['class' => 'control-label']) !!}
                    {!! Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('code'))
                        <p class="help-block">
                            {{ $errors->first('code') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('item', 'Item*', ['class' => 'control-label']) !!}
                    {!! Form::text('item', old('item'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('item'))
                        <p class="help-block">
                            {{ $errors->first('item') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('value', 'Value*', ['class' => 'control-label']) !!}
                        {!! Form::text('value', old('value'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('value'))
                            <p class="help-block">
                                {{ $errors->first('value') }}
                            </p>
                        @endif
                    </div>
                </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sort', 'Sort*', ['class' => 'control-label']) !!}
                    {!! Form::text('sort', old('sort'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sort'))
                        <p class="help-block">
                            {{ $errors->first('sort') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

  {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
  {!! Form::close() !!}
@endsection
