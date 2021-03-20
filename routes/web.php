<?php


//use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RawDataController;
use App\Http\Controllers\LaravelHelpController;

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
/*Route::redirect('/', function(){
    //die(App::getLocale());
    return "/en";
});*/


Route::redirect('/', '/en');
Route::prefix('{locale}')->group(function () {

    Route::get('/help',[LaravelHelpController::class,'index']);
    Route::get('/list',[RawDataController::class,'index']);
    Route::get('/coin/{cryptoid}',[RawDataController::class,'select']);
    Route::get('/coin/{cryptoid}/{cur}',[RawDataController::class,'price']);
    Route::get('/market',[RawDataController::class,'market']);
    Route::get('/',[RawDataController::class,'dataTest']);

});




//


