<?php

use Illuminate\Database\Seeder;

use App\Reference;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Reference::create([
        'code' => 'EMPLOYEE_STATUS',
        'item' => 'Karyawan Kontrak',
        'value' => 'KK',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'EMPLOYEE_STATUS',
        'item' => 'Karyawan Tetap',
        'value' => 'KT',
        'sort' => '2',
      ]);

      Reference::create([
        'code' => 'STATUS_ACTIVE',
        'item' => 'Aktif',
        'value' => 'Aktif',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'STATUS_ACTIVE',
        'item' => 'Not Aktif',
        'value' => 'Not Aktif',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'REMINDER_STATUS',
        'item' => 'New',
        'value' => 'New',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'REMINDER_STATUS',
        'item' => 'Done',
        'value' => 'DONE',
        'sort' => '2',
      ]);

      Reference::create([
        'code' => 'REASON_NOT_ACTIVE',
        'item' => 'Resign',
        'value' => 'Resign',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'REASON_NOT_ACTIVE',
        'item' => 'Resign Tidak One Month Notice',
        'value' => 'Resign Tidak One Month Notice',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'REASON_NOT_ACTIVE',
        'item' => 'Terminate',
        'value' => 'Terminate',
        'sort' => '3',
      ]);
      Reference::create([
        'code' => 'REASON_NOT_ACTIVE',
        'item' => 'End of Contract',
        'value' => 'End of Contract',
        'sort' => '4',
      ]);
      Reference::create([
        'code' => 'REASON_NOT_ACTIVE',
        'item' => 'Meninggal',
        'value' => 'Meninggal',
        'sort' => '5',
      ]);

      Reference::create([
        'code' => 'JENIS_PTK',
        'item' => 'Add',
        'value' => 'Add',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'JENIS_PTK',
        'item' => 'Repl',
        'value' => 'Repl',
        'sort' => '2',
      ]);

      Reference::create([
        'code' => 'STATUS_RECRUITMENT',
        'item' => 'Disarankan',
        'value' => 'Disarankan',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'STATUS_RECRUITMENT',
        'item' => 'Dipertimbangkan',
        'value' => 'Dipertimbangkan',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'STATUS_RECRUITMENT',
        'item' => 'Tidak Disarankan',
        'value' => 'Tidak Disarankan',
        'sort' => '3',
      ]);

      Reference::create([
        'code' => 'JENIS_KONTRAK',
        'item' => 'PKWT',
        'value' => 'PKWT',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'JENIS_KONTRAK',
        'item' => 'Probation',
        'value' => 'Probation',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'JENIS_KONTRAK',
        'item' => 'PKWTT',
        'value' => 'PKWTT',
        'sort' => '3',
      ]);
      Reference::create([
        'code' => 'JENIS_KONTRAK',
        'item' => 'ADD',
        'value' => 'ADD',
        'sort' => '4',
      ]);
      Reference::create([
        'code' => 'JENIS_KONTRAK',
        'item' => 'PKWT2',
        'value' => 'PKWT2',
        'sort' => '5',
      ]);
      Reference::create([
        'code' => 'JENIS_SK',
        'item' => 'Mutasi',
        'value' => 'Mutasi',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'JENIS_SK',
        'item' => 'Promosi',
        'value' => 'Promosi',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'JENIS_SK',
        'item' => 'Penetapan',
        'value' => 'Penetapan',
        'sort' => '3',
      ]);
      Reference::create([
        'code' => 'JENIS_SK',
        'item' => 'Pengangkatan',
        'value' => 'Pengangkatan',
        'sort' => '4',
      ]);
      Reference::create([
        'code' => 'JENIS_SK',
        'item' => 'Demosi',
        'value' => 'Demosi',
        'sort' => '5',
      ]);
      Reference::create([
        'code' => 'JANGKA_WAKTU',
        'item' => '12',
        'value' => '12',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'JANGKA_WAKTU',
        'item' => '6',
        'value' => '6',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'JANGKA_WAKTU',
        'item' => '3',
        'value' => '3',
        'sort' => '3',
      ]);

      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'OFFICER',
        'value' => 'OFFICER',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'SUPERVISOR',
        'value' => 'SUPERVISOR',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'SECTION HEAD',
        'value' => 'SECTION HEAD',
        'sort' => '3',
      ]);
      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'MANAGER',
        'value' => 'MANAGER',
        'sort' => '4',
      ]);
      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'SENIOR MANAGER',
        'value' => 'SENIOR MANAGER',
        'sort' => '5',
      ]);
      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'GENERAL MANAGER',
        'value' => 'GENERAL MANAGER',
        'sort' => '6',
      ]);
      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'VICE PRESIDENT',
        'value' => 'VICE PRESIDENT',
        'sort' => '7',
      ]);
      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'SENIOR VICE PRESIDENT',
        'value' => 'SENIOR VICE PRESIDENT',
        'sort' => '8',
      ]);
      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'DEPUTY DIRECTOR',
        'value' => 'DEPUTY DIRECTOR',
        'sort' => '9',
      ]);
      Reference::create([
        'code' => 'GOLONGAN',
        'item' => 'DIRECTOR',
        'value' => 'DIRECTOR',
        'sort' => '10',
      ]);

      Reference::create([
        'code' => 'STATUS_KARYAWAN',
        'item' => 'PERMANENT',
        'value' => 'PERMANENT',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'STATUS_KARYAWAN',
        'item' => 'PROBATION',
        'value' => 'PROBATION',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'STATUS_KARYAWAN',
        'item' => 'CONTRACT',
        'value' => 'CONTRACT',
        'sort' => '3',
      ]);

      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'SENAYAN CITY',
        'value' => 'SENAYAN CITY',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'DAAN MOGOT',
        'value' => 'DAAN MOGOT',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'RADIO DALAM',
        'value' => 'RADIO DALAM',
        'sort' => '3',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'PULOMAS',
        'value' => 'PULOMAS',
        'sort' => '4',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'KEBAYORAN',
        'value' => 'KEBAYORAN',
        'sort' => '5',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'BANDUNG',
        'value' => 'BANDUNG',
        'sort' => '6',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'SOLO',
        'value' => 'SOLO',
        'sort' => '7',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'KALIANDA',
        'value' => 'KALIANDA',
        'sort' => '8',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'PONTIANAK',
        'value' => 'PONTIANAK',
        'sort' => '9',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'BANJARMASIN',
        'value' => 'BANJARMASIN',
        'sort' => '10',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'KELAPA GADING',
        'value' => 'KELAPA GADING',
        'sort' => '11',
      ]);
      Reference::create([
        'code' => 'LOKASI_KERJA',
        'item' => 'JOGLO',
        'value' => 'JOGLO',
        'sort' => '12',
      ]);

      Reference::create([
        'code' => 'STATUS_PAJAK',
        'item' => 'TK',
        'value' => 'TK',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'STATUS_PAJAK',
        'item' => 'K0',
        'value' => 'K0',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'STATUS_PAJAK',
        'item' => 'K1',
        'value' => 'K1',
        'sort' => '3',
      ]);
      Reference::create([
        'code' => 'STATUS_PAJAK',
        'item' => 'K2',
        'value' => 'K2',
        'sort' => '4',
      ]);
      Reference::create([
        'code' => 'STATUS_PAJAK',
        'item' => 'K3',
        'value' => 'K3',
        'sort' => '5',
      ]);
      Reference::create([
        'code' => 'STATUS_PAJAK',
        'item' => 'Janda/Duda',
        'value' => 'Janda/Duda',
        'sort' => '6',
      ]);

      Reference::create([
        'code' => 'PLAN_ASURANSI',
        'item' => 'IP-200',
        'value' => 'IP-200',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'PLAN_ASURANSI',
        'item' => 'IP-350',
        'value' => 'IP-350',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'PLAN_ASURANSI',
        'item' => 'IP-450',
        'value' => 'IP-450',
        'sort' => '3',
      ]);
      Reference::create([
        'code' => 'PLAN_ASURANSI',
        'item' => 'IP-650',
        'value' => 'IP-650',
        'sort' => '4',
      ]);
      Reference::create([
        'code' => 'PLAN_ASURANSI',
        'item' => 'IP-800',
        'value' => 'IP-800',
        'sort' => '5',
      ]);
      Reference::create([
        'code' => 'PLAN_ASURANSI',
        'item' => 'IP-1050',
        'value' => 'IP-1050',
        'sort' => '6',
      ]);
      
      Reference::create([
        'code' => 'RESIGN_CAUSE',
        'item' => 'Resign',
        'value' => 'Resign',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'RESIGN_CAUSE',
        'item' => 'Resign - personal reason',
        'value' => 'Resign - personal reason',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'RESIGN_CAUSE',
        'item' => 'Manage Out',
        'value' => 'Manage Out',
        'sort' => '3',
      ]);
      Reference::create([
        'code' => 'RESIGN_CAUSE',
        'item' => 'End of Contract',
        'value' => 'End of Contract',
        'sort' => '4',
      ]);
      Reference::create([
        'code' => 'RESIGN_CAUSE',
        'item' => 'Tidak 1 Month Notice',
        'value' => 'Tidak 1 Month Notice',
        'sort' => '5',
      ]);
      $code = 'KELAS';
      foreach (range(7,22) as $key => $value){
        Reference::create([
          'code' => $code,
          'item' => $value,
          'value' => $value,
          'sort' => $key+1,
        ]);
      }


      Reference::create([
        'code' => 'HUBUNGAN_KELUARGA',
        'item' => 'Suami',
        'value' => 'Suami',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'HUBUNGAN_KELUARGA',
        'item' => 'Istri',
        'value' => 'Istri',
        'sort' => '2',
      ]);
      Reference::create([
        'code' => 'HUBUNGAN_KELUARGA',
        'item' => 'Anak',
        'value' => 'Anak',
        'sort' => '3',
      ]);
    }
}
