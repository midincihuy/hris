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
        'sort' => '2',
      ]);
    }
}
