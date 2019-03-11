@extends('adminlte::page')

@section('content')
  {{-- {{ dd($data) }} --}}
    <h3 class="page-title">{{ $contract->position->division->company }}</h3>

    {!! Form::model($contract, ['method' => 'PUT', 'route' => ['admin.employee.update', $contract->id]]) !!}
@php
    $readonly = $contract->nik == "" ? "" : "readonly";
@endphp

    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary box-outline">
                <div class="box-body box-profile">
                <div class="text-muted text-center">
                    {{ $contract->nik }}
                    {{-- <img class="profile-user-img img-fluid img-circle"
                        src="/uploads/avatar/profile.png"
                        alt="User profile picture"> --}}
                </div>

                <h3 class="profile-username text-center">
                    {{ $contract->name }}
                </h3>

                <p class="text-muted text-center">
                    {{ $contract->position->name }}
                </p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                    <b>Division</b>
                    {{ $contract->position->division->name }}
                    </li>
                    <li class="list-group-item">
                    <b>Department</b>
                    @if($contract->position->department)
                    {{ $contract->position->department->name }}
                    @else 
                    -
                    @endif
                    </li>
                    <li class="list-group-item">
                    <b>Section</b>
                    @if($contract->position->section)
                    {{ $contract->position->section->name }}
                    @else 
                    -
                    @endif
                    </li>

                    <li class="list-group-item">
                    <b>Head</b>
                    {{ $contract->position->parent->name }}
                    </li>
                </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <div class="btn-group">
                                <a href="detailemployee" class="btn btn-primary"><i class="fa fa-edit"></i> Edit By Employee</a>
                                <a href="detail" class="btn btn-danger"><i class="fa fa-edit"></i> Edit By HR</a>
                            </div>
                        </div>
                        <div class="col-md-2 form-group">
                            <a href="sk"><button type="button" class="btn btn-warning"><i class="fa fa-refresh"></i> SK Form</button></a>
                        </div>
                        <div class="col-md-2 form-group">
                            <a href="resign"><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Resign Form</button></a>
                        </div>
                    </div>
                </div>
            </div>
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