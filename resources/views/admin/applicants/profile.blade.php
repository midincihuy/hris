@php 
  setLocale(LC_TIME, 'id_ID.utf8');
@endphp
<!-- Profile Image -->
<div class="box box-primary box-outline">
  <div class="box-body box-profile">
    <h3 class="profile-username text-center">
        {{ $applicant->nama }}
    </h3>
    <p class="text-center">
        {{ $applicant->jenis_kelamin }}
    </p>
    <p class="text-muted text-center">
        {{ $applicant->tempat_lahir.", ".$applicant->tanggal_lahir->formatLocalized("%d %B %Y") }}
    </p>
    <div class="text-center">
        {{ $applicant->no_ktp }}
    </div>
    <div class="text-center">
        {{ $applicant->kewarganegaraan.' - '.$applicant->agama }}
    </div>
    <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
          <i class="fa fa-home"></i><br/>{!! $applicant->alamat !!}
        </li>
        <li class="list-group-item">
          <i class="fa fa-phone"></i><br/>{!! $applicant->telephone_rumah !!}
        </li>
        <li class="list-group-item">
          <i class="fa fa-mobile"></i><br/>{!! $applicant->handphone !!}
        </li>
        <li class="list-group-item">
          <i class="fa fa-envelope"></i><br/>{{ $applicant->email }}
        </li>
        <li class="list-group-item">
          <i class="fa fa-skype"></i><br/>{!! $applicant->skype_id !!}
        </li>
        <li class="list-group-item">
          <i class="fa fa-tint"></i><br/>{!! $applicant->golongan_darah !!}
        </li>
        <li class="list-group-item">
          <i class="fa fa-briefcase"></i><br/>{{ $applicant->posisi_yang_dilamar }}
        </li>
        <li class="list-group-item">
          <i class="fa fa-university"></i><br/>
          {{ $applicant->institusi_pendidikan.', '.$applicant->jurusan }}<br/>
          {{ $applicant->pendidikan_terakhir." (".$applicant->tahun_masuk.' - '.$applicant->tahun_keluar. ')' }}

        </li>
    </ul>
    
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->