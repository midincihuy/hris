<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'api_token' => str_random(50),
        ]);
      $user->assignRole('administrator');
      $hr = array(
        'andriane@ochanneltv.com',
        'enrico.didi@ochanneltv.com'
      );
      foreach($hr as $x){
        $user = User::create([
              'name' => $x,
              'email' => $x,
              'password' => bcrypt('password'),
              'api_token' => str_random(50),
          ]);
        $user->assignRole('hr_dept');
      }
    }
}
