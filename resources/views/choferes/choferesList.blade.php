@extends('layouts.master_layout')

@section('content')
    <div class="box box-primary">   
        <div class="box-header">
            <div class="row">
                <div class="col-lg-8 " >
                    <h3 class="box-title"><strong>Listado Choferes</strong></h3>                
                </div>
                <div class="col-lg-4 text-center" >
                    <a type="button" class="btn btn-primary" href="{{ route('chofer.new') }}">
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
            
            @if( count($choferes) >0)
                <table id="choferes" class="display table table-hover" cellspacing="0" width="100%">            
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
                    @foreach($choferes as $chofer)      
                        <tr role="row" class="odd">                        
                            <td class="sorting_1">{{ $chofer->id }}</td>
                            <td>{{ $chofer->apellidos }}</td> 
                            <td>{{ $chofer->nombre }}</td>
                            <td>{{ $chofer->rfc }}</td>
                            <td>{{ $chofer->curp }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('chofer.edit',['id'=> $chofer->id]) }}"><i class="fa fa-edit"></i></a>
                                {{-- <a class="btn btn-danger btn-sm" href="{{ route('propietario.delete',['id'=> $propietario->id]) }}"><i class="fa fa-trash"></i></a> --}}
                                <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-chofer" role="button" data-idchofer="{{$chofer->id}}" data-chofer="{{$chofer->nombre}} {{$chofer->apellidos}} "><i class="fa fa-trash"></i></i></button>
                            </td>                       
                        </tr>                
                    @endforeach    
                </table>  
                {{$choferes->links() }} 
            @else 
                
            @endif    
    </div>
    
    {{-- Modal para Eliminar un lina de Chofer --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-delete-chofer">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Eliminar Chofer</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elimina_chofer"  method="post" action="{{ route('chofer.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                            
                        <div class="box-body col-xs-12">
                            <label for="nombre">Chofer</label>
                            <input type="hidden" name="idChofer">
                            <input type="text" class="form-control" id="chofer" name="chofer" placeholder="Chofer" >
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
            $('#modal-delete-chofer').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idchofer = button.data('idchofer'),                              
                    chofer = button.data('chofer');
                        
                var modal = $(this);
                modal.find('input[name="idChofer"]').val(idchofer);                
                modal.find('input[name="chofer"]').val(chofer);    
            }); 
        });        
    </script>
@endsection
