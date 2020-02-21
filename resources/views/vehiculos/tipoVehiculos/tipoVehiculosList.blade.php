@extends('layouts.master_layout')

@section('content')

<div class="box box-primary">
    <div class="box-header">
        <div class="row">
            <div class="col-lg-8 " >
                <h3 class="box-title"><strong>Listado Tipos de Vehiculos</strong></h3>                
            </div>
            <div class="col-lg-4 text-center" >
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-new-tipoVehiculo">
                    Agregar
                </button>
            </div>
        </div>
        
    </div>    
    <div class="box-body">
        {{-- <a href="#" role="button" data-toogle="modal" data-target="#modal-new-tipoVehiculo"  class="btn btn-primary" id="btn-new-tipoVehiculo">Agregar</a> --}}
        {{-- <a href="#modal-new-tipoVehiculo" data-toogle="modal" role="button" class="btn btn-primary" data-target="#modal-new-tipoVehiculo" id="btn-new-tipoVehiculo">Agregar</a> --}}
        
        @if( count($tiposVehiculos) >0)
            <table id="tipos_vehiculos" class="display table table-hover" cellspacing="0" width="100%">            
                <thead>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th>Tipo de Vehículo</th> 
                        <th>Acción</th>                                         
                    </tr>
                </thead>      
                @foreach($tiposVehiculos as $tipoVehiculo)      
                    <tr role="row" class="odd">                        
                        <td class="sorting_1">{{ $tipoVehiculo->id }}</td>
                        <td>{{ $tipoVehiculo->tipoVehiculo }}</td> 
                        <td>
                            <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-edit-tipoVehiculo" role="button" data-idtipovehiculo="{{$tipoVehiculo->id}}" data-tipovehiculo="{{$tipoVehiculo->tipoVehiculo}}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-eliminar-tipoVehiculo" role="button" data-idtipovehiculo="{{$tipoVehiculo->id}}" data-tipovehiculo="{{$tipoVehiculo->tipoVehiculo}}"><i class="fa fa-trash"></i></i></button>
                        </td>                       
                    </tr>                
                @endforeach    
            </table>  
            {{$tiposVehiculos->links() }} 
        @else 
            
        @endif    
    </div>

    {{-- Modal para agregar un nuevo tipo de vehiculo --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-new-tipoVehiculo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Tipo de Vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="nuevo_tipoVehiculo"  method="post" action="{{ route('tipoVehiculos.store') }}" class="form-horizontal form_entrada">
                    <div class="modal-body">
                        {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Tipo de Vehículo</label>
                            <input type="text" class="form-control" id="tipoVehiculo" name="tipoVehiculo" placeholder="Tipo de Vehículo" >
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

    {{-- Modal para Editar un Tipo de vehiculo --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-edit-tipoVehiculo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Tipo de Vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="nuevo_tipoVehiculo"  method="post" action="{{ route('tipoVehiculos.update') }}" class="form-horizontal form_entrada">
                    <div class="modal-body">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Tipo de Vehículo</label>
                            <input type="hidden" name="idTipoVehiculo">
                            <input type="text" class="form-control" id="tipoVehiculo" name="tipoVehiculo" placeholder="Tipo de Vehículo" >
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
    {{-- Modal para Eliminar un Tipo de vehiculo --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-eliminar-tipoVehiculo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Tipo de Vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="nuevo_tipoVehiculo"  method="post" action="{{ route('tipoVehiculos.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Tipo de Vehículo</label>
                            <input type="hidden" name="idTipoVehiculo">
                            <input type="text" class="form-control" id="tipoVehiculo" name="tipoVehiculo" placeholder="Tipo de Vehículo" >
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
        $('#modal-edit-tipoVehiculo').on('show.bs.modal', function (event)
        {   
            var button = $(event.relatedTarget);                    
            var idTipoVehiculo = button.data('idtipovehiculo'),        
                tipoVehiculo = button.data('tipovehiculo');
                    
            var modal = $(this);
            modal.find('input[name="idTipoVehiculo"]').val(idTipoVehiculo);
            modal.find('input[name="tipoVehiculo"]').val(tipoVehiculo);    
        });

        $('#modal-eliminar-tipoVehiculo').on('show.bs.modal', function (event)
        {   
            var button = $(event.relatedTarget);                    
            var idTipoVehiculo = button.data('idtipovehiculo'),        
                tipoVehiculo = button.data('tipovehiculo');
                    
            var modal = $(this);
            modal.find('input[name="idTipoVehiculo"]').val(idTipoVehiculo);
            modal.find('input[name="tipoVehiculo"]').val(tipoVehiculo);    
        });

    });
    
</script>

@endsection