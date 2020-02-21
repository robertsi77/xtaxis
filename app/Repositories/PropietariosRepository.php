<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\Propietario;
use App\Models\Colonia;
use App\Models\Localidad;

class PropietariosRepository{
	//funciones para propietarios
    public function getPropietarios()
    {
        $propietarios = Propietario::All();        
        return $propietarios;
    }

    public function getPropietariosPaginados()
    {
        $propietarios = Propietario::paginate(10);  
        return $propietarios;
    } 
    
    public function getPropietarioById($propietario_id)
    {
        $propietario = Propietario::find($propietario_id);
        return $propietario;           

    }
    public function storePropietario($data)
    {       
        $user=Auth::user();        
        $propietario = New Propietario;
        $propietario->apellidos = $data->apellidos;
        $propietario->nombre = $data->nombres;
        $propietario->rfc = $data->rfc;
        $propietario->curp = $data->curp;
        $propietario->fechanacimiento = $data->fechanacimiento;
        $propietario->sexo = $data->sexo;
        $propietario->calle= $data->calle;
        $propietario->noext= $data->noext;
        $propietario->noint= $data->noint;
        $propietario->colonia_id = $data->colonia;
        $propietario->localidad_id = $data->localidad;
        $propietario->codigopostal = $data->codigopostal;
        $propietario->referencia = $data->referencia;
        $propietario->telefonocasa = $data->telefonocasa;
        $propietario->telefonocelular =$data->telefonocelular;
        $propietario->email = $data->email; 
        $propietario->user_id = $user->id;
        $propietario->save();
    }
    

    public function updatePropietario($data)
    {        
        $user=Auth::user();   
        $propietario =  Propietario::where('id', '=', $data->idPropietario)->first();        
        $propietario->apellidos = $data->apellidos;
        $propietario->nombre = $data->nombres;
        $propietario->rfc = $data->rfc;
        $propietario->curp = $data->curp;
        $propietario->fechanacimiento = $data->fechanacimiento;
        $propietario->sexo = $data->sexo;
        $propietario->calle = $data->calle;
        $propietario->noext = $data->noext;
        $propietario->noint = $data->noint;
        $propietario->colonia_id = $data->colonia;
        $propietario->localidad_id = $data->localidad;
        $propietario->codigopostal = $data->codigopostal;
        $propietario->referencia = $data->referencia;
        $propietario->telefonocasa = $data->telefonocasa;
        $propietario->telefonocelular = $data->telefonocelular;
        $propietario->email = $data->email;
        $propietario->user_id = $user->id;
        $propietario->save();
    }

    public function deletePropietario($idPropietario)
    {
        Propietario::where('id', '=', $idPropietario)->delete();
        
    }

    


}