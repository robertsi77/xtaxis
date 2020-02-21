<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//Modelos
use App\Models\TipoLicencia;
use App\Models\Turno;
use App\Models\Colonia;
use App\Models\Localidad;
use App\Models\Concepto;


class CatalogosRepository{
	//Tipos de Licencias
    public function getTiposLicencias()
    {
        $tiposLicencias = TipoLicencia::All();        
        return $tiposLicencias;
    }

    public function getTiposLicenciasPaginados()
    {
        $tiposLicencias = TipoLicencia::paginate(5);  
        return $tiposLicencias;
    }   
    public function storeTipoLicencia($data)
    {
        $tipoLicencia = New TipoLicencia;
        $tipoLicencia->tipoLicencia = $data->tipoLicencia;
        $tipoLicencia->save();
    }

    public function updateTipoLicencia($data)
    {
        $tipoLicencia =  TipoLicencia::where('id', '=', $data->idTipoLicencia)->first();
        $tipoLicencia->tipoLicencia = $data->tipoLicencia;
        $tipoLicencia->save();
    }

    public function deleteTipoLicencia($idTipoLicencia)
    {
        TipoLicencia::where('id', '=', $idTipoLicencia)->delete();
        
    }

    //turnos
    public function getTurnos()
    {
        $turnos = Turno::All();        
        return $turnos;
    }

    public function getTurnosPaginados()
    {
        $turnos = Turno::paginate(10);  
        return $turnos;
    }

    public function storeTurno($data)
    {
        $turno = New turno;
        $turno->turno = $data->turno;
        $turno->save();
    }

    public function updateTurno($data)
    {
        $turno =  Turno::where('id', '=', $data->idTurno)->first();
        $turno->turno = $data->turno;
        $turno->save();
    }

    public function deleteTurno($idTurno)
    {
        Turno::where('id', '=', $idTurno)->delete();
        
    }

    //Conceptos
    public function getConceptos()
    {
        $conceptos = Concepto::orderBy('concepto')->get();        
        return $conceptos;
    }

    public function getConceptosEgresos()
    {
        $conceptos = Concepto::where('tipo','=','2')->orderBy('concepto')->get();        
        return $conceptos;
    }

    public function getConceptosIngresos()
    {
        $conceptos = Concepto::where('tipo','=','1')->orderBy('concepto')->get();        
        return $conceptos;
    }

    public function getByTipoConcepto($tipo)
    {        
        $conceptos = Concepto::where('tipo','=',$tipo)->orderBy('concepto')->get();
        return $conceptos;
    }

    public function getConceptosPaginados()
    {
        $conceptos = Concepto::paginate(15);  
        return $conceptos;
    }

    public function storeConcepto($data)
    {
        $user=Auth::user();     
        $concepto = New Concepto;
        $concepto->tipo = $data->tipo;
        $concepto->concepto = $data->concepto;
        $concepto->creadopor = $user->id;        
        $concepto->save();
    }

    public function updateConcepto($data)
    {
        $user=Auth::user();     
        $concepto =  Concepto::where('id', '=', $data->idconcepto)->first();        
        $concepto->tipo = $data->tipo;
        $concepto->concepto = $data->concepto;
        $concepto->modificadopor = $user->id;
        $concepto->save();
    }

    public function deleteConcepto($idconcepto)
    {
        Concepto::where('id', '=', $idconcepto)->delete();
        
    }



    //colonias
    public function getColonias()
    {
        $colonias = Colonia::All();        
        return $colonias;
    }

    //Localidades
    public function getLocalidades()
    {
        $localidades = Localidad::All();
        return $localidades;
    }

   





}