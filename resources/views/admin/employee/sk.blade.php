@extends('adminlte::page')

@section('content')
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.store_sk', $employee->id]]) !!}
    <div class="panel panel-warning">
        <div class="panel-heading">
            Create SK
            <br/>
            <h4>{{ $employee->position->division->company }}</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nik', 'NIK', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nik', old('nik'), ['class' => 'form-control', 'placeholder' => 'nik', 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('nama', old('nama'), ['class' => 'form-control', 'placeholder' => 'nama', 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('division', 'Division', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('division', $employee->position->division->name, ['class' => 'form-control', 'placeholder' => 'division', 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('department', 'Department', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('department', $employee->position->department->name, ['class' => 'form-control', 'placeholder' => 'department', 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('ref_no', 'Nomor Surat Usulan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('ref_no', '', ['class' => 'form-control', 'placeholder' => 'Nomor Surat Usulan', 'required']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('jenis_surat', 'Jenis Surat', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('jenis_surat', $data['jenis_surat'], '', ['class' => 'form-control', 'placeholder' => 'Jenis Surat']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('no_surat', 'Nomor Surat', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('no_surat', '', ['class' => 'form-control', 'placeholder' => 'Nomor Surat']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('jabatan', 'Jabatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('jabatan', $data['list_jabatan'], '', ['class' => 'form-control', 'placeholder' => 'Jabatan']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('start_date', 'Mulai Tanggal', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::date('start_date', '', ['class' => 'form-control', 'placeholder' => 'Mulai Tanggal']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('end_date', 'Sampai Tanggal', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::date('end_date', '', ['class' => 'form-control', 'placeholder' => 'Sampai Tanggal']) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
          {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-warning']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            SK List
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