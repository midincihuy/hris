@extends('adminlte::page')

@section('content')
    <h3 class="page-title">@lang('global.recruitments.title')</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            @php foreach($recruitment->toArray() as $k => $v):
            $label = strtoupper($k);
            $label = str_replace($label, '_', '');
            @endphp
            <div class="row">
                <div class="col-md-4 form-group">
                    {!! Form::label($k, $label, ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-4 form-group">
                    {!! Form::text($v, $v, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>
            </div>
            @php endforeach;
            @endphp
        </div>
    </div>
@stop