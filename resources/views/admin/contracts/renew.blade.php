@extends('adminlte::page')

@section('content')
  <h3 class="page-title">RENEW Contract</h3>
  {!! Form::open(['method' => 'POST', 'route' => ['admin.contracts.renew_store', $contract->id]]) !!}
  {!! Form::hidden('parent_contract_id', $contract->id) !!}
  <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('contract_number', 'No Kontrak', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('contract_number', old('contract_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contract_number'))
                        <p class="help-block">
                            {{ $errors->first('contract_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('contract_type', 'Jenis Kontrak', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('contract_type', $contract_type,'', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contract_type'))
                        <p class="help-block">
                            {{ $errors->first('contract_type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('contract_date', 'Tanggal Mulai', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::date('contract_date', old('contract_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contract_date'))
                        <p class="help-block">
                            {{ $errors->first('contract_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('contract_duration', 'Jangka Waktu', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::select('contract_duration',$contract_duration, old('contract_duration'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contract_duration'))
                        <p class="help-block">
                            {{ $errors->first('contract_duration') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('contract_expire_date', 'Tanggal Akhir', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('contract_expire_date', old('contract_expire_date'), ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contract_expire_date'))
                        <p class="help-block">
                            {{ $errors->first('contract_expire_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('contract_reference_no', 'No Referensi', ['class' => 'control-label']) !!}
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::text('contract_reference_no', $contract->contract_number, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contract_reference_no'))
                        <p class="help-block">
                            {{ $errors->first('contract_reference_no') }}
                        </p>
                    @endif
                </div>
            </div>


        </div>
    </div>

  {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
  {!! Form::close() !!}
@endsection

@push('js')
<script type="text/javascript">
    $("#contract_duration").change(function(){
        duration = $(this).val();
        contract_date = $("#contract_date").val();
        if(contract_date != ""){
            tgl_mulai = new Date(contract_date);
            tgl_mulai.setMonth(tgl_mulai.getMonth()+parseInt(duration));
            $("#contract_expire_date").val(tgl_mulai.toISOString().substr(0,10));
        }else{
            alert("Tanggal Mulai Kosong");
            $("#contract_date").focus();
            $(this).val('')
        }
    });

    $("#contract_type").change(function(){
        switch($(this).val()){
            case "PKWTT" :
                $("#contract_duration").removeAttr('required');
                $("#contract_reference_no").attr('required','');
                break;
            default:
                $("#contract_duration").attr('required','');
                $("#contract_reference_no").removeAttr('required');
                break;
        }
    });
</script>
@endpush
