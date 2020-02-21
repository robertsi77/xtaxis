<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaxisRepository;
use App\Repositories\PropietariosRepository;
use App\Repositories\CatalogosRepository;
use App\Repositories\VehiculosRepository;

class TaxisController extends Controller
{

    private $taxisRepository;
    private $propietariosRepository;
    private $catalogosRepository;
    private $vehiculosRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        TaxisRepository $taxisRepository,        
        PropietariosRepository $propietariosRepository,
        CatalogosRepository $catalogosRepository,
        VehiculosRepository $vehiculosRepository
    )
    {
        $this->middleware('auth');
        $this->taxisRepository = $taxisRepository;
        $this->propietariosRepository = $propietariosRepository;
        $this->catalogosRepository = $catalogosRepository;
        $this->vehiculosRepository = $vehiculosRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function listadoTaxis()     
    {
        $taxis = $this->taxisRepository->getTaxisPaginados();        
        return view('taxis.taxisList', compact('taxis') );
    }
    
    public function newTaxi()
    {   
        $propietarios = $this->propietariosRepository->getPropietarios();        
        $marcas = $this->vehiculosRepository->getMarcas();
        $lineas = $this->vehiculosRepository->getLineas();
        $tiposVehiculos = $this->vehiculosRepository->getTiposVehiculos();
                   
        return view('taxis.taxisNew', compact('propietarios','marcas','lineas','tiposVehiculos'));//, compact('propietarios') );  
    }

    public function storeTaxi(Request $request)
    {        
        $this->taxisRepository->storeTaxi($request);                 
        return redirect()->route('taxis.list')->with('message','Se creo un nuevo registro!');
    }

    public function editTaxi($taxi_id)
    {   
        $propietarios = $this->propietariosRepository->getPropietarios();        
        $marcas = $this->vehiculosRepository->getMarcas();
        $lineas = $this->vehiculosRepository->getLineas();
        $tiposVehiculos = $this->vehiculosRepository->getTiposVehiculos();
        $taxi = $this->taxisRepository->getTaxiById($taxi_id);  
                 
        return view('taxis.taxisEdit',compact('propietarios','marcas','lineas','taxi','tiposVehiculos'));
    }


    public function updateTaxi(Request $request)
    {
        $this->taxisRepository->updateTaxi($request);  
        return redirect()->route('taxis.list')->with('message','Taxi a Sido Actualizado Corretamente');
        //return redirect()->back();  
    }

    public function deleteTaxi(Request $request)
    {
        $this->taxisRepository->deleteTaxi($request->idTaxi);  
        return redirect()->back()->with('message','Registro Eliminado Satisfactoriamente!');  
    }    


    


}
