@extends('adminlte::page')

@section('content')
  @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
  @endif
  @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
  @endif
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Employee List</h3>
    </div>
    <div class="panel-body">
      {{-- {!! Form::open(['method' => 'POST', 'route' => ['admin.employee.mass_update']]) !!}
        <div class="row">
          <input type="hidden" name="update_nik" id="hide_nik" value="">

          <div class="col-xs-3 form-group">
            {!! Form::label('employee_status', 'Employee Status', ['class' => 'control-label']) !!}
            {!! Form::select('employee_status', $employee_status, '', ['class' => 'form-control']) !!}
          </div>
          <div class="col-xs-3 form-group">
            {!! Form::label('status_active', 'Status Active', ['class' => 'control-label']) !!}
            {!! Form::select('status_active', $status_active, '', ['class' => 'form-control']) !!}
          </div>
          <div class="col-xs-3 form-group">
            {!! Form::label('reminder_hr', 'Reminder HR', ['class' => 'control-label']) !!}
            {!! Form::select('reminder_hr', $reminder_status, '', ['class' => 'form-control']) !!}
          </div>
          <div class="col-xs-3 form-group">
            {!! Form::label('reminder_user', 'Reminder User', ['class' => 'control-label']) !!}
            {!! Form::select('reminder_user', $reminder_status, '', ['class' => 'form-control']) !!}
          </div>
          <div class="col-xs-1 form-group">
            <button type="button" name="button" class="btn btn-primary" onclick="$('#dataTableBuilder tbody tr').each(function(){ $(this).not('*.selected').click() });">Select All</button>
          </div>
          <div class="col-xs-2 form-group">
            <button type="button" name="button" class="btn btn-primary" onclick="$('#dataTableBuilder tbody tr').each(function(){ $('[class~=\'selected\']').click() });">Deselect All</button>
          </div>
          <div class="col-xs-8 form-group">
            <span id="total_nik">0</span> Selected
            {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
          </div>
        </div>
      {!! Form::close() !!} --}}
    </div>
  </div>
{!! $dataTable->table([], true) !!}
@endsection

@push('js')
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<script type="text/javascript">
var selected = [];
</script>
{!! $dataTable->scripts() !!}
@endpush
