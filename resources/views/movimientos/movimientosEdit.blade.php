@extends('layouts.master_layout')

@section('content')
    <div class="">
        <div class="box box-primary">   
            <div class="box-header">
                <div class="row">
                    <div class="col-lg-8 " >
                        <h3 class="box-title"><strong>Editar Movimiento(Egresos & Ingresos)</strong></h3>                
                    </div>                   
                </div>            
            </div>            
        </div>        
        <form id="formMovimientoNuevo" name="f" method="post"  action="{{ route('movimiento.update') }}" class="form_entrada">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="idmovimiento" value="{{$movimiento->id}}"> 
            <div class="box-body col-xs-12">
                <div class="row">
                    <div class="form-group col-xs-3">
                        <label for="date">Fecha *</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{$movimiento->fecha}}"  placeholder="Fecha" required>
                    </div> 
                    <div class="form-group col-xs-3">
                        <label for="tipo">Tipo *</label>
                        <br>
                        <label class="radio-inline"><input type="radio" name="tipo" value="1" @if($movimiento->tipo==1) checked @endif>Ingreso</label>
                        <label class="radio-inline"><input type="radio" name="tipo" value="2" @if($movimiento->tipo==2) checked @endif>Egreso</label>         
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="taxis">Taxi *</label>
                        <select name="taxi" id="taxi" class="form-control" required>
                            <option value="" hidden selected>Seleccionar Taxi</option>
                            @foreach ($taxis as $taxi)
                                <option value="{{ $taxi->id }}"> {{ $taxi->numeroeconomico }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-3">
                        <label for="monto">Monto * </label>
                        <input type="number" step="0.01" class="form-control" id="monto" name="monto" value="{{$movimiento->monto}}" placeholder="Monto" required>
                    </div>
                    <div class="form-group col-xs-3"> 
                        <label for="tipo">Concepto *</label>
                        <select name="concepto" id="concepto" class="form-control" >
                            <option value="" hidden selected>Seleccionar Concepto</option>
                            @foreach ($conceptos as $concepto)
                                <option value="{{ $concepto->id }}"> {{ $concepto->concepto }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div name="liquidacion" id="liquidacion" style="display:none;">
                    <div class="row" >
                        <div class="form-group col-xs-3">
                            <label for="chofer">Chofer *</label>
                            <select name="chofer" id="chofer" class="form-control" >
                                <option value="" hidden selected>Seleccionar Chofer</option>
                                @foreach ($choferes as $chofer)
                                    <option value="{{ $chofer->id }}"> {{ $chofer->nombre }} {{ $chofer->apellidos }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="turno">Turno *</label>
                            <select name="turno" id="turno" class="form-control" >
                                <option value="" hidden selected>Seleccionar Turno</option>
                                @foreach ($turnos as $turno)
                                    <option value="{{ $turno->id }}"> {{ $turno->turno }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-3">
                            <label for="kminicial">Kilometraje Inicial</label>
                            <input type="number" class="form-control" id="kminicial" name="kminicial" value="{{$movimiento->kminicial}}" onchange="cal()" placeholder="Kilometraje Inicial" >
                        </div>                   
                        <div class="form-group col-xs-3">
                            <label for="kmfinal">Kilometraje Final</label>
                            <input type="number" class="form-control" id="kmfinal" name="kmfinal" value="{{$movimiento->kmfinal}}" onchange="cal()"  placeholder="Kilometraje Final" >
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="kmtotal">Kilometros Recorridos </label>
                            {{-- <span>El resultado es: </span> <span id="spTotal"></span> --}}
                            <input type="number" class="form-control" id="kmtotal" name="kmtotal" readonly="readonly" placeholder="Kilometraje Total">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-3">
                            <label for="gasolina">Gasolina </label>
                            <input type="number" step="0.01" class="form-control" id="gasolina" name="gasolina" value="{{$movimiento->gasolina}}" placeholder="Gasolina">
                        </div>
                        <div class="form-group col-xs-3">
                            <label for="lavado">Lavado </label>
                            <input type="number" step="0.01" class="form-control" id="lavado" name="lavado" value="{{$movimiento->lavado}}" placeholder="Lavado">
                        </div> 
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="comentarios">Comentarios</label>
                        <textarea rows="5" class="form-control" id="comentarios" name="comentarios" value="{{$movimiento->comentarios}}" placeholder="Comentarios"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-lefth" >
                        <button type="submit" class="btn btn-primary">Guardar</button>     
                        <a type="button" class="btn btn-info" href="{{ route('movimientos.list') }}">Cerrar</a>                                           
                    </div>  
                </div>    
            </div>
        </form>        
    </div>
@endsection
@section('js')
    <script>    
        $('#concepto').on('change', function(e){            
            var idconcepto = $(this).val();
            if (idconcepto==1)
            { 
                $('#liquidacion').show();
                $('#chofer').attr('required',true);
                $('#turno').attr('required',true);
            }
            else
            {
                $('#liquidacion').hide();
                $('#chofer').attr('required',false);
                $('#turno').attr('required',false);
            }
        });
    </script>
    <script>        
        function cal() 
        {            
            try 
            {
                var a = parseInt(document.f.kminicial.value),
                    b = parseInt(document.f.kmfinal.value);                    
                    document.f.kmtotal.value = b-a;
            } catch (e)             
                {
                    alert(e);   
                }
        }
    </script>
    <script>
        $('.tipomovimiento').on('change', function(e){
            $('#concepto').children('option:not(:first)').remove();            
            var idtipo = $(this).val();
            var _token = '{{ csrf_token() }}';
					$.ajax({
						type: "POST",
						url: "{{route('conceptos.getByTipoId')}}",
						data: {
							_token: _token,
							idtipo: idtipo							
						},
					}).done(function(conceptos) {
                        conceptos_tmp = JSON.stringify(conceptos);
                        conceptos_JSON = JSON.parse(conceptos_tmp);

						 for (var j = 0; j <= conceptos_JSON.length - 1; j++)
						 {						 	
						 	$('#concepto')
						 		.append($("<option></option>")
						 		.attr("value",conceptos_JSON[j].id)						 		
						 		.text(conceptos_JSON[j].concepto));
						 }    
						
					});
        });
    </script>
    <script>
        $(function() {
            $('[data-mask]').inputmask();            
            $('#taxi').val('{{ $movimiento->taxi_id }}');    
            $('#chofer').val('{{$movimiento->chofer_id }}');       
            $('#turno').val('{{$movimiento->turno_id }}');
            $('#concepto').val('{{$movimiento->concepto_id }}');
            $('#kmtotal').val('{{$movimiento->kmfinal - $movimiento->kminicial}}');

            // //habilidata o deshabilita listado conceptos
            // $("#otrosgastos").change( function()
            // {                              
            //     if ($(this).val() <= "0") {
            //         $("#concepto").prop("disabled", true);
            //     } else {
            //         $("#concepto").prop("disabled", false);
            //     }
            // });

            if ( $('#concepto').val() == 1 )
            { 
                $('#liquidacion').show();
                $('#chofer').attr('required',true);
                $('#turno').attr('required',true);
            }
            else
            {
                $('#liquidacion').hide();
                $('#chofer').attr('required',false);
                $('#turno').attr('required',false);
            }
        });
    </script>
           
@endsection 