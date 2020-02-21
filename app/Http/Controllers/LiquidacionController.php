<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LiquidacionesRepository;
use App\Repositories\TaxisRepository;
use App\Repositories\ChoferesRepository;
use App\Repositories\CatalogosRepository;




class LiquidacionController extends Controller
{

    private $liquidacionesRepository;
    private $taxisRepository;
    private $choferesRepository;
    private $catalogosRepository;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        LiquidacionesRepository $liquidacionesRepository,
        TaxisRepository $taxisRepository,
        ChoferesRepository $choferesRepository,
        CatalogosRepository $catalogosRepository
    )
    {
        $this->middleware('auth');
        $this->liquidacionesRepository = $liquidacionesRepository;
        $this->taxisRepository = $taxisRepository;
        $this->choferesRepository = $choferesRepository;
        $this->catalogosRepository = $catalogosRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function listadoLiquidaciones()     
    {
        $liquidaciones = $this->liquidacionesRepository->getLiquidacionesPaginados();        
        return view('liquidaciones.liquidacionesList', compact('liquidaciones') );
    }
    

    public function newLiquidacion()
    {        
        $choferes = $this->choferesRepository->getChoferes();    
        $taxis = $this->taxisRepository->getTaxis();     
        $turnos = $this->catalogosRepository->getTurnos();     
        $conceptos = $this->catalogosRepository->getConceptosEgresos();  
        return view('liquidaciones.liquidacionesNew', compact('choferes','taxis','turnos','conceptos'));//, compact('propietarios') );  
    }

     public function storeLiquidacion(Request $request)
     {
        
         $this->liquidacionesRepository->storeLiquidacion($request);     
                      
         return redirect()->route('liquidaciones.list')->with('message','Registro agregado satisfactoriamente!');
     }

     public function editLiquidacion($liquidacion_id)
     {   
        $choferes = $this->choferesRepository->getChoferes();    
        $taxis = $this->taxisRepository->getTaxis();     
        $turnos = $this->catalogosRepository->getTurnos();
        $conceptos = $this->catalogosRepository->getConceptosEgresos();  
        $liquidacion = $this->liquidacionesRepository->getLiquidacionById($liquidacion_id);  
                 
        return view('liquidaciones.liquidacionesEdit',compact('choferes','taxis','turnos','conceptos','liquidacion'));
     }


     public function updateLiquidacion(Request $request)
     {
         $this->liquidacionesRepository->updateLiquidacion($request);  
         return redirect()->route('liquidaciones.list')->with('message','Registro Actualizado Corretamente');         
     }

     public function deleteLiquidacion(Request $request)
     {
         $this->liquidacionesRepository->deleteLiquidacion($request->idLiquidacion);  
         return redirect()->back()->with('message','Registro Eliminado Satisfactoriamente!');  
     }
     
     public function kilometrajeFinalLiquidacion(Request $request)
     {         
        $liquidacion = $this->liquidacionesRepository->getKilometrajeFinal($request->idtaxi);  
        return $liquidacion;
     }

     //Ingresos-Egresos

     public function listadoIngresosEgresos()     
    {
        $ingresosEgresos = $this->liquidacionesRepository->getIngresosEgresosPaginados();        
        return view('ingresosEgresos.ingresosEgresosList', compact('ingresosEgresos') );
    }

    public function newIngresoEgreso()
    {                    
        $conceptos = $this->catalogosRepository->getConceptos();  
        return view('ingresosEgresos.ingresosEgresosNew', compact('conceptos'));
    }

    public function getConceptoByTipo()
    {

    }

    public function getByMarcaIdLineas(Request $request)
    {
       $lineas = $this->vehiculosRepository->getByMarcaIdLineas($request->idmarca);  
        return $lineas;
    }

}
