@extends('adminlte::page')

@section('content')
  {{-- {{ dd($data) }} --}}
    <h3 class="page-title">{{ $employee->position->division->company }}</h3>

    {!! Form::model($contract, ['method' => 'PUT', 'route' => ['admin.employee.update', $contract->employee_id]]) !!}
@php
    $readonly = $contract->nik == "" ? "" : "readonly";
@endphp

    <div class="row">
        <div class="col-md-3">
            @include('admin.employee.profile', ['employee' => $employee])
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-5 form-group">
                                    <div class="btn-group">
                                        <a href="detailemployee" class="btn btn-default"><i class="fa fa-edit"></i> Edit By Employee</a>
                                        <a href="detail" class="btn btn-default"><i class="fa fa-edit"></i> Edit By HR</a>
                                    </div>
                                </div>
                                <div class="col-md-2 form-group">
                                    <a href="sk"><button type="button" class="btn btn-default"><i class="fa fa-refresh"></i> SK Form</button></a>
                                </div>
                                <div class="col-md-2 form-group">
                                    <a href="resign"><button type="button" class="btn btn-default"><i class="fa fa-close"></i> Resign Form</button></a>
                                </div>
                                <div class="col-md-2 form-group">
                                    <a href="contract"><button type="button" class="btn btn-default"><i class="fa fa-file"></i> Contract Form</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-outline">
                        <div class="box-body">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <i class="fa fa-home"></i>
                                    {!! $employee->alamat !!}
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-mobile"></i>
                                    {!! $employee->handphone !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Documents List
        </div>
        <div class="panel-body">
            <table class="table dataTable">
                <thead>
                    <th>Description</th>
                    <th>Upload At</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($documents as $document)
                    <tr role="row">
                        <td>{{ $document->description }}</td>
                        <td>{{ $document->created_at }} </td>
                        <td>
                            <a href="{{ asset('storage/'.$document->url)}}" target="_blank" class="btn btn-xs btn-primary fa fa-download">
                                Download
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            {!! link_to(route('admin.employee.documents.create', $employee->id), '&nbsp;Add', ['class' => 'btn btn-success fa fa-file']) !!}
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
            <a href="{{ route('admin.employee.family.create', $contract->employee_id) }}">
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