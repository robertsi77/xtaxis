<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PropietariosRepository;
use App\Repositories\CatalogosRepository;

class PropietariosController extends Controller
{

    private $propietariosRepository;
    private $catalogosRespository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        PropietariosRepository $propietariosRepository,
        CatalogosRepository $catalogosRepository
    )
    {
        $this->middleware('auth');
        $this->propietariosRepository = $propietariosRepository;
        $this->catalogosRepository = $catalogosRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function listadoPropietarios()     
    {
        $propietarios = $this->propietariosRepository->getPropietariosPaginados();        
        return view('propietarios.propietariosList', compact('propietarios') );
    }
    

    public function newPropietario()
    {        
        $colonias = $this->catalogosRepository->getColonias();    
        $localidades = $this->catalogosRepository->getLocalidades();            
        return view('propietarios.propietariosNew', compact('colonias','localidades'));//, compact('propietarios') );  
    }

    public function storePropietario(Request $request)
    {
        
        $this->propietariosRepository->storePropietario($request);         
        //return redirect()->view('propietarios.propietariosNew', compact('colonias','localidades'));
        //return view('propietarios.propietariosNew', compact('colonias','localidades'));
        return redirect()->route('propietarios.list')->with('message','Se creo un nuevo propietario!');
    }

    public function editPropietario($propietario_id)
    {   
        $colonias = $this->catalogosRepository->getColonias();    
        $localidades = $this->catalogosRepository->getLocalidades(); 
        $propietario = $this->propietariosRepository->getPropietarioById($propietario_id);  
                 
        return view('propietarios.propietariosEdit',compact('propietario','colonias','localidades'));
    }


    public function updatePropietario(Request $request)
    {
        $this->propietariosRepository->updatePropietario($request);  
        return redirect()->route('propietarios.list')->with('message','Propietario a Sido Actualizado Corretamente');
        //return redirect()->back();  
    }

    public function deletePropietario(Request $request)
    {
        $this->propietariosRepository->deletePropietario($request->idPropietario);  
        return redirect()->back()->with('message','Registro Eliminado Satisfactoriamente!');  
    }    



}
