@extends('adminlte::page')

@section('content')
<h3 class="page-title">{{ $employee->position->division->company }}</h3>
<div class="row">
    <div class="col-md-3">
        @include('admin.employee.profile', ['employee' => $employee])
    </div>
    <div class="col-md-9">
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.store_contract', $employee->id]]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Contract
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('contract_reference_no', 'Nomor Referensi Kontrak', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('contract_reference_no', '', ['class' => 'form-control', 'placeholder' => 'Nomor Referensi Kontrak']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('contract_type', 'Jenis Kontrak', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('contract_type', $data['jenis_kontrak'], '', ['class' => 'form-control', 'placeholder' => 'Jenis Kontrak', 'required']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('contract_number', 'Nomor Kontrak', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('contract_number', '', ['class' => 'form-control', 'placeholder' => 'Nomor Kontrak', 'required']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('jabatan', 'Jabatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('jabatan', $data['list_jabatan'], $employee->position_id, ['class' => 'form-control', 'placeholder' => 'Jabatan', 'required']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('contract_date', 'Mulai Tanggal', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('contract_date', '', ['class' => 'form-control', 'placeholder' => 'Mulai Tanggal', 'required']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('contract_expire_date', 'Sampai Tanggal', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('contract_expire_date', '', ['class' => 'form-control', 'placeholder' => 'Sampai Tanggal', 'required']) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
          {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) !!}

          {!! link_to(route('admin.employee.edit', $employee->id), 'Cancel', ['class' => 'btn btn-default']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    </div>
</div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Contract List
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    {!! $dataTable->table([], true) !!}
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
<script type="text/javascript">
    $("select[name='jabatan']").select2();
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script type="text/javascript">
var selected = [];
</script>
{!! $dataTable->scripts() !!}

@endpush