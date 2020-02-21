<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\Taxi;
use App\Models\Propietario;
use App\Models\TipoVehiculo;
use App\Models\MarcaVehiculo;
use App\Models\LineaVehiculo;

class TaxisRepository{
	//funciones para propietarios
    public function getTaxis()
    {
        $taxis = Taxi::All();        
        return $taxis;
    }

    public function getTaxisPaginados()
    {
        $taxis = Taxi::paginate(10);  
        return $taxis;
    } 
    
    public function getTaxiById($taxi_id)
    {
        $taxi = Taxi::find($taxi_id);
        return $taxi;           
    }

    public function storeTaxi($data)
    {       
        $user=Auth::user();        
        $taxi = New Taxi;
        $taxi->propietario_id = $data->propietario;
        $taxi->sitio = $data->sitio;
        $taxi->numeroeconomico = $data->numeroeconomico;
        $taxi->placas = $data->placas;
        $taxi->numeroserie = $data->numeroserie;
        $taxi->marca_id = $data->marca;
        $taxi->linea_id = $data->linea;
        $taxi->tipovehiculo_id = $data->tipovehiculo;
        $taxi->kilometrajeactual = $data->kilometrajeactual;
        $taxi->serviciocada = $data->serviciocada;
        $taxi->fechaultimoservicio = $data->fechaultimoservicio;
        $taxi->kilometrajeultimoservicio = $data->kilometrajeultimoservicio;
        $taxi->user_id = $user->id;
        $taxi->save();
    }
    
    public function updateTaxi($data)
    {       
        $user=Auth::user();        
        $taxi = Taxi::where('id', '=', $data->idTaxi)->first();                   
        $taxi->propietario_id = $data->propietario;
        $taxi->sitio = $data->sitio;
        $taxi->numeroeconomico = $data->numeroeconomico;
        $taxi->placas = $data->placas;
        $taxi->numeroserie = $data->numeroserie;
        $taxi->marca_id = $data->marca;
        $taxi->linea_id = $data->linea;
        $taxi->tipovehiculo_id = $data->tipovehiculo;
        $taxi->kilometrajeactual = $data->kilometrajeactual;
        $taxi->serviciocada = $data->serviciocada;
        $taxi->fechaultimoservicio = $data->fechaultimoservicio;
        $taxi->kilometrajeultimoservicio = $data->kilometrajeultimoservicio;
        $taxi->user_id = $user->id;
        $taxi->save();
    }

    public function deleteTaxi($idTaxi)
    {
        Taxi::where('id', '=', $idTaxi)->delete();
        
    }

    
    


}