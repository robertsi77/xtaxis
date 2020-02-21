<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\VehiculosRepository;

class VehiculosController extends Controller
{

    private $vehiculosRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        VehiculosRepository $vehiculosRepository
    )
    {
        $this->middleware('auth');
        $this->vehiculosRepository = $vehiculosRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tiposVehiculos = $this->vehiculosRepository->getTiposVehiculos();
        return view('vehiculos.tipoVehiculos.tipoVehiculosList', compact('tiposVehiculos'));
    }

    public function agregaTipoVehiculo()
    {
        $data=Request::all();
        
    }

    public function listadoTipoVehiculos()     
    {
        $tiposVehiculos = $this->vehiculosRepository->getTiposVehiculosPaginados();        
         
        // $tipoVehiculos = tipoVehiculos::paginate(5);
        // return view('vehiculos.tipoVehiculos.tipoVehiculosList')->with('tipoVehiculos',$tipoVehiculos);
        return view('vehiculos.tipoVehiculos.tipoVehiculosList', compact('tiposVehiculos') );
    }

    public function storeTipoVehiculo(Request $request){
        $this->vehiculosRepository->storeTipoVehiculo($request);  
        return redirect()->back();      
    }

    public function updateTipoVehiculo(Request $request)
    {
        $this->vehiculosRepository->updateTipoVehiculo($request);  
        return redirect()->back();      

    }

    public function deleteTipoVehiculo(Request $request)
    {
        $this->vehiculosRepository->deleteTipoVehiculo($request->idTipoVehiculo);  
        return redirect()->back();      

    }

    // Marcas Vehiculos
    public function listadoMarcas()     
    {
        $marcas = $this->vehiculosRepository->getMarcasPaginados();        
         
        // $tipoVehiculos = tipoVehiculos::paginate(5);
        // return view('vehiculos.tipoVehiculos.tipoVehiculosList')->with('tipoVehiculos',$tipoVehiculos);
        return view('vehiculos.marcas.marcasVehiculosList', compact('marcas') );
    }

    public function storeMarca(Request $request){
        $this->vehiculosRepository->storeMarcaVehiculo($request);  
        return redirect()->back();      
    }

    public function updateMarca(Request $request)
    {
        $this->vehiculosRepository->updateMarcaVehiculo($request);  
        return redirect()->back();      

    }

    public function deleteMarca(Request $request)
    {
        $this->vehiculosRepository->deleteMarcaVehiculo($request->idMarca);  
        return redirect()->back();      

    }

    //Lineas Vehiculos
    public function listadoLineas()     
    {
        $lineas = $this->vehiculosRepository->getLineasPaginados();    
        $marcas = $this->vehiculosRepository->getMarcas();            
        
        return view('vehiculos.lineas.lineasVehiculosList', compact('lineas','marcas') );
        
    }

    public function storeLinea(Request $request){
        $this->vehiculosRepository->storeLineaVehiculo($request);  
        return redirect()->back();      
    }

    public function updateLinea(Request $request)
    {
        $this->vehiculosRepository->updateLineaVehiculo($request);  
        return redirect()->back();      

    }

    public function deleteLinea(Request $request)
    {
        $this->vehiculosRepository->deleteLineaVehiculo($request->idLinea);  
        return redirect()->back();      

    }

    public function getByMarcaIdLineas(Request $request)
    {
       $lineas = $this->vehiculosRepository->getByMarcaIdLineas($request->idmarca);  
        return $lineas;
    }
}
