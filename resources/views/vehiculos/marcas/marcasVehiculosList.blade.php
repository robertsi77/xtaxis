@extends('layouts.master_layout')

@section('content')

<div class="box box-primary">
    <div class="box-header">
        <div class="row">
            <div class="col-lg-8 " >
                <h3 class="box-title"><strong>Listado Marcas Vehículos</strong></h3>                
            </div>
            <div class="col-lg-4 text-center" >
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-new-marca">
                    Agregar
                </button>
            </div>
        </div>
        
    </div>    
    
    <div class="box-body">
        {{-- <a href="#" role="button" data-toogle="modal" data-target="#modal-new-tipoVehiculo"  class="btn btn-primary" id="btn-new-tipoVehiculo">Agregar</a> --}}
        {{-- <a href="#modal-new-tipoVehiculo" data-toogle="modal" role="button" class="btn btn-primary" data-target="#modal-new-tipoVehiculo" id="btn-new-tipoVehiculo">Agregar</a> --}}
        
        @if( count($marcas) >0)
            <table id="marcas_vehiculos" class="display table table-hover" cellspacing="0" width="100%">            
                <thead>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th>Marca</th> 
                        <th>Acción</th>                                         
                    </tr>
                </thead>      
                @foreach($marcas as $marca)      
                    <tr role="row" class="odd">                        
                        <td class="sorting_1">{{ $marca->id }}</td>
                        <td>{{ $marca->marca }}</td> 
                        <td>
                            <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-edit-marca" role="button" data-idmarca="{{$marca->id}}" data-marca="{{$marca->marca}}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-eliminar-marca" role="button" data-idmarca="{{$marca->id}}" data-marca="{{$marca->marca}}"><i class="fa fa-trash"></i></i></button>
                        </td>                       
                    </tr>                
                @endforeach    
            </table>  
            {{$marcas->links() }} 
        @else 
            
        @endif    
    </div>

    {{-- Modal para agregar un nuevo marca de vehiculo --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-new-marca">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Marca de Vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="nuevo_marca"  method="post" action="{{ route('marcas.store') }}" class="form-horizontal form_entrada">
                    <div class="modal-body">
                        {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Marca de Vehículo</label>
                             <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca de Vehículo" >
                        </div>            
                        {{-- </p>  --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal para Editar un marca de vehiculo --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-edit-marca">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Marca de Vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edita_marca"  method="post" action="{{ route('marcas.update') }}" class="form-horizontal form_entrada">
                    <div class="modal-body">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Marca de Vehículo</label>
                            <input type="hidden" name="idMarca">
                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca de Vehículo" >
                        </div>            
                        {{-- </p>  --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Modal para Eliminar un Marca de vehiculo --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-eliminar-marca">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Marca de Vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elimina_marca"  method="post" action="{{ route('marcas.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Marca de Vehículo</label>
                            <input type="hidden" name="idMarca">
                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca de Vehículo" >
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
</div>
@endsection

@section('js')
    <script>
        $(function(){
            $('#modal-edit-marca').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idmarca = button.data('idmarca'),        
                    marca = button.data('marca');
                        
                var modal = $(this);
                modal.find('input[name="idMarca"]').val(idmarca);
                modal.find('input[name="marca"]').val(marca);    
            });

            $('#modal-eliminar-marca').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idmarca = button.data('idmarca'),        
                    marca = button.data('marca');
                        
                var modal = $(this);
                modal.find('input[name="idMarca"]').val(idmarca);
                modal.find('input[name="marca"]').val(marca);    
            });
        });        
    </script>
@endsection