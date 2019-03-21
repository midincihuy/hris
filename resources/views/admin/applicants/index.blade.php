@extends('adminlte::page')

@section('content')
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      <div>
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    </div>
  @endif
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Import Applicants From XLS</h3>
    </div>
    <form action="{{ route('admin.import_applicants') }}" method="POST" enctype="multipart/form-data">
      <div class="panel-body">
        <div class="row">
            <div class="col-xs-5 form-group">
              {{ csrf_field() }}
              <input type="file" name="file" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-2 form-group">
            <button type="submit" class="btn btn-default" style="margin-top: 3%" ><i class="fa fa-upload"></i>&nbsp;Import</button>
          </div>
          <div class="col-md-2 form-group">
            <a href="/uploads/applicant_template.xls"><button class="btn btn-default" style="margin-top: 3%"><i class="fa fa-download"></i>&nbsp;Download Template</button></a>
          </div>
        </div>
      </div>
    </form>
  </div>
{!! $dataTable->table([], true) !!}
@endsection

@push('js')
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush
