<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\ResponseService;
use App\Http\Controllers\UserController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post("register","UserController@store" )->name ("users.store");
Route::post("login","UserController@login" )->name ("users.login");

Route::group(['prefix' => 'v1', 'middleware' => 'jwt.verify'],function () {

//O comando Route::apiResources() é equivalente à criar as seguinte rotas:index,show,store,update,delete.
    Route::apiResources([
        'tasklist'  =>  'TaskListController',
      ]);

      


    Route::post('logout', 'UserController@logout')->name('users.logout');
  });
