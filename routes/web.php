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
}); 

Auth::routes(); 

 Route::get('/home', 'HomeController@index')->name('home');
 //Route::get('/login', 'HomeController@login')->name('login');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', ['as' =>'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
 
// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index'); 

// Tipos de Vehiculos
Route::get('tipo-vehiculos', 'VehiculosController@listadoTipoVehiculos')->name('tipoVehiculos.List'); 
Route::post('tipo-vehiculos/store', 'VehiculosController@storeTipoVehiculo')->name('tipoVehiculos.store');
Route::post('tipo-vehiculos/update', 'VehiculosController@updateTipoVehiculo')->name('tipoVehiculos.update');
Route::post('tipo-vehiculos/delete', 'VehiculosController@deleteTipoVehiculo')->name('tipoVehiculos.delete');

//Marcas Vehiculos
Route::get('marcas-vehiculos', 'VehiculosController@listadoMarcas')->name('marcas.List'); 
Route::post('marcas-vehiculos/store', 'VehiculosController@storeMarca')->name('marcas.store');
Route::post('marcas-vehiculos/update', 'VehiculosController@updateMarca')->name('marcas.update');
Route::post('marcas-vehiculos/delete', 'VehiculosController@deleteMarca')->name('marcas.delete');

//Lineas de Vehiculos
Route::get('lineas-vehiculos', 'VehiculosController@listadoLineas')->name('lineas.List'); 
Route::post('lineas-vehiculos/store', 'VehiculosController@storeLinea')->name('lineas.store');
Route::post('lineas-vehiculos/update', 'VehiculosController@updateLinea')->name('lineas.update');
Route::post('lineas-vehiculos/delete', 'VehiculosController@deleteLinea')->name('lineas.delete');
Route::post('lineas-vehiculos/get-by-marca-id', 'VehiculosController@getByMarcaIdLineas')->name('lineas.getByMarcaId');

//Tipos de Licencias
Route::get('tipos-licencias', 'CatalogosController@listadoTiposLicencias')->name('tiposLicencias.list'); 
Route::post('tipos-licencias/store', 'CatalogosController@storeTipoLicencia')->name('tipoLicencia.store');
Route::post('tipos-licencias/update', 'CatalogosController@updateTipoLicencia')->name('tipoLicencia.update');
Route::post('tipos-licencias/delete', 'CatalogosController@deleteTipoLicencia')->name('tipoLicencia.delete');

//Conceptos Igresos/Egresos
Route::get('conceptos', 'CatalogosController@listadoConceptos')->name('conceptos.list'); 
Route::post('conceptos/store', 'CatalogosController@storeConcepto')->name('concepto.store');
Route::post('conceptos/update', 'CatalogosController@updateConcepto')->name('concepto.update');
Route::post('conceptos/delete', 'CatalogosController@deleteConcepto')->name('concepto.delete');

Route::post('conceptos/get-by-tipo', 'CatalogosController@getByTipoConcepto')->name('conceptos.getByTipoId');


//Turnos
Route::get('turnos', 'CatalogosController@listadoTurnos')->name('turnos.list'); 
Route::post('turnos/store', 'CatalogosController@storeTurno')->name('turno.store');
Route::post('turnos/update', 'CatalogosController@updateTurno')->name('turno.update');
Route::post('turnos/delete', 'CatalogosController@deleteTurno')->name('turno.delete');

//Propietarios
Route::get('propietarios', 'PropietariosController@listadoPropietarios')->name('propietarios.list'); 
Route::get('propietarios/new', 'PropietariosController@newPropietario')->name('propietario.new'); 
Route::post('propietarios/store', 'PropietariosController@storePropietario')->name('propietario.store');
Route::get('propietarios/edit/{idPropietario}', 'PropietariosController@editPropietario')->name('propietario.edit');
Route::post('propietarios/update', 'PropietariosController@updatePropietario')->name('propietario.update');
Route::post('propietarios/delete', 'PropietariosController@deletePropietario')->name('propietario.delete');

//Choferes
Route::get('choferes', 'ChoferesController@listadoChoferes')->name('choferes.list'); 
Route::get('choferes/new', 'ChoferesController@newChofer')->name('chofer.new'); 
Route::post('choferes/store', 'ChoferesController@storeChofer')->name('chofer.store'); 
Route::get('choferes/edit/{idChofer}', 'ChoferesController@editChofer')->name('chofer.edit');
Route::post('choferes/update', 'ChoferesController@updateChofer')->name('chofer.update');
Route::post('choferes/delete', 'ChoferesController@deleteChofer')->name('chofer.delete');

//Taxis
Route::get('taxis', 'TaxisController@listadoTaxis')->name('taxis.list'); 
Route::get('taxis/new', 'TaxisController@newTaxi')->name('taxi.new');
Route::post('taxis/store', 'TaxisController@storeTaxi')->name('taxi.store');  
Route::get('taxis/edit/{idTaxi}', 'TaxisController@editTaxi')->name('taxi.edit');
Route::post('taxis/update', 'TaxisController@updateTaxi')->name('taxi.update');
Route::post('taxis/delete', 'TaxisController@deleteTaxi')->name('taxi.delete');

//Liquidaciones
Route::get('liquidaciones', 'LiquidacionController@listadoLiquidaciones')->name('liquidaciones.list'); 
Route::get('liquidaciones/new', 'liquidacionController@newLiquidacion')->name('liquidacion.new');
Route::post('liquidaciones/store', 'liquidacionController@storeLiquidacion')->name('liquidacion.store');  
Route::get('liquidaciones/edit/{idLiquidacion}', 'liquidacionController@editLiquidacion')->name('liquidacion.edit');
Route::post('liquidaciones/update', 'LiquidacionController@updateLiquidacion')->name('liquidacion.update');
Route::post('liquidaciones/delete', 'LiquidacionController@deleteLiquidacion')->name('liquidacion.delete');

Route::post('liquidaciones/obtiene-kilometraje-final', 'LiquidacionController@kilometrajeFinalLiquidacion')->name('liquidacion.kilometrajeFinal');

//IngresosEgresos
Route::get('ingresos-egresos', 'LiquidacionController@listadoIngresosEgresos')->name('ingresosEgresos.list'); 
Route::get('ingresos-egresos/new', 'liquidacionController@newIngresoEgreso')->name('ingresoEgreso.new');
Route::post('ingresos-egresos/store', 'liquidacionController@storeIngresoEgreso')->name('ingresoEgreso.store'); 
Route::post('ingreso-egreso/get-conceto-by-tipo', 'liquidacionController@getConceptoByTipoIngresoEgreso')->name('ingresoEgreso.getConceptoByTipo');


//Movimientos
Route::get('movimientos', 'MovimientosController@listadoMovimientos')->name('movimientos.list'); 
Route::get('movimientos/new', 'MovimientosController@newMovimiento')->name('movimiento.new');
Route::post('movimientos/store', 'MovimientosController@storeMovimiento')->name('movimiento.store'); 
Route::get('movimientos/edit/{idmovimiento}', 'MovimientosController@editMovimiento')->name('movimiento.edit'); 
Route::post('movimientos/update', 'MovimientosController@updateMovimiento')->name('movimiento.update');
Route::post('movimientos/obtiene-kilometraje-final', 'MovimientosController@kilometrajeFinalMovimiento')->name('movimiento.kilometrajeFinal');



