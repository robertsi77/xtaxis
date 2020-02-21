@extends('layouts.master_layout')

@section('content')
<div class="box box-primary">
    <div class="box-header">
        <div class="row">
            <div class="col-lg-8 " >
                <h3 class="box-title"><strong>Listado Turnos</strong></h3>                
            </div>
            <div class="col-lg-4 text-center" >
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-new-turno">
                    Agregar
                </button>
            </div>
        </div>        
    </div>

    <div class="box-body">
        {{-- <a href="#" role="button" data-toogle="modal" data-target="#modal-new-tipoVehiculo"  class="btn btn-primary" id="btn-new-tipoVehiculo">Agregar</a> --}}
        {{-- <a href="#modal-new-tipoVehiculo" data-toogle="modal" role="button" class="btn btn-primary" data-target="#modal-new-tipoVehiculo" id="btn-new-tipoVehiculo">Agregar</a> --}}
        
        @if( count($turnos) >0)
            <table id="turnos" class="display table table-hover" cellspacing="0" width="100%">            
                <thead>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th>Turno</th> 
                        <th>Acción</th>                                         
                    </tr>
                </thead>      
                @foreach($turnos as $turno)      
                    <tr role="row" class="odd">                        
                        <td class="sorting_1">{{ $turno->id }}</td>
                        <td>{{ $turno->turno }}</td> 
                        <td>
                            <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-edit-turno" role="button" data-idturno="{{$turno->id}}" data-turno="{{$turno->turno}}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-turno" role="button" data-idturno="{{$turno->id}}" data-turno="{{$turno->turno}}"><i class="fa fa-trash"></i></i></button>
                        </td>                       
                    </tr>                
                @endforeach    
            </table>  
            {{$turnos->links() }} 
        @else 
            
        @endif    
    </div>
     
    {{-- Modal para agregar un nuevo turno --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-new-turno">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Agregar Turno</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="nuevo_turno"  method="post" action="{{ route('turno.store') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:12vh;">
                        {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                              
                        <div class="box-body col-xs-12">
                            <label for="nombre">Turno</label>
                             <input type="text" class="form-control" id="turno" name="turno" placeholder="Turno" >
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

     {{-- Modal para Editar turno --}}
     <div class="modal fade"  tabindex="-1" role="dialog" id="modal-edit-turno">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Editar Turno</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edita_turno"  method="post" action="{{ route('turno.update') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                                     
                        <div class="box-body col-xs-12">
                            <label for="nombre">Turno</label>
                            <input type="hidden" name="idTurno">
                            <input type="text" class="form-control" id="turno" name="turno" placeholder="Turno" >
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

     {{-- Modal para Eliminar turno --}}
     <div class="modal fade"  tabindex="-1" role="dialog" id="modal-delete-turno">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Eliminar Turno</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elimina_turno"  method="post" action="{{ route('turno.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                                  
                        <div class="box-body col-xs-12">
                            <label for="nombre">Turno</label>
                            <input type="hidden" name="idTurno">
                            <input type="text" class="form-control" id="turno" name="turno" placeholder="Turno" >
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
            $('#modal-edit-turno').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idturno = button.data('idturno'),                           
                    turno = button.data('turno');
                        
                var modal = $(this);
                modal.find('input[name="idTurno"]').val(idturno);                
                modal.find('input[name="turno"]').val(turno);    
            });

            $('#modal-delete-turno').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idturno = button.data('idturno'),                                
                    turno = button.data('turno');
                        
                var modal = $(this);
                modal.find('input[name="idTurno"]').val(idturno);                
                modal.find('input[name="turno"]').val(turno);    
            }); 
        });        
    </script>
@endsection

