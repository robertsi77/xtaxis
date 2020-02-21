<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\Liquidacion;
use App\Models\Taxi;
use App\Models\Chofer;
use App\Models\Turno;
use App\Models\Concepto;

use App\Repositories\MovimientosRepository;

class LiquidacionesRepository{
	//funciones para propietarios
    public function getLiquidaciones()
    {
        $liquidaciones = Liquidacion::All();        
        return $liquidaciones;
    }

    public function getLiquidacionesPaginados()
    {
        $liquidaciones = Liquidacion::orderBy('kilometrajefinal','desc')->get();          
        return $liquidaciones;
    } 
    
     public function getLiquidacionById($liquidacion_id)
     {
         $liquidacion = Liquidacion::find($liquidacion_id);
         return $liquidacion;           

     }
     public function storeLiquidacion($data)
     {   
         
         $user=Auth::user();        
         $liquidacion = New Liquidacion;         
         $liquidacion->origen = $data->origen;
         $liquidacion->fecha = $data->fecha;
         $liquidacion->taxi_id = $data->taxi;
         $liquidacion->chofer_id = $data->chofer;
         $liquidacion->turno_id = $data->turno;
         $liquidacion->kilometrajeinicial = $data->kilometrajeinicial;
         $liquidacion->kilometrajefinal = $data->kilometrajefinal;
         $liquidacion->liquidacion= $data->liquidacion;
         $liquidacion->gasolina= $data->gasolina;
         $liquidacion->lavado= $data->lavado;         
         $liquidacion->otrosgastos = $data->otrosgastos;
         if ($data->otrosgastos > 0){
            $liquidacion->concepto_id= $data->concepto;
            $liquidacion->descripcionotrosgastos= $data->descripcionotrosgastos;
        }
        else{
            $liquidacion->concepto_id= 0;
            $liquidacion->descripcionotrosgastos= $data->descripcionotrosgastos;
        }
         $liquidacion->comentarios= $data->comentarios;         
         $liquidacion->user_id = $user->id;
         $liquidacion->save();


        //comentamos esta seccion ya que de momento todo se guardara en la tabla de liquidaciones
        //  //mandamos insertar un movimiento como liquidacion
        //  $movimientoRepository= new MovimientosRepository;
        //  $tipo=1; //variable con valor uno para indicar que es un ingreso         
        //  $movimientoRepository->storeMovimientoLiquidacion($liquidacion, $tipo);
        //  //validamos si hay otros gastos en la liquidacion para mandar guardar un egreso   
        //  if ($liquidacion->otrosgastos > 0 ){
        //     $tipo=2; //variable con valor uno para indicar que es un egreso 
        //     $movimientoRepository->storeMovimientoLiquidacinOtrosGastos($liquidacion, $tipo);        
        //  }
         
         
     }
    

     public function updateLiquidacion($data)
     {        
        $user=Auth::user();              
        $liquidacion =  Liquidacion::where('id', '=', $data->idLiquidacion)->first();    
        $liquidacion->origen = $data->origen;         
        $liquidacion->fecha = $data->fecha;        
        $liquidacion->taxi_id = $data->taxi;
        $liquidacion->chofer_id = $data->chofer;
        $liquidacion->turno_id = $data->turno;
        $liquidacion->kilometrajeinicial = $data->kilometrajeinicial;
        $liquidacion->kilometrajefinal = $data->kilometrajefinal;
        $liquidacion->liquidacion= $data->liquidacion;
        $liquidacion->gasolina= $data->gasolina;
        $liquidacion->lavado= $data->lavado;
        $liquidacion->otrosgastos = $data->otrosgastos;
        if ($data->otrosgastos > 0){
            $liquidacion->concepto_id= $data->concepto;
            $liquidacion->descripcionotrosgastos= $data->descripcionotrosgastos;
        }
        else{
            $liquidacion->concepto_id= 0;
            $liquidacion->descripcionotrosgastos= "";
        }        
        $liquidacion->comentarios= $data->comentarios;         
        $liquidacion->user_id = $user->id;
        $liquidacion->save();
     }

     public function getKilometrajeFinal($taxi_id)
     {
        $liquidacion =  Liquidacion::where('taxi_id','=',$taxi_id)->latest()->first();             
        return $liquidacion;
     }

     public function deleteLiquidacion($idLiquidacion)
     {
         Liquidacion::where('id', '=', $idLiquidacion)->delete();
      
     }


     //Ingresos - Egresos
    public function getIngresosEgresos()
    {
        $ingresosEgresos = Liquidacion::All();        
        return $ingresosEgresos;
    }

    public function getIngresosEgresosPaginados()
    {
        $ingresosEgresos = Liquidacion::orderBy('fecha','desc')->get();          
        return $ingresosEgresos;
    } 

    //hacemos una insercion en la tabla de liquidaciones
    //pero desde la pagina de ingresos & egresos
    public function storeIngresoEgreso($data)
    {           
        $user=Auth::user();        
        $liquidacion = New Liquidacion;         
        $liquidacion->origen = $data->origen;
        $liquidacion->fecha = $data->fecha;        
        $liquidacion->liquidacion= $data->liquidacion;
        $liquidacion->otrosgastos = $data->otrosgastos;
        $liquidacion->concepto_id= $data->concepto;
        $liquidacion->comentarios= $data->comentarios;         
        $liquidacion->user_id = $user->id;
        $liquidacion->save();
        
    }
   


}