<?php

use Illuminate\Http\Request;
use Carbon\Carbon;
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

Route::post('login_normal','LoginController@index');
Route::post('lottery','LotteryController@index');
Route::post('share','LotteryController@share');
Route::post('get_personal','LotteryController@get_personal');


Route::get('time', function(){
if(Carbon::now()->between(Carbon::create(2017, 12, 1, 0), Carbon::create(2017, 12, 12, 0))){
	return 'true';
}else{
	return 'false';
}
});