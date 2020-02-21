@extends('layouts.master_layout')

@section('content')
    <div class="box box-primary">   
        <div class="box-header">
            <div class="row">
                <div class="col-lg-8 " >
                    <h3 class="box-title"><strong>Listado Liquidaciones</strong></h3>                
                </div>
                <div class="col-lg-4 text-center" >
                    <a type="button" class="btn btn-primary" href="{{ route('liquidacion.new') }}">
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
        
        @if( count($liquidaciones) >0)
            <table id="liquidaciones" class="table table-bordered table-striped" cellspacing="0" width="100%">                            
                {{-- class="display table table-hover"  --}}
                <thead>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th>Fecha</th> 
                        <th>Taxi</th>
                        <th>Chofer</th>
                        <th>Turno</th>
                        <th>Km. Inicial</th>
                        <th>Km. Final</th>
                        <th>Total Kms.</th>
                        <th>Liquidacion</th>
                        <th>Gasolina</th>
                        <th>Otros Gastos</th>
                        <th>Acción</th>                                         
                    </tr>
                </thead>
                 
                @foreach($liquidaciones as $liquidacion)      
                    <tr role="row" class="odd">                        
                        <td class="sorting_1">{{ $liquidacion->id }}</td>
                        <td>{{ $liquidacion->fecha }}</td> 
                        <td>{{ $liquidacion->taxi->numeroeconomico }}</td>
                        <td>{{ $liquidacion->chofer->nombre }} {{ $liquidacion->chofer->apellidos }}</td>
                        <td>{{ $liquidacion->turno->turno }} </td>
                        <td>{{ $liquidacion->kilometrajeinicial }}</td>
                        <td>{{ $liquidacion->kilometrajefinal }}</td>
                        <td>{{  $liquidacion->kilometrajefinal - $liquidacion->kilometrajeinicial }}</td>
                        <td>{{ $liquidacion->liquidacion }}</td>
                        <td>{{ $liquidacion->gasolina }}</td>
                        <td>{{ $liquidacion->otrosgastos }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('liquidacion.edit',['id'=> $liquidacion->id]) }}"><i class="fa fa-edit"></i></a>                            
                            <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-liquidacion" role="button" data-idliquidacion="{{$liquidacion->id}}" ><i class="fa fa-trash"></i></i></button>
                        </td>                       
                    </tr>                
                @endforeach                 
            </table>  
            {{-- {{$liquidaciones->links() }} --}}
        @else 
        <div class="alert alert-danger text-center" role="alert">
                No hay registros
         </div>
        @endif    
    </div>
    {{-- Modal para Eliminar un lina de Propietario --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-delete-liquidacion">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Eliminar Liquidacion</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elimina_liquidacion"  method="post" action="{{ route('liquidacion.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">                            
                        <div class="box-body col-xs-12">
                            <label for="liquidacion">Liquidacion</label>
                           {{--<input type="text" name="idLiquidacion">--}} 
                            <input type="text" class="form-control" id="idLiquidacion" name="idLiquidacion" placeholder="Id Liquidacion" >                            
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
            $('#modal-delete-liquidacion').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idliquidacion = button.data('idliquidacion')                              
                    //liquidacion = button.data('liquidacion');
                        
                var modal = $(this);
                modal.find('input[name="idLiquidacion"]').val(idliquidacion);                
                //modal.find('input[name="liquidacion"]').val(liquidacion);    
            }); 
        });
             
    </script>

    {{-- <script>
        $(function () {              
            $('#liquidaciones').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
            });
        });
    </script>  --}}

    <script>    
        $('#liquidaciones').DataTable();
    </script>

@endsection