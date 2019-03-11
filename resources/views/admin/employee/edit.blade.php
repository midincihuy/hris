@extends('adminlte::page')

@section('content')
  {{-- {{ dd($data) }} --}}
    <h3 class="page-title">@lang('global.employee.title')</h3>

    {!! Form::model($contract, ['method' => 'PUT', 'route' => ['admin.employee.update', $contract->id]]) !!}
@php
    $readonly = $contract->nik == "" ? "" : "readonly";
@endphp
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('nik', 'NIK', ['class' => 'control-label']) !!}
                    {!! Form::text('nik', old('nik'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', $readonly ]) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('position', 'Position', ['class' => 'control-label']) !!}
                    {!! Form::text('position', $contract->position->name, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('contract_date', 'Contract Date', ['class' => 'control-label']) !!}
                    {!! Form::text('contract_date', old('contract_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('employee_status', 'Employee Status', ['class' => 'control-label']) !!}
                    {!! Form::select('employee_status', $data['employee_status'], '', ['class' => 'form-control']) !!}
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('status_active', 'Status Active', ['class' => 'control-label']) !!}
                    {!! Form::select('status_active', $data['status_active'], '', ['class' => 'form-control']) !!}
                </div>

            </div>
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
                </div>
                <div class="col-xs-2 form-group">
                    <a href="detailemployee"><button type="button" class="btn btn-primary"><i class="fa fa-list"></i> Update By Employee</button></a>
                </div>
                <div class="col-xs-2 form-group">
                    <a href="detail"><button type="button" class="btn btn-primary"><i class="fa fa-list"></i> Update By HR</button></a>
                </div>
                <div class="col-xs-2 form-group">
                    <a href="resign"><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Resign Form</button></a>
                </div>
                <div class="col-xs-2 form-group">
                    <a href="sk"><button type="button" class="btn btn-warning"><i class="fa fa-refresh"></i> SK Form</button></a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Anggota Keluarga
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    {!! $dataTable->table([], true) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <a href="{{ route('admin.employee.family.create', $contract->id) }}">
                <i class="btn btn-success fa fa-plus"> Add</i>
            </a>
        </div>
    </div>
@stop

@push('js')
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script type="text/javascript">
var selected = [];
</script>
{!! $dataTable->scripts() !!}
@endpush