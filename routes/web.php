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
    return view('welcome');
})->name('start');

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

    Route::get('panel/account', 'Admin\PanelController@account')->name('panel.account');
    Route::post('panel/account', 'Admin\PanelController@update')->name('panel.update');

    Route::resource('transactions', 'Admin\TransactionsController',['only' => [
    'index', 'show', 'store', 'edit', 'update'
    ]])
    ->middleware('can:transactions_manage');

    Route::resource('contracts', 'Admin\ContractsController');
    Route::post('import', 'Admin\ContractsController@import')->name('import');
});
