@extends('adminlte::page')

@section('content')

    {!! Form::model($position, ['method' => 'PUT', 'route' => ['admin.positions.update', $position->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('name', 'Position Name', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('company', 'Company', ['class' => 'control-label']) !!}
                    {!! Form::select('company',App\Division::distinct('company')->get(['company'])->pluck('company','company'), $position->company, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('division_id', 'Division', ['class' => 'control-label']) !!}
                    {!! Form::select('division_id',App\Division::where('company', $position->company)->get()->pluck('name','id'), old('division_id'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('department_id', 'Department', ['class' => 'control-label']) !!}
                    {!! Form::select('department_id',App\Department::where('division_id', $position->division_id)->get()->pluck('name','id'), old('department_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('section_id', 'Section', ['class' => 'control-label']) !!}
                    {!! Form::select('section_id',App\Section::where('department_id', $position->department_id)->get()->pluck('name','id'), old('section_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

                <div class="col-xs-3 form-group">
                    {!! Form::label('parent_id', 'Head', ['class' => 'control-label']) !!}
                    {!! Form::select('parent_id',$list_jabatan, old('parent_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


@push('js')
<script type="text/javascript">
    $("select[name='company']").select2();
    $("select[name='division_id']").select2();
    $("select[name='department_id']").select2();
    $("select[name='section_id']").select2();
    $("select[name='parent_id']").select2();

    $("select[name='company']").on("change", function(){
        var company = $(this).val();
        $.ajax({
           type: 'POST',
           url: "{{ route('api.dropdown') }}",
           dataType: 'json',
           data: {
                company: company,
                type: 'Division',
           }
        }).done( function(division_list){
            $("select[name='division_id'] option[value]").remove();
            $("select[name='department_id'] option[value]").remove();
            $("select[name='section_id'] option[value]").remove();
            $("select[name='division_id']").append($("<option></option>")
                    .attr('value', '')
                    .text(''));
            $.each(division_list, function(key, value){
                $("select[name='division_id']").append($("<option></option>")
                    .attr('value', key)
                    .text(value));
            });
            
        });
    });
    $("select[name='division_id']").on("change", function(){
        var division_id = $(this).val();
        $.ajax({
           type: 'POST',
           url: "{{ route('api.dropdown') }}",
           dataType: 'json',
           data: {
               division_id: division_id,
               type: 'Department',
           }
        }).done( function(department_list){
            $("select[name='department_id'] option[value]").remove();
            $("select[name='section_id'] option[value]").remove();
            $("select[name='department_id']").append($("<option></option>")
                    .attr('value', '')
                    .text(''));
            $.each(department_list, function(key, value){
                $("select[name='department_id']").append($("<option></option>")
                    .attr('value', key)
                    .text(value));
            });
            
        });
    });
    $("select[name='department_id']").on("change", function(){
        var department_id = $(this).val();
        $.ajax({
           type: 'POST',
           url: "{{ route('api.dropdown') }}",
           dataType: 'json',
           data: {
               department_id: department_id,
               type: 'Section',
           }
        }).done( function(section_list){
            $("select[name='section_id'] option[value]").remove();
            $("select[name='section_id']").append($("<option></option>")
                    .attr('value', '')
                    .text(''));
            $.each(section_list, function(key, value){
                $("select[name='section_id']").append($("<option></option>")
                    .attr('value', key)
                    .text(value));
            });
        });
    });
    // $("select[name='division_id']").change();
    // $("select[name='department_id']").change();
</script>
@endpush