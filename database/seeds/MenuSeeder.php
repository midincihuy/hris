<?php

use Illuminate\Database\Seeder;

use App\Menu;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Menu::create([
          'text' => 'Main Menu',
          'label' => '',
          'url' => 'admin/home',
          'can' => 'main_menu',
          'icon' => 'home'
      ]);
      Menu::create([
          'text' => 'Employee',
          'label' => '',
          'url' => 'admin/employee',
          'can' => 'employee_manage',
          'icon' => 'address-book',
          'parent_id' => 1
      ]);
      Menu::create([
          'text' => 'Contracts',
          'label' => 'upload',
          'url' => 'admin/contracts',
          'can' => 'contracts_manage',
          'icon' => 'file',
          'parent_id' => 1
      ]);
    }
}