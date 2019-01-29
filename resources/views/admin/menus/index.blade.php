@extends('adminlte::page')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Menus</h3>
  </div>
</div>
{!! $dataTable->table([], true) !!}
@endsection

@push('js')
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush
