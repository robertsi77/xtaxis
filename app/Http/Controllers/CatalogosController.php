<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CatalogosRepository;

class CatalogosController extends Controller
{

    private $catalogosRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CatalogosRepository $catalogosRepository
    )
    {
        $this->middleware('auth');
        $this->catalogosRepository = $catalogosRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function listadoTiposLicencias()     
    {
        $tiposLicencias = $this->catalogosRepository->getTiposLicenciasPaginados();        
         
        // $tipoVehiculos = tipoVehiculos::paginate(5);
        // return view('vehiculos.tipoVehiculos.tipoVehiculosList')->with('tipoVehiculos',$tipoVehiculos);
        return view('catalogos.tiposLicenciasList', compact('tiposLicencias') );
    }

    public function storeTipoLicencia(Request $request){
        $this->catalogosRepository->storeTipoLicencia($request);  
        return redirect()->back();      
    }

    public function updateTipoLicencia(Request $request)
    {
        $this->catalogosRepository->updateTipoLicencia($request);  
        return redirect()->back();  
    }

    public function deleteTipoLicencia(Request $request)
    {
        $this->catalogosRepository->deleteTipoLicencia($request->idTipoLicencia);  
        return redirect()->back();  
    }

    //Turnos    

    public function listadoTurnos()     
    {
        $turnos = $this->catalogosRepository->getTurnosPaginados();     
        return view('catalogos.turnosList', compact('turnos') );
    }

    public function storeTurno(Request $request){
        $this->catalogosRepository->storeTurno($request);  
        return redirect()->back();      
    }

    public function updateTurno(Request $request)
    {
        $this->catalogosRepository->updateTurno($request);  
        return redirect()->back();  
    }

    public function deleteTurno(Request $request)
    {
        $this->catalogosRepository->deleteTurno($request->idTurno);  
        return redirect()->back();  
    }

    //Conceptos
    public function listadoConceptos()     
    {
        $conceptos = $this->catalogosRepository->getConceptosPaginados();     
        return view('catalogos.conceptosList', compact('conceptos') );
    }

    public function storeConcepto(Request $request){
        $this->catalogosRepository->storeConcepto($request);  
        return redirect()->back();      
    }

    public function updateConcepto(Request $request)
    {
        $this->catalogosRepository->updateConcepto($request);  
        return redirect()->back();  
    }

    public function deleteConcepto(Request $request)
    {
        $this->catalogosRepository->deleteConcepto($request->idconcepto);  
        return redirect()->back();  
    }

    public function getByTipoConcepto(Request $request)
    {        
        $conceptos= $this->catalogosRepository->getByTipoConcepto($request->idtipo);
        return $conceptos;  

    }




}
