<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/home');
})->name('start');

Route::get('/admin', function () {
    return redirect('admin/home');
});
Route::get('/home', function () {
    return redirect('admin/home');
});
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('permissions', 'Admin\PermissionsController',['only' => [
    'index', 'create', 'store', 'edit', 'update'
    ]])
    ->middleware('can:permissions_manage');

    Route::resource('roles', 'Admin\RolesController',['only' => [
    'index', 'create', 'store', 'edit', 'update'
    ]])
    ->middleware('can:roles_manage');

    Route::resource('users', 'Admin\UsersController',['only' => [
    'index', 'create', 'store', 'edit', 'update'
    ]])
    ->middleware('can:users_manage');

    Route::resource('menus', 'Admin\MenusController',['only' => [
    'index', 'create', 'store', 'edit', 'update'
    ]])
    ->middleware('can:menus_manage');

    Route::get('panel/account', 'Admin\PanelController@account')->name('panel.account');
    Route::post('panel/account', 'Admin\PanelController@update')->name('panel.update');

    Route::resource('draft_contracts', 'Admin\DraftContractsController')
    ->middleware('can:draft_contracts_manage');

    Route::resource('contracts', 'Admin\ContractsController')
    ->middleware('can:contracts_manage');
    Route::post('import', 'Admin\ContractsController@import')->name('import')
    ->middleware('can:contracts_manage');

    Route::get('panel/account', 'Admin\PanelController@account')->name('panel.account');
    Route::post('panel/account', 'Admin\PanelController@update')->name('panel.update');
    Route::get('panel/change_password', 'Admin\PanelController@change_password')->name('panel.change_password');
    Route::post('panel/change_password', 'Admin\PanelController@change_passwd')->name('panel.change_passwd');

    Route::resource('employee', 'Admin\EmployeeController')
    ->middleware('can:employee_manage');

    Route::post('employee/mass_update', 'Admin\EmployeeController@mass_update')->name('employee.mass_update')
    ->middleware('can:employee_manage');
    Route::get('employee/{contract}/detail', 'Admin\EmployeeController@detail')->name('employee.detail')
    ->middleware('can:employee_manage');
    Route::put('employee/{contract}/update_detail', 'Admin\EmployeeController@update_detail')->name('employee.update_detail')
    ->middleware('can:employee_manage');
    Route::get('employee/{contract}/family', 'Admin\EmployeeController@family')->name('employee.family')
    ->middleware('can:employee_manage');
    Route::put('employee/{contract}/update_family', 'Admin\EmployeeController@update_family')->name('employee.update_family')
    ->middleware('can:employee_manage');
    
    Route::resource('schedulers', 'Admin\SchedulersController',['only' => [
        'index', 'create', 'store', 'edit', 'update'
        ]])
    ->middleware('can:schedulers_manage');

    Route::resource('applicants', 'Admin\ApplicantsController')
    ->middleware('can:applicants_manage');
    Route::post('import_applicants', 'Admin\ApplicantsController@import')->name('import_applicants')
    ->middleware('can:applicants_manage');
    Route::get('applicants/{applicant}/recruit', 'Admin\ApplicantsController@recruit')
    ->middleware('can:applicants_manage');

    Route::resource('recruitments', 'Admin\RecruitmentsController')
    ->middleware('can:recruitments_manage');
    
    Route::get('recruitments/{recruitment}/create_contract', 'Admin\RecruitmentsController@create_contract')
    ->middleware('can:recruitments_manage');
    Route::post('recruitments/store_contract', 'Admin\RecruitmentsController@store_contract')
    ->middleware('can:recruitments_manage')->name('recruitments.store_contract');

    Route::resource('references', 'Admin\ReferencesController',['only' => [
        'index', 'create', 'store', 'edit', 'update'
        ]])
    ->middleware('can:references_manage');

    Route::resource('employee.family', 'Admin\FamilyController')
    ->middleware('can:employee_manage');
});
