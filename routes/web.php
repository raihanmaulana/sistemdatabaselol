<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\JoinController;
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
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('/heros', [HeroController::class, 'getHeroes'])->name('heros.index');
    Route::post('/heros/search', [HeroController::class, 'index']);
    Route::get('/heros/trash', [HeroController::class, 'deletelist']);
    Route::post('/heros/trash/restore/{id}', [HeroController::class, 'restore']);
    Route::delete('/heros/trash/forcedelete/{id}', [HeroController::class, 'deleteforce']);

   
    Route::get('/heros/create',[HeroController::class, 'create']);
    Route::post('/heros/create',[HeroController::class, 'store']);

    Route::get('heros/edit/{id}', [HeroController::class, 'edit']);
    Route::post('/heros/edit/{id}', [HeroController::class, 'update']);
    Route::delete('/heros/delete/{id}', [HeroController::class,'destroy']);
    Route::get('heros/show/{id}', [HeroController::class, 'show']);


    Route::get('/tipes', [TipeController::class, 'getTipes'])->name('tipes.index');
    Route::post('/tipes/search', [TipeController::class, 'index']);
    Route::get('/tipes/trash', [TipeController::class, 'deletelist']);
    Route::post('/tipes/trash/restore/{id}', [TipeController::class, 'restore']);
    Route::delete('/tipes/trash/forcedelete/{id}', [TipeController::class, 'deleteforce']);

   
    Route::get('/tipes/create',[TipeController::class, 'create']);
    Route::post('/tipes/create',[TipeController::class, 'store']);

    Route::get('tipes/edit/{id}', [TipeController::class, 'edit']);
    Route::post('/tipes/edit/{id}', [TipeController::class, 'update']);
    Route::delete('/tipes/delete/{id}', [TipeController::class,'destroy']);
    Route::get('tipes/show/{id}', [TipeController::class, 'show']);


    Route::get('/posisis', [PosisiController::class, 'getPosisis'])->name('posisis.index');
    Route::post('/posisis/search', [PosisiController::class, 'index']);
    Route::get('/posisis/trash', [PosisiController::class, 'deletelist']);
    Route::post('/posisis/trash/restore/{id}', [PosisiController::class, 'restore']);
    Route::delete('/posisis/trash/forcedelete/{id}', [PosisiController::class, 'deleteforce']);

   
    Route::get('/posisis/create',[PosisiController::class, 'create']);
    Route::post('/posisis/create',[PosisiController::class, 'store']);

    Route::get('posisis/edit/{id}', [PosisiController::class, 'edit']);
    Route::post('/posisis/edit/{id}', [PosisiController::class, 'update']);
    Route::delete('/posisis/delete/{id}', [PosisiController::class,'destroy']);
    Route::get('posisis/show/{id}', [PosisiController::class, 'show']);

    Route::get('/totals', [JoinController::class, 'index']);
    
});