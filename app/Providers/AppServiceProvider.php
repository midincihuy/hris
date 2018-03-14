<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
      $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'Contracts',
                'icon' => 'file',
                'url' => 'admin/contracts',
                'can' => 'contracts_manage',
            ]);
            $event->menu->add('SETTING');
            $event->menu->add([
                'text' => 'Permissions',
                'icon' => 'lock',
                'url' => 'admin/permissions',
                'can' => 'permissions_manage',
            ]);
            $event->menu->add([
                'text' => 'Roles',
                'icon' => 'briefcase',
                'url' => 'admin/roles',
                'can' => 'roles_manage',
            ]);
            $event->menu->add([
                'text' => 'Users',
                'icon' => 'users',
                'url' => 'admin/users',
                'can' => 'users_manage',
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
