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
        'value' => 'AKTIF',
        'sort' => '1',
      ]);
      Reference::create([
        'code' => 'STATUS_ACTIVE',
        'item' => 'Resign',
        'value' => 'RESIGN',
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
    }
}
