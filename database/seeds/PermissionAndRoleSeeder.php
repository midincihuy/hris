<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Reset cached roles and permissions
      app()['cache']->forget('spatie.permission.cache');
      $permissions = array(
        'permissions_manage',
        'roles_manage',
        'users_manage',
        'contracts_manage',
        'employee_manage',
        'menus_manage',
        'schedulers_manage',
        'applicants_manage',
        'recruitments_manage',
        'configuration_manage',
        'references_manage',
        'main_menu',
      );
      foreach ($permissions as $key => $value) {
        Permission::create(['name' => $value]);
      }

      $role = Role::create(['name' => 'administrator']);
      foreach ($permissions as $key => $value) {
        $role->givePermissionTo($value);
      }
      $role = Role::create(['name' => 'hr_dept']);
      $role->givePermissionTo('contracts_manage');
      $role->givePermissionTo('employee_manage');
      $role->givePermissionTo('main_menu');
    }
}
