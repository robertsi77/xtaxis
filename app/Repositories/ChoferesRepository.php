<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\Chofer;
use App\Models\Colonia;
use App\Models\Localidad;

class ChoferesRepository{
	//funciones para Choferes
    public function getChoferes()
    {
        $choferes = Chofer::All();        
        return $choferes;
    }

    public function getChoferesPaginados()
    {
        $choferes = Chofer::paginate(10);  
        return $choferes;
    } 
    
    public function getChoferById($chofer_id)
    {
        $chofer = Chofer::find($chofer_id);        
        return $chofer;           

    }
    public function storeChofer($data)
    {   
        $user=Auth::user();        
        $chofer = New Chofer;
        $chofer->apellidos = $data->apellidos;
        $chofer->nombre = $data->nombres;        
        $chofer->rfc = $data->rfc;
        $chofer->curp = $data->curp;
        $chofer->fechanacimiento = $data->fechanacimiento;
        $chofer->sexo = $data->sexo;
        $chofer->calle= $data->calle;
        $chofer->noext= $data->noext;
        $chofer->noint= $data->noint;
        $chofer->colonia_id = $data->colonia;
        $chofer->localidad_id = $data->localidad;
        $chofer->codigopostal = $data->codigopostal;        
        $chofer->telefonocasa = $data->telefonocasa;
        $chofer->telefonocelular =$data->telefonocelular;
        $chofer->email = $data->email; 
        $chofer->tipolicencia_id = $data->tipolicencia;
        $chofer->vigencia = $data->vigencia;
        $chofer->user_id = $user->id;
        $chofer->save();
    }
    

    public function updateChofer($data)
    {        
        $user=Auth::user();   
        $chofer = Chofer::where('id', '=', $data->idChofer)->first();        
        $chofer->apellidos = $data->apellidos;
        $chofer->nombre = $data->nombres;
        $chofer->rfc = $data->rfc;
        $chofer->curp = $data->curp;
        $chofer->fechanacimiento = $data->fechanacimiento;
        $chofer->sexo = $data->sexo;
        $chofer->calle = $data->calle;
        $chofer->noext = $data->noext;
        $chofer->noint = $data->noint;
        $chofer->colonia_id = $data->colonia;
        $chofer->localidad_id = $data->localidad;
        $chofer->codigopostal = $data->codigopostal;        
        $chofer->telefonocasa = $data->telefonocasa;
        $chofer->telefonocelular = $data->telefonocelular;
        $chofer->email = $data->email;
        $chofer->tipolicencia_id = $data->tipolicencia;
        $chofer->vigencia = $data->vigencia;
        $chofer->user_id = $user->id;
        $chofer->save();
    }

    public function deleteChofer($idChofer)
    {        
        Chofer::where('id', '=', $idChofer)->delete();        
    }

    


}