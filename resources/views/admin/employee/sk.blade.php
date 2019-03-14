@extends('adminlte::page')

@section('content')
<h3 class="page-title">{{ $employee->position->division->company }}</h3>
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary box-outline">
            <div class="box-body box-profile">
            <div class="text-muted text-center">
                <img class="profile-user-img img-fluid img-circle"
                    src="/uploads/avatar/profile.png"
                    alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">
                {{ $employee->nama }}
            </h3>
            <p class="text-center">
                {{ $employee->nik }}
            </p>
            <p class="text-muted text-center">
                {{ $employee->position->name }}
            </p>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                <b>Division</b>
                {{ $employee->position->division->name }}
                </li>
                <li class="list-group-item">
                <b>Department</b>
                @if($employee->position->department)
                {{ $employee->position->department->name }}
                @else 
                -
                @endif
                </li>
                <li class="list-group-item">
                <b>Section</b>
                @if($employee->position->section)
                {{ $employee->position->section->name }}
                @else 
                -
                @endif
                </li>

                <li class="list-group-item">
                <b>Head</b>
                {{ $employee->position->parent->name }}
                </li>
            </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-9">
  {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employee.store_sk', $employee->id]]) !!}
    <div class="panel panel-warning">
        <div class="panel-heading">
            Create SK
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('ref_no', 'Nomor Surat Usulan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('ref_no', '', ['class' => 'form-control', 'placeholder' => 'Nomor Surat Usulan', 'required']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('jenis_surat', 'Jenis Surat', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('jenis_surat', $data['jenis_surat'], '', ['class' => 'form-control', 'placeholder' => 'Jenis Surat']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('no_surat', 'Nomor Surat', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::text('no_surat', '', ['class' => 'form-control', 'placeholder' => 'Nomor Surat']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('jabatan', 'Jabatan', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::select('jabatan', $data['list_jabatan'], '', ['class' => 'form-control', 'placeholder' => 'Jabatan']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('start_date', 'Mulai Tanggal', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('start_date', '', ['class' => 'form-control', 'placeholder' => 'Mulai Tanggal']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('end_date', 'Sampai Tanggal', ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-6 form-group">
                    {!! Form::date('end_date', '', ['class' => 'form-control', 'placeholder' => 'Sampai Tanggal']) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
          {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-warning']) !!}

          {!! link_to(route('admin.employee.edit', $employee->id), 'Cancel', ['class' => 'btn btn-default']) !!}
        </div>
    </div>

    {!! Form::close() !!}
    </div>
</div>
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