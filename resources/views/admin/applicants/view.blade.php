@extends('adminlte::page')

@section('content')
    <h3 class="page-title">@lang('global.applicants.title')</h3>
    <div class="row">
        <div class="col-md-3">
            @include('admin.applicants.profile', ['applicant' => $applicant])
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('global.app_view')
                </div>

                <div class="panel-body">
                    @if (count($applicant->recruitment) < 1)
                    {!! link_to(route('admin.applicants.recruit', $applicant->id), 'Create Recruitment', ['class' => 'btn btn-success']) !!}
                    @endif
                    {!! link_to(route('admin.applicants.index'), 'Back', ['class' => 'btn btn-default']) !!}
                </div>
            </div>
        </div>
    </div>
@stop
