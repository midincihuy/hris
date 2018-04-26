Dengan hormat,
<br/>
<br/>
Dengan ini kami sampaikan nama karyawan di unit kerja Saudara yang akan berakhir
Masa Kontrak pada bulan {{ date("M Y") }}, sebagai berikut:
<br/>
<br/>
{{-- {{ json_encode($contract['contract']) }} --}}
<table border=1 cellspacing=1 cellpadding=1>
  <tr>
      <td>No</td>
      <td>EM</td>
      <td>Nama</td>
      <td>Jabatan</td>
      <td>Masa Kontrak (Mulai)</td>
      <td>Masa Kontrak (Berakhir)</td>
  </tr>
    @foreach ($contract['contract'] as $key => $value)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $value->nik }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->position }}</td>
        <td>{{ $value->contract_date }}</td>
        <td>{{ $value->contract_date }}</td>
      </tr>
    @endforeach
</table>
<br/>
<br/>
Kami mohon agar Saudara dapat melengkapi Form Penilaian Kinerja atas karyawan
Bersangkutan dan mengisi Form Usulan Status Karyawan (terlampir).
<br/>
<br/>
Form Penilaian Kinerjanya,  kami harapkan dikembalikan ke HRD  paling lambat tanggal
<strong>16 April 2018</strong>, untuk kemudian dapat segera kami tindaklanjuti.
<br/>
Atas perhatian dan kerja samanya, terima kasih.
<br/>
<br/>
Hormat kami,
<br/>
<br/>
Andriane T.D.
<br/>
HRGA Division Head
