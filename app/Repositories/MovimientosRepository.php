<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\Movimiento;
use App\Models\Concepto;


class MovimientosRepository{
	//funciones para Movimientos
    public function getMovimientos()
    {
        $movimientos = Movimiento::All();        
        return $movimientos;
    }

    public function getMovimientosPaginados()
    {
        $movimientos = Movimiento::paginate(25);          
        return $movimientos;
    } 
    
    public function getMovimientoById($movimiento_id)
    {
        $movimientos = Movimiento::find($movimiento_id);
        return $movimientos;           
    }

    public function getMovimientosParaListado()
    {
        $movimientos = DB::select('SELECT m1.id,
                                        m1.fecha,
                                        m1.taxi_id,
                                        t.numeroeconomico,
                                        m1.chofer_id,
                                        m1.tipo,
                                        m1.concepto_id,
                                        c.concepto,
                                        m1.monto,
                                        CASE m1.tipo
                                                WHEN 1 THEN m1.monto
                                                ELSE 0
                                        END AS Ingreso,
                                        CASE m1.tipo
                                                WHEN 2 THEN m1.monto
                                                ELSE 0
                                        END AS Egreso,
                                        SUM(CASE m2.tipo WHEN 1 THEN m2.monto ELSE 0 END ) -  SUM(CASE m2.tipo WHEN 2 THEN m2.monto ELSE 0 END ) AS Total       
                                FROM movimientos m1 INNER JOIN
                                movimientos m2 ON (m2.id<=m1.id) INNER JOIN
                                taxis t ON t.id = m1.taxi_id INNER JOIN
                                conceptos c ON c.id = m1.concepto_id
                                GROUP BY m1.id
                                ORDER BY m1.fecha DESC,t.numeroeconomico,m1.created_at DESC');
       

        return $movimientos; 

        
    }
     
    public function storeMovimiento($data)
    {   
        $user=Auth::user();        
        $movimiento = New Movimiento;   
        $movimiento->fecha = $data->fecha;               
        $movimiento->tipo = $data->tipo;
        $movimiento->concepto_id = $data->concepto;
        $movimiento->monto = $data->monto;     
        $movimiento->taxi_id = $data->taxi;   
        if ($data->concepto ==1)
        {
            $movimiento->chofer_id = $data->chofer;
            $movimiento->turno_id = $data->turno;
            $movimiento->kminicial = $data->kminicial;
            $movimiento->kmfinal = $data->kmfinal;
            $movimiento->gasolina = $data->gasolina;
            $movimiento->lavado = $data->lavado;            
        }
        else
        {
            $movimiento->chofer_id = 0;
            $movimiento->turno_id = 0;
            $movimiento->kminicial = 0;
            $movimiento->kmfinal = 0;
            $movimiento->gasolina = 0;
            $movimiento->lavado = 0;
        }
        $movimiento->comentarios = $data->comentarios;
        $movimiento->user_id = $user->id;
        $movimiento->creadopor= $user->id;
        $movimiento->save();
    }  

   

     public function updateMovimiento($data)
     {        
        $user=Auth::user();              
        $movimiento =  Movimiento::where('id', '=', $data->idmovimiento)->first();             
        $movimiento->fecha = $data->fecha;               
        $movimiento->tipo = $data->tipo;
        $movimiento->concepto_id = $data->concepto;
        $movimiento->monto = $data->monto;     
        $movimiento->taxi_id = $data->taxi;   
        if ($data->concepto ==1)
        {
            $movimiento->chofer_id = $data->chofer;
            $movimiento->turno_id = $data->turno;
            $movimiento->kminicial = $data->kminicial;
            $movimiento->kmfinal = $data->kmfinal;
            $movimiento->gasolina = $data->gasolina;
            $movimiento->lavado = $data->lavado;            
        }
        else
        {
            $movimiento->chofer_id = 0;
            $movimiento->turno_id = 0;
            $movimiento->kminicial = 0;
            $movimiento->kmfinal = 0;
            $movimiento->gasolina = 0;
            $movimiento->lavado = 0;
        }
        $movimiento->comentarios = $data->comentarios;        
        $movimiento->modificadopor= $user->id;
     }

     public function getKilometrajeFinal($taxi_id)
     {
        $movimiento =  Movimiento::where('taxi_id','=',$taxi_id)->where('tipo','=','1')->latest()->first();                     
        return $movimiento;
     }

    //  public function deleteMovimiento($idmovimiento)
    //  {
    //      Movimiento::where('id', '=', $idmovimiento)->delete();      
    //  }
}