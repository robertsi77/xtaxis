@extends('layouts.master_layout')

@section('content')

<div class="box box-primary">
    <div class="box-header">
        <div class="row">
            <div class="col-lg-8 " >
                <h3 class="box-title"><strong>Listado Tipos de Licencias</strong></h3>                
            </div>
            <div class="col-lg-4 text-center" >
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-new-tipoLicencia">
                    Agregar
                </button>
            </div>
        </div>        
    </div>

    <div class="box-body">
        {{-- <a href="#" role="button" data-toogle="modal" data-target="#modal-new-tipoVehiculo"  class="btn btn-primary" id="btn-new-tipoVehiculo">Agregar</a> --}}
        {{-- <a href="#modal-new-tipoVehiculo" data-toogle="modal" role="button" class="btn btn-primary" data-target="#modal-new-tipoVehiculo" id="btn-new-tipoVehiculo">Agregar</a> --}}
        
        @if( count($tiposLicencias) >0)
            <table id="tiposlicencias" class="display table table-hover" cellspacing="0" width="100%">            
                <thead>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th>Tipo de Licencia</th> 
                        <th>Acción</th>                                         
                    </tr>
                </thead>      
                @foreach($tiposLicencias as $tipoLicencia)      
                    <tr role="row" class="odd">                        
                        <td class="sorting_1">{{ $tipoLicencia->id }}</td>
                        <td>{{ $tipoLicencia->tipoLicencia }}</td> 
                        <td>
                            <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-edit-tipoLicencia" role="button" data-idtipolicencia="{{$tipoLicencia->id}}" data-tipolicencia="{{$tipoLicencia->tipoLicencia}}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-tipoLicencia" role="button" data-idtipolicencia="{{$tipoLicencia->id}}" data-tipolicencia="{{$tipoLicencia->tipoLicencia}}"><i class="fa fa-trash"></i></i></button>
                        </td>                       
                    </tr>                
                @endforeach    
            </table>  
            {{$tiposLicencias->links() }} 
        @else 
            
        @endif    
    </div>

     {{-- Modal para agregar un nuevo marca de vehiculo --}}
     <div class="modal fade"  tabindex="-1" role="dialog" id="modal-new-tipoLicencia">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Tipo de Licencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="nuevo_tipolicencia"  method="post" action="{{ route('tipoLicencia.store') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:12vh;">
                        {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Tipo de Licencia</label>
                             <input type="text" class="form-control" id="tipoLicencia" name="tipoLicencia" placeholder="Tipo de Licencia" >
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
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-edit-tipoLicencia">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Tipo de Licencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edita_tipoLicencia"  method="post" action="{{ route('tipoLicencia.update') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Tipo de Licencia</label>
                            <input type="hidden" name="idTipoLicencia">
                            <input type="text" class="form-control" id="tipoLicencia" name="tipoLicencia" placeholder="Tipo de Licencia" >
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
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-delete-tipoLicencia">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Tipo de Licencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elimina_tipoLicenia"  method="post" action="{{ route('tipoLicencia.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Tipo de Licencia</label>
                            <input type="hidden" name="idTipoLicencia">
                            <input type="text" class="form-control" id="tipoLicencia" name="tipoLicencia" placeholder="Tipo de Licencia" >
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
            $('#modal-edit-tipoLicencia').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idtipolicencia = button.data('idtipolicencia'),                            
                    tipolicencia = button.data('tipolicencia');
                        
                var modal = $(this);
                modal.find('input[name="idTipoLicencia"]').val(idtipolicencia);
                modal.find('input[name="tipoLicencia"]').val(tipolicencia);    
            });

            $('#modal-delete-tipoLicencia').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idtipolicencia = button.data('idtipolicencia'),
                    tipolicencia = button.data('tipolicencia');
                        
                var modal = $(this);
                modal.find('input[name="idTipoLicencia"]').val(idtipolicencia);
                modal.find('input[name="tipoLicencia"]').val(tipolicencia);    
            }); 
        });        
    </script>
@endsection

