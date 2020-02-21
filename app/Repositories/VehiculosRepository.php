<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

//Modelos
use App\Models\TipoVehiculo;
use App\Models\MarcaVehiculo;
use App\Models\LineaVehiculo;


class VehiculosRepository{
	//Tipos de Vehiculos
    public function getTiposVehiculos()
    {
        $tiposVehiculos = TipoVehiculo::All();        
        return $tiposVehiculos;
    }

    public function getTiposVehiculosPaginados()
    {
        $tiposVehiculos = TipoVehiculo::paginate(5);  
        return $tiposVehiculos;
    }

    public function storeTipoVehiculo($data)
    {
        $tipoVehiculo = New TipoVehiculo;
        $tipoVehiculo->tipoVehiculo = $data->tipoVehiculo;
        $tipoVehiculo->save();
    }

    public function updateTipoVehiculo($data)
    {
        $tipoVehiculo =  TipoVehiculo::where('id', '=', $data->idTipoVehiculo)->first();
        $tipoVehiculo->tipoVehiculo = $data->tipoVehiculo;
        $tipoVehiculo->save();
    }

    public function deleteTipoVehiculo($idTipoVehiculo)
    {
        TipoVehiculo::where('id', '=', $idTipoVehiculo)->delete();
        
    }

    //Marcas
    public function getMarcas()
    {
        $marcas = MarcaVehiculo::orderBy('marca')->get();        
        return $marcas;
    }

    public function getMarcasPaginados()
    {
        $marcas = MarcaVehiculo::paginate(10);  
        return $marcas;
    }

    public function storeMarcaVehiculo($data)
    {
        $marca = New MarcaVehiculo;
        $marca->marca = $data->marca;
        $marca->save();
    }

    public function updateMarcaVehiculo($data)
    {
        $marca =  MarcaVehiculo::where('id', '=', $data->idMarca)->first();
        $marca->marca = $data->marca;
        $marca->save();
    }

    public function deleteMarcaVehiculo($idMarca)
    {
        MarcaVehiculo::where('id', '=', $idMarca)->delete();
        
    }

    //Lineas
    public function getLineas()
    {
        $lineas = LineaVehiculo::All();        
        return $lineas;
    }

    public function getLineasPaginados()
    {
        $lineas = LineaVehiculo::paginate(10);  
        return $lineas;
    }

    public function storeLineaVehiculo($data)
    {
        $linea = New LineaVehiculo;
        $linea->marca_id = $data->marca_id;
        $linea->linea = $data->linea;
        $linea->save();
    }

    public function updateLineaVehiculo($data)
    {
        $linea =  LineaVehiculo::where('id', '=', $data->idLinea)->first();
        $linea->marca_id = $data->marca_id;
        $linea->linea = $data->linea;
        $linea->save();
    }

    public function deleteLineaVehiculo($idLinea)
    {
         LineaVehiculo::where('id', '=', $idLinea)->delete();
        
        
    }
    public function getByMarcaIdLineas($idmarca)
    {
        $lineas = LineaVehiculo::where('marca_id','=',$idmarca)->get();
        return $lineas;
    }


}