<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaravelHelpController;
use App\Http\Controllers\RawDataController;

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

/*Route::get('/help', function(){
    return view ('welcome');
});

Route::get('/', function(){
    return view ('rawdata');
});

*/

Route::get('/help',[LaravelHelpController::class,'index']);
Route::get('/market',[RawDataController::class,'index']);
Route::get('/coin/{id}',[RawDataController::class,'select']);
Route::get('/coin/{id}/{cur}',[RawDataController::class,'price']);
Route::get('/',[RawDataController::class,'market']);



//


