@extends('adminlte::page')

@section('content')
    <h3 class="page-title">@lang('global.applicants.title')</h3>

    {{-- {!! Form::model($applicant, ['method' => 'PUT', 'route' => ['admin.applicants.update', $applicant->id]]) !!} --}}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            @php foreach($applicant->toArray() as $k => $v):
            $label = strtoupper($k);
            $label = str_replace($label, '_', '');
            @endphp
            <div class="row">
                <div class="col-md-4 form-group">
                    {!! Form::label($k, $label, ['class' => 'control-label']) !!}
                </div>
                <div class="col-md-4 form-group">
                    {!! Form::text($v, $v, ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly']) !!}
                </div>
            </div>
            @php endforeach;
            @endphp
        </div>
        <div class="panel-footer">
            @if (count($applicant->recruitment) < 1)
            {!! link_to(route('admin.applicants.recruit', $applicant->id), 'Create Recruitment', ['class' => 'btn btn-success']) !!}
            @endif
            {!! link_to(route('admin.applicants.index'), 'Back', ['class' => 'btn btn-default']) !!}
        </div>
    </div>

    {{-- {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!} --}}
    {{-- {!! Form::close() !!} --}}
@stop
