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
      <h3>Import Employee From XLS</h3>
    </div>
    <div class="panel-body">
      <form action="{{ route('admin.employee.import') }}" method="POST" enctype="multipart/form-data">
          <div class="row">
              <div class="col-xs-5 form-group">
                {{ csrf_field() }}
                <input type="file" name="file" class="form-control" length=>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 form-group">
              <button type="submit" class="btn btn-primary" style="margin-top: 3%" ><i class="fa fa-upload"></i>&nbsp;Import</button>
            </div>
            <div class="col-md-2 form-group">
              <a href="/uploads/employee_template.xls"><button class="btn btn-success" style="margin-top: 3%" type="button"><i class="fa fa-download"></i>&nbsp;Download Template</button></a>
            </div>
          </div>
      </form>
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
