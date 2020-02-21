@extends('layouts.master_layout')

@section('content')
    <div class="box box-primary">   
        <div class="box-header">
            <div class="row">
                <div class="col-lg-8 " >
                    <h3 class="box-title"><strong>Listado Taxis</strong></h3>                
                </div>
                <div class="col-lg-4 text-center" >
                    <a type="button" class="btn btn-primary" href="{{ route('taxi.new') }}">
                        Agregar
                    </a>
                </div>
            </div>            
        </div>            
    </div>
    @if(session()->has('message'))
        <br>
        <div class="alert alert-success text-center" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="box-body">
        {{-- <a href="#" role="button" data-toogle="modal" data-target="#modal-new-tipoVehiculo"  class="btn btn-primary" id="btn-new-tipoVehiculo">Agregar</a> --}}
        {{-- <a href="#modal-new-tipoVehiculo" data-toogle="modal" role="button" class="btn btn-primary" data-target="#modal-new-tipoVehiculo" id="btn-new-tipoVehiculo">Agregar</a> --}}
        
        @if( count($taxis) >0)
            <table id="taxis" class="display table table-hover" cellspacing="0" width="100%">            
                <thead>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th>Sitio</th> 
                        <th>Número Económico</th>
                        <th>Placas</th>
                        <th>Marca</th>
                        <th>Linea</th>
                        <th>Propietario</th>
                        <th>Acción</th>                                         
                    </tr>
                </thead>      
                @foreach($taxis as $taxi)      
                    <tr role="row" class="odd">                        
                        <td class="sorting_1">{{ $taxi->id }}</td>
                        <td>{{ $taxi->sitio }}</td> 
                        <td>{{ $taxi->numeroeconomico }}</td>
                        <td>{{ $taxi->placas }}</td>
                        <td>{{ $taxi->marca->marca }}</td>
                        <td>{{ $taxi->linea->linea }}</td>
                        <td>{{ $taxi->propietario->apellidos }} {{ $taxi->propietario->nombre }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('taxi.edit',['id'=> $taxi->id]) }}"><i class="fa fa-edit"></i></a>
                            {{-- <a class="btn btn-danger btn-sm" href="{{ route('propietario.delete',['id'=> $propietario->id]) }}"><i class="fa fa-trash"></i></a> --}}
                            <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-taxi" role="button" data-idtaxi="{{$taxi->id}}" data-numeroeconomico="{{$taxi->numeroeconomico}}"><i class="fa fa-trash"></i></i></button>
                        </td>                       
                    </tr>                
                @endforeach    
            </table>  
            {{$taxis->links() }} 
        @else 
            
        @endif    
    </div>
     {{-- Modal para Eliminar un lina de Propietario --}}
     <div class="modal fade"  tabindex="-1" role="dialog" id="modal-delete-taxi">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Eliminar Taxi</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elimina_propietario"  method="post" action="{{ route('taxi.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                            
                        <div class="box-body col-xs-12">
                            <label for="nombre">Taxi</label>
                            <input type="hidden" name="idTaxi">
                            <input type="text" class="form-control" id="numeroeconomico" name="numeroeconomico" placeholder="Número Económico" >
                        </div>            
                        {{-- </p>  --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function(){
            $('#modal-delete-taxi').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idtaxi = button.data('idtaxi'),                              
                    numeroeconomico = button.data('numeroeconomico');
                        
                var modal = $(this);
                modal.find('input[name="idTaxi"]').val(idtaxi);                
                modal.find('input[name="numeroeconomico"]').val(numeroeconomico);    
            }); 
        });        
    </script>
@endsection