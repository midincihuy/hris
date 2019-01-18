@extends('adminlte::page')

@section('content')
  <h3 class="page-title">@lang('global.recruitments.title')</h3>
  {!! Form::open(['method' => 'POST', 'route' => ['admin.recruitments.store_contract']]) !!}
  {!! Form::hidden('recruitment_id', $recruitment->id) !!}
  <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">
            asdasd


        </div>
    </div>

  {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
  {!! Form::close() !!}
@endsection
