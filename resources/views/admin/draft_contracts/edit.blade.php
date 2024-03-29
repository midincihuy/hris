@extends('adminlte::page')

@section('content')
    <h3 class="page-title">@lang('global.draft_contracts.title')</h3>

    {!! Form::model($contract, ['method' => 'PUT', 'route' => ['admin.draft_contracts.update', $contract->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('nip', 'NIP', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('nip', old('nip'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('position', 'Position', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('position', $contract->position->name, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly', 'disabled']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('contract_date', 'Contract Date', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('contract_date', $contract->contract_date, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('tmt', 'TMT (Terhitung Mulai Tanggal)', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('tmt', $contract->contract_date, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
            {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) !!}
            {!! link_to(route('admin.draft_contracts.index'), 'Back', ['class' => 'btn btn-default']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@stop
