@extends('layouts.master_layout')

@section('content')
    <div class="box box-primary">   
        <div class="box-header">
            <div class="row">
                <div class="col-lg-8 " >
                    <h3 class="box-title"><strong>Listado Lineas de Vehículos</strong></h3>                
                </div>
                <div class="col-lg-4 text-center" >
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-new-linea">
                        Agregar
                    </button>
                </div>
            </div>
            
        </div>            
    </div>   
     
    <div class="box-body">
        {{-- <a href="#" role="button" data-toogle="modal" data-target="#modal-new-tipoVehiculo"  class="btn btn-primary" id="btn-new-tipoVehiculo">Agregar</a> --}}
        {{-- <a href="#modal-new-tipoVehiculo" data-toogle="modal" role="button" class="btn btn-primary" data-target="#modal-new-tipoVehiculo" id="btn-new-tipoVehiculo">Agregar</a> --}}
        
        @if( count($lineas) >0)
            <table id="lineas_vehiculos" class="display table table-hover" cellspacing="0" width="100%">            
                <thead>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th>Linea</th> 
                        <th>Acción</th>                                         
                    </tr>
                </thead>      
                @foreach($lineas as $linea)      
                    <tr role="row" class="odd">                        
                        <td class="sorting_1">{{ $linea->id }}</td>
                        <td>{{ $linea->linea }}</td> 
                        <td>
                            <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-edit-linea" role="button" data-idlinea="{{$linea->id}}"  data-idmarca="{{ $linea->marca_id }}" data-linea="{{$linea->linea}}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-linea" role="button" data-idlinea="{{$linea->id}}" data-idmarca="{{ $linea->marca_id }}" data-linea="{{$linea->linea}}"><i class="fa fa-trash"></i></i></button>
                        </td>                       
                    </tr>                
                @endforeach    
            </table>  
            {{$lineas->links() }} 
        @else 
            
        @endif    
    </div>

    
    {{-- Modal para agregar un nuevo linea de vehiculo --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-new-linea">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Agregar Linea de Vehículo</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="nuevo_linea"  method="post" action="{{ route('lineas.store') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                        {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                        <div class="box-body col-xs-12">
                            <label for="nombre">Marca de Vehículo</label>
                            <select class="form-control" id="marca_id" name="marca_id">
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->marca }}</option>                                    
                                @endforeach                                    
                            </select>
                        </div>             
                        <div class="box-body col-xs-12">
                            <label for="nombre">Linea</label>
                             <input type="text" class="form-control" id="linea" name="linea" placeholder="Linea de Vehículo" >
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

     {{-- Modal para Editar un lina de vehiculo --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-edit-linea">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Editar Linea de Vehículo</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edita_liena"  method="post" action="{{ route('lineas.update') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="box-body col-xs-12">
                            <label for="nombre">Marca de Vehículo</label>
                            <select class="form-control" id="marca_id" name="marca_id">
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->marca }}</option>                                    
                                @endforeach                                    
                            </select>
                        </div>                
                        <div class="box-body col-xs-12">
                            <label for="nombre">Linea de Vehículo</label>
                            <input type="hidden" name="idLinea">
                            <input type="text" class="form-control" id="linea" name="linea" placeholder="Linea de Vehículo" >
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

     {{-- Modal para Eliminar un lina de vehiculo --}}
     <div class="modal fade"  tabindex="-1" role="dialog" id="modal-delete-linea">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Eliminar Linea de Vehículo</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elimina_linea"  method="post" action="{{ route('lineas.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="box-body col-xs-12">
                            <label for="nombre">Marca de Vehículo</label>
                            <select class="form-control" id="marca_id" name="marca_id">
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->marca }}</option>                                    
                                @endforeach                                    
                            </select>
                        </div>                
                        <div class="box-body col-xs-12">
                            <label for="nombre">Linea de Vehículo</label>
                            <input type="hidden" name="idLinea">
                            <input type="text" class="form-control" id="linea" name="linea" placeholder="Linea de Vehículo" >
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
            $('#modal-edit-linea').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idlinea = button.data('idlinea'), 
                    marca_id = button.data('idmarca');        
                    linea = button.data('linea');
                        
                var modal = $(this);
                modal.find('input[name="idLinea"]').val(idlinea);
                modal.find('select[name="marca_id"]').val(marca_id);
                modal.find('input[name="linea"]').val(linea);    
            });

            $('#modal-delete-linea').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idlinea = button.data('idlinea'),       
                    marca_id = button.data('idmarca');       
                    linea = button.data('linea');
                        
                var modal = $(this);
                modal.find('input[name="idLinea"]').val(idlinea);
                modal.find('select[name="marca_id"]').val(marca_id);
                modal.find('input[name="linea"]').val(linea);    
            }); 
        });        
    </script>
@endsection