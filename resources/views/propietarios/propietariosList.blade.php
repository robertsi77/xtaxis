@extends('layouts.master_layout')

@section('content')
    <div class="box box-primary">   
        <div class="box-header">
            <div class="row">
                <div class="col-lg-8 " >
                    <h3 class="box-title"><strong>Listado Propietarios</strong></h3>                
                </div>
                <div class="col-lg-4 text-center" >
                    <a type="button" class="btn btn-primary" href="{{ route('propietario.new') }}">
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
            
            @if( count($propietarios) >0)
                <table id="propietarios" class="display table table-hover" cellspacing="0" width="100%">            
                    <thead>
                        <tr>
                            <th style="width:50px">Id</th>
                            <th>Apellidos</th> 
                            <th>Nombre(s)</th>
                            <th>RFC</th>
                            <th>CURP</th>
                            <th>Acción</th>                                         
                        </tr>
                    </thead>      
                    @foreach($propietarios as $propietario)      
                        <tr role="row" class="odd">                        
                            <td class="sorting_1">{{ $propietario->id }}</td>
                            <td>{{ $propietario->apellidos }}</td> 
                            <td>{{ $propietario->nombre }}</td>
                            <td>{{ $propietario->rfc }}</td>
                            <td>{{ $propietario->curp }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('propietario.edit',['id'=> $propietario->id]) }}"><i class="fa fa-edit"></i></a>
                                {{-- <a class="btn btn-danger btn-sm" href="{{ route('propietario.delete',['id'=> $propietario->id]) }}"><i class="fa fa-trash"></i></a> --}}
                                <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-propietario" role="button" data-idpropietario="{{$propietario->id}}" data-propietario="{{$propietario->nombre}} {{$propietario->apellidos}} "><i class="fa fa-trash"></i></i></button>
                            </td>                       
                        </tr>                
                    @endforeach    
                </table>  
                {{$propietarios->links() }} 
            @else 
                
            @endif    
    </div>
    {{-- Modal para Eliminar un lina de Propietario --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-delete-propietario">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Eliminar Propietario</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elimina_propietario"  method="post" action="{{ route('propietario.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                            
                        <div class="box-body col-xs-12">
                            <label for="nombre">Propietario</label>
                            <input type="hidden" name="idPropietario">
                            <input type="text" class="form-control" id="propietario" name="propietario" placeholder="Propietario" >
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
            $('#modal-delete-propietario').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idpropietario = button.data('idpropietario'),                              
                    propietario = button.data('propietario');
                        
                var modal = $(this);
                modal.find('input[name="idPropietario"]').val(idpropietario);                
                modal.find('input[name="propietario"]').val(propietario);    
            }); 
        });        
    </script>
@endsection
