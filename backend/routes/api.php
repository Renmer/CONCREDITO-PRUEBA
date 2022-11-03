<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProspectoController;
use App\Http\Controllers\DocumentoController;
use App\Models\EstatusModel;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('prospecto',ProspectoController::class);


Route::apiResource('documento',DocumentoController::class);

Route::post('/archivo',function(Request $request){
    return \response()->download($request->input('url'));
});

Route::post('/estatus',function(Request $request){
    $catalogo_estatus = new EstatusModel();
    $catalogo_estatus->set_prospecto_id($request->input('prospecto_id'));
    $catalogo_estatus->set_estatus($request->input('estatus'));
    $catalogo_estatus->set_observaciones($request->input('observaciones'));
    if($catalogo_estatus->actualizar_prospecto_estatus($catalogo_estatus)){
        return \response('Actualizado');
    }
    else{
        return \response('No se pudo actualizar');
    }
    

});

