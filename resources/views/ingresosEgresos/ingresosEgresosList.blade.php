@extends('layouts.master_layout')

@section('content')
    <div class="box box-primary">   
        <div class="box-header">
            <div class="row">
                <div class="col-lg-8 " >
                    <h3 class="box-title"><strong>Ingresos & Egresos Listado</strong></h3>                
                </div>
                <div class="col-lg-4 text-center" >
                    <a type="button" class="btn btn-primary" href="{{ route('ingresoEgreso.new') }}">
                        Agregar
                    </a>
                </div>
            </div>            
        </div>            
    </div>
@endsection