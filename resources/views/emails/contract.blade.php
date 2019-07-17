Dengan hormat,
<br/>
<br/>
Dengan ini kami sampaikan nama karyawan di unit kerja Saudara yang akan segera berakhir, sebagai berikut:
<br/>
<br/>
{{-- {{json_encode($details['contract'])}} --}}
<table border=1 cellspacing=1 cellpadding=1>
  <thead>
  <tr>
      <th>EM</th>
      <th>Nama</th>
      <th>Jabatan</th>
      <th>Masa Kontrak (Mulai)</th>
      <th>Masa Kontrak (Berakhir)</th>
  </tr>
  </thead>
    @foreach ($details['message'] as $key => $value)
      <tr>
        <td>{{ $value['nip'] }}</td>
        <td>{{ $value['nama'] }}</td>
        <td>{{ $value['position'] }}</td>
        <td>{{ $value['contract_date'] }}</td>
        <td>{{ $value['contract_expire_date'] }}</td>
      </tr>
    @endforeach
</table>
<br/>
<br/>
Kami mohon agar Saudara dapat melengkapi Form Penilaian Kinerja atas karyawan
Bersangkutan dan mengisi Form Usulan Status Karyawan (terlampir).
<br/>
<br/>
Form Penilaian Kinerjanya,  kami harapkan dikembalikan ke HRD <strong>SEGERA</strong>, untuk kemudian dapat segera kami tindaklanjuti.
{{-- Form Penilaian Kinerjanya,  kami harapkan dikembalikan ke HRD  paling lambat tanggal
<strong>{{ $details['no_later_than'] }}</strong>, untuk kemudian dapat segera kami tindaklanjuti. --}}
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
