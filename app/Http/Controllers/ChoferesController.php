<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ChoferesRepository;
use App\Repositories\CatalogosRepository;

class ChoferesController extends Controller
{

    private $choferesRepository;
    private $catalogosRespository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ChoferesRepository $choferesRepository,
        CatalogosRepository $catalogosRepository
    )
    {
        $this->middleware('auth');
        $this->choferesRepository = $choferesRepository;
        $this->catalogosRepository = $catalogosRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function listadoChoferes()     
    {
        $choferes = $this->choferesRepository->getChoferesPaginados();        
        return view('choferes.choferesList', compact('choferes') );
    }
    

    public function newChofer()
    {        
        $colonias = $this->catalogosRepository->getColonias();    
        $localidades = $this->catalogosRepository->getLocalidades(); 
        $tiposLicencias = $this->catalogosRepository->getTiposLicencias();           
        return view('choferes.choferesNew', compact('colonias','localidades','tiposLicencias'));//, compact('propietarios') );  
    }

    public function storeChofer(Request $request)
    {
        
        $this->choferesRepository->storeChofer($request);         
        //return redirect()->view('propietarios.propietariosNew', compact('colonias','localidades'));
        //return view('propietarios.propietariosNew', compact('colonias','localidades'));
        return redirect()->route('choferes.list')->with('message','Se creo un nuevo chofer!');
    }
    public function editChofer($choferes_id)
    {   
        $colonias = $this->catalogosRepository->getColonias();    
        $localidades = $this->catalogosRepository->getLocalidades(); 
        $tiposLicencias = $this->catalogosRepository->getTiposLicencias(); 
        $chofer = $this->choferesRepository->getChoferById($choferes_id);               
        return view('choferes.choferesEdit',compact('chofer','colonias','localidades','tiposLicencias'));
    }

    public function updateChofer(Request $request)
    {
        $this->choferesRepository->updateChofer($request);  
        return redirect()->route('choferes.list')->with('message','Registro Actualizado Correctamente');
        //return redirect()->back();  
    }

    public function deleteChofer(Request $request)
    {
        $this->choferesRepository->deleteChofer($request->idChofer);  
        return redirect()->back()->with('message','Registro Eliminado Satisfactoriamente!');  
    }    



}
