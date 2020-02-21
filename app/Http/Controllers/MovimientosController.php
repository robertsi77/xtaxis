<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MovimientosRepository;
use App\Repositories\ChoferesRepository;
use App\Repositories\TaxisRepository;
use App\Repositories\CatalogosRepository;




class MovimientosController extends Controller
{
    private $movimientosRepository;    
    private $choferesRepository;
    private $taxisRepository;
    private $catalogosRepository;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MovimientosRepository $movimientosRepository,
        ChoferesRepository $choferesRepository,
        TaxisRepository $taxisRepository,                
        CatalogosRepository $catalogosRepository
    )
    {
        $this->middleware('auth');
        $this->movimientosRepository = $movimientosRepository;     
        $this->choferesRepository = $choferesRepository;   
        $this->taxisRepository = $taxisRepository;
        $this->catalogosRepository = $catalogosRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function listadoMovimientos()     
    {
        //$movimientos = $this->movimientosRepository->getMovimientosPaginados();        
        $movimientos = $this->movimientosRepository->getMovimientosParaListado();
        return view('movimientos.movimientosList', compact('movimientos') );
    }
    

    public function newMovimiento()
    {        
        $choferes = $this->choferesRepository->getChoferes();    
        $taxis = $this->taxisRepository->getTaxis();     
        $turnos = $this->catalogosRepository->getTurnos();     
        $conceptos = $this->catalogosRepository->getConceptosIngresos();  
        return view('movimientos.movimientosNew', compact('choferes','taxis','turnos','conceptos'));
    }

    public function storeMovimiento(Request $request)
     {
        
         $this->movimientosRepository->storeMovimiento($request);     
                      
         return redirect()->route('movimientos.list')->with('message','Registro agregado satisfactoriamente!');
     }

     public function editMovimiento($movimiento_id)
     {   
        $choferes = $this->choferesRepository->getChoferes();    
        $taxis = $this->taxisRepository->getTaxis();     
        $turnos = $this->catalogosRepository->getTurnos();
        $conceptos = $this->catalogosRepository->getConceptos();  
        $movimiento = $this->movimientosRepository->getMovimientoById($movimiento_id);  
                 
        return view('movimientos.movimientosEdit',compact('choferes','taxis','turnos','conceptos','movimiento'));
     }


    public function updateMovimiento(Request $request)
    {
        $this->movimientosRepository->updateMovimiento($request);  
        return redirect()->route('movimientos.list')->with('message','Registro Actualizado Corretamente');         
    }

    public function deleteMovimiento(Request $request)
    {
        $this->movimientosRepository->deleteMovimiento($request->idmovimiento);  
        return redirect()->back()->with('message','Registro Eliminado Satisfactoriamente!');  
    }
     
    public function kilometrajeFinalMovimiento(Request $request)    
    {         
        $movimiento = $this->movimientosRepository->getKilometrajeFinal($request->idtaxi);  
        return $movimiento;
    }



}
