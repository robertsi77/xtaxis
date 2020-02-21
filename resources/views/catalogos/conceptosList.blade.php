@extends('layouts.master_layout')

@section('content')

<div class="box box-primary">
    <div class="box-header">
        <div class="row">
            <div class="col-lg-8 " >
                <h3 class="box-title"><strong>Listado Conceptos Ingresos/Egresos</strong></h3>                
            </div>
            <div class="col-lg-4 text-center" >
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-new-concepto">
                    Agregar
                </button>
            </div>
        </div>        
    </div>

    <div class="box-body">        
        
        @if( count($conceptos) >0)
            <table id="conceptos" class="display table table-hover" cellspacing="0" width="100%">            
                <thead>
                    <tr>
                        <th style="width:50px">Id</th>
                        <th style="width:100px">Tipo</th> 
                        <th>Concepto</th> 
                        <th>Acción</th>                                         
                    </tr>
                </thead>      
                @foreach($conceptos as $concepto)      
                    <tr role="row" class="odd">                        
                        <td class="sorting_1">{{ $concepto->id }}</td>                        
                        <td>
                            @if($concepto->tipo==1) 
                                Ingreso
                            @else
                                Egreso
                            @endif
                        </td>
                        <td>{{ $concepto->concepto }}</td> 
                        <td>
                            <button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-edit-concepto" role="button" data-idconcepto="{{$concepto->id}}" data-tipo="{{$concepto->tipo}}" data-concepto="{{$concepto->concepto}}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-concepto" role="button" data-idconcepto="{{$concepto->id}}" data-tipo="{{$concepto->tipo}}" data-concepto="{{$concepto->concepto}}"><i class="fa fa-trash"></i></i></button>
                        </td>                       
                    </tr>                
                @endforeach    
            </table>  
            {{$conceptos->links() }} 
        @else 
            
        @endif    
    </div>

     {{-- Modal para agregar un nuevo Concepto --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-new-concepto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Agregar Concepto</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="nuevo_concepto"  method="post" action="{{ route('concepto.store') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:20vh;">
                        {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                        <div class="box-body col-xs-12">
                            <label for="nombre">Tipo</label>
                            <br>
                            <label class="radio-inline"><input type="radio" name="tipo" checked value="1">Ingreso</label>
                            <label class="radio-inline"><input type="radio" name="tipo" value="2">Egreso</label>         
                        </div>             
                         
                        <div class="box-body col-xs-12">
                            <label for="nombre">Concepto</label>
                            <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Concepto" required>
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

    
     {{-- Modal para Editar concepto --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-edit-concepto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Editar Concepto</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edita_concepto"  method="post" action="{{ route('concepto.update') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                        <input type="hidden"  id="idconcepto" name="idconcepto" >
                        <div class="box-body col-xs-12">
                            <label for="nombre">Tipo</label>
                            <br>
                            <label class="radio-inline"><input type="radio" id="ingreso" name="tipo" value="1">Ingreso</label>
                            <label class="radio-inline"><input type="radio" id="egreso" name="tipo" value="2">Egreso</label>         
                        </div>             
                            
                        <div class="box-body col-xs-12">
                            <label for="nombre">Concepto</label>
                            <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Concepto" required>
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
    
        {{-- Modal para Eliminar concepto --}}
    <div class="modal fade"  tabindex="-1" role="dialog" id="modal-delete-concepto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Eliminar Concepto</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="elimina_concepto"  method="post" action="{{ route('concepto.delete') }}" class="form-horizontal form_entrada">
                    <div class="modal-body" style="height:22vh;">
                    {{-- <p>Modal body text goes here. --}}            
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                        <input type="hidden"  id="idconcepto" name="idconcepto" >                        
                        <div class="box-body col-xs-12">
                            <label for="nombre">Tipo</label>
                            <br>
                            <label class="radio-inline"><input type="radio" name="tipo" checked value="1">Ingreso</label>
                            <label class="radio-inline"><input type="radio" name="tipo" value="2">Egreso</label>         
                        </div>             
                            
                        <div class="box-body col-xs-12">
                            <label for="nombre">Concepto</label>
                            <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Concepto" required>
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
            $('#modal-edit-concepto').on('show.bs.modal', function (event)
            {                   
                var button = $(event.relatedTarget);                    
                var idconcepto = button.data('idconcepto'),
                    tipo = button.data('tipo'),                            
                    concepto = button.data('concepto');                     
                        
                var modal = $(this);
                modal.find('input[name="idconcepto"]').val(idconcepto);
                $('input[name="tipo"]:checked').prop('checked', false);                 
                $('input[name="tipo"][value="'+tipo+'"]').prop('checked',true);                            
                modal.find('input[name="concepto"]').val(concepto);    
            });

            $('#modal-delete-concepto').on('show.bs.modal', function (event)
            {   
                var button = $(event.relatedTarget);                    
                var idconcepto = button.data('idconcepto'),
                    tipo = button.data('tipo'),
                    concepto = button.data('concepto');
                        
                var modal = $(this);
                modal.find('input[name="idconcepto"]').val(idconcepto);
                $('input[name="tipo"]:checked').prop('checked', false);                 
                $('input[name="tipo"][value="'+tipo+'"]').prop('checked',true);                            
                modal.find('input[name="concepto"]').val(concepto);      
            }); 
        });        
    </script>
@endsection
