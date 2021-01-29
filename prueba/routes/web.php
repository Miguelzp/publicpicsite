<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


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

/*
RUTAS PARA LA TRADUCCIÓN
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return \Redirect::back();
    });
    Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es|eus'
    ]);
});

Route::get('/', function () {
    return view('index');
});

Route::get('/explorar', [\App\Http\Controllers\HomeController::class, 'index'])->name("explorador");
Route::get('/informacion/{id}', '\App\Http\Controllers\HomeController@info')->name("info");

Route::get('/verificar_email', function () {
    return view('auth.verify');
})->name('verifyed-account');
Route::get('/home', 'CasaController@index')->name('home')->middleware('verified');

// LAS SIGUIENTES RUTAS REQUIEREN DE AUTENTIFICACIÓN
Auth::routes(['verify'=> true]);

Route::group([ 'middleware'=>'auth'], function(){
    //ruta que te redirige a la vista de tus spots
    Route::get('/mySpots',[\App\Http\Controllers\SpotController::class, 'mios'])->name('mios');

    //Rutas para crear y mostrar los spots en la vista spots
    Route::get('/spot', [\App\Http\Controllers\SpotController::class, 'show']);
    Route::post('/spot', [\App\Http\Controllers\SpotController::class, 'store'])->name("nuevoSpot");
    
    //Rutas para la edicion y el borrado de tus spots
    Route::delete('/destroy/{id}', 'SpotController@destroy')->name("destroy");
    Route::get('/mySpots/{id}/edit', '\App\Http\Controllers\SpotController@edit')->name('edit');
    Route::put('/update/{id}', '\App\Http\Controllers\SpotController@update')->name('upadte');
    
    Route::get('/dashboard', [\App\Http\Controllers\SpotController::class, 'index'])->name("dashboard");
    
    //rutas para la vista de perfil de usuario
    Route::get('/perfil', [\App\Http\Controllers\SpotController::class, 'perfil'])->name("usuario");
    Route::put('/updateU/{id}', '\App\Http\Controllers\SpotController@updateU')->name('upadteU');
    
    /*
    RUTAS PARA ADMINISTRADOR O USUARIO
    */
    Route::get('/administrar', function () {
        return view('admin');
    });

    Route::get('/prueba', function(){
        if(Auth::user()->rol == 'Administrador'){
            return Redirect::to('buscar/admin');
        }
        else{
            return Redirect::to('dashboard');
        }
    });

});





