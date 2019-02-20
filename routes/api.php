<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('dropdown', function(Request $request){
    $type = $request->type;
    $company     = $request->company;
    $division_id    = $request->division_id;
    $department_id  = $request->department_id;
    if($type == 'Division'){
        return App\Division::where('company', $company)->get()->pluck('name','id');
    }else if($type == 'Department'){
        return App\Department::where('division_id', $division_id)->get()->pluck('name','id');
    }else if($type == 'Section'){
        return App\Section::where('department_id', $department_id)->get()->pluck('name','id');
    }
})->name('api.dropdown');
