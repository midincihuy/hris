@extends('adminlte::page')

@section('content')
    <h3 class="page-title">@lang('global.recruitments.title')</h3>
    <div class="row">
        <div class="col-md-3">
            @include('admin.recruitments.profile', ['applicant' => $recruitment->first()->applicant])
        </div>
        <div class="col-md-9">
            {!! Form::model($recruitment, ['method' => 'PUT', 'route' => ['admin.recruitments.update', $recruitment->id]]) !!}

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('global.app_edit')
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('no_ptk', 'No PTK', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::text('no_ptk', old('no_ptk'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('no_ptk'))
                                <p class="help-block">
                                    {{ $errors->first('no_ptk') }}
                                </p>
                            @endif
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('tanggal_ptk', 'Tanggal PTK', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::date('tanggal_ptk', old('tanggal_ptk'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('tanggal_ptk'))
                                <p class="help-block">
                                    {{ $errors->first('tanggal_ptk') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('jenis_ptk', 'Jenis PTK', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::select('jenis_ptk', $jenis_ptk,old('jenis_ptk'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('jenis_ptk'))
                                <p class="help-block">
                                    {{ $errors->first('jenis_ptk') }}
                                </p>
                            @endif
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('tanggal_interview_hr', 'Tanggal Interview HR', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::date('tanggal_interview_hr', old('tanggal_interview_hr'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('tanggal_interview_hr'))
                                <p class="help-block">
                                    {{ $errors->first('tanggal_interview_hr') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('status_interview_hr', 'Status Interview HR', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::select('status_interview_hr', $status_recruitment,old('status_interview_hr'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('status_interview_hr'))
                                <p class="help-block">
                                    {{ $errors->first('status_interview_hr') }}
                                </p>
                            @endif
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('tanggal_test_bidang', 'Tanggal Test Bidang', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::date('tanggal_test_bidang', old('tanggal_test_bidang'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('tanggal_test_bidang'))
                                <p class="help-block">
                                    {{ $errors->first('tanggal_test_bidang') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('status_test_bidang', 'Status Test Bidang', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::select('status_test_bidang', $status_recruitment,old('status_test_bidang'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('status_test_bidang'))
                                <p class="help-block">
                                    {{ $errors->first('status_test_bidang') }}
                                </p>
                            @endif
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('tanggal_psikotest', 'Tanggal Psikotest', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::date('tanggal_psikotest', old('tanggal_psikotest'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('tanggal_psikotest'))
                                <p class="help-block">
                                    {{ $errors->first('tanggal_psikotest') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('ist', 'IST', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::text('ist', old('ist'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('ist'))
                                <p class="help-block">
                                    {{ $errors->first('ist') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('pauli', 'Pauli', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::text('pauli', old('pauli'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('pauli'))
                                <p class="help-block">
                                    {{ $errors->first('pauli') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('hasil_psikotest', 'Hasil Psikotest', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::select('hasil_psikotest', $status_recruitment,old('hasil_psikotest'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('hasil_psikotest'))
                                <p class="help-block">
                                    {{ $errors->first('hasil_psikotest') }}
                                </p>
                            @endif
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('tanggal_interview_user', 'Tanggal Interview User', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::date('tanggal_interview_user', old('tanggal_interview_user'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('tanggal_interview_user'))
                                <p class="help-block">
                                    {{ $errors->first('tanggal_interview_user') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('status_interview_user', 'Status Interview User', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::select('status_interview_user', $status_recruitment,old('status_interview_user'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('status_interview_user'))
                                <p class="help-block">
                                    {{ $errors->first('status_interview_user') }}
                                </p>
                            @endif
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('tanggal_offering', 'Tanggal Offering', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::date('tanggal_offering', old('tanggal_offering'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('tanggal_offering'))
                                <p class="help-block">
                                    {{ $errors->first('tanggal_offering') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('status_offering', 'Status Offering', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::select('status_offering', $status_recruitment,old('status_offering'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('status_offering'))
                                <p class="help-block">
                                    {{ $errors->first('status_offering') }}
                                </p>
                            @endif
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-3 form-group">
                            {!! Form::label('jabatan_final', 'Jabatan Final', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-md-6 form-group">
                        {!! Form::select('jabatan_final',$list_jabatan,old('jabatan_final'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('jabatan_final'))
                                <p class="help-block">
                                    {{ $errors->first('jabatan_final') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) !!}
                    {!! link_to(route('admin.recruitments.index'), 'Cancel', ['class' => 'btn btn-default']) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop

@push('js')
<script type="text/javascript">
    $("select[name='jabatan_final']").select2();
</script>
@endpush