@extends('layouts.master_layout')

@section('content')
<div class="">
    <div class="text-center">
        <h2 class="box-title"><b>Agregar Ingreso/Egreso</b></h2>
    </div>
    <form id="formIngresoEgreso" name="f" method="post"  action="{{ route('ingresoEgreso.store') }}" class="form_entrada">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        {{-- este campo de abajo es para mandar un dos a la tabla de liquidaciones 
            indicando que es un movimiento de origen ingreso o egreso --}}
        <input type="hidden" name="origen" value="2">
        <div class="box-body col-xs-12">
            <div class="row">  
                <div class="form-group col-xs-3">
                    <label for="date">Fecha *</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ date('Y-m-d') }}"  placeholder="Fecha" required>
                </div> 
                <div class="form-group col-xs-3">
                    <label for="tipo">Tipo *</label>
                    <br>
                    <label class="radio-inline"><input type="radio" name="tipo" checked value="1">Ingreso</label>
                    <label class="radio-inline"><input type="radio" name="tipo" value="2">Egreso</label>         
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
            <div class="row">
            </div>    
        </div>
    </form>
</div>
@endsection

@section('js')
    <script>
        $('#tipo').on('change', function(e){
            $('#concepto').children('option:not(:first)').remove();            
            var tipo = $(this).val();
            var _token = '{{ csrf_token() }}';
					$.ajax({
                        if (tipo==1){
                            type: "POST",
                            url: "{{route('lineas.getByMarcaId')}}",
                            data: {
                                _token: _token,
                                idmarca: idmarca							
                            },
                        }
						else
                        {
                            type: "POST",
                            url: "{{route('lineas.getByMarcaId')}}",
                            data: {
                                _token: _token,
                                idmarca: idmarca							
                            },
                        }
					}).done(function(lineas) {
						 lineas_tmp = JSON.stringify(lineas);
						 lineas_JSON = JSON.parse(lineas_tmp);

						 for (var j = 0; j <= lineas_JSON.length - 1; j++)
						 {						 	
						 	$('#linea')
						 		.append($("<option></option>")
						 		.attr("value",lineas_JSON[j].id)						 		
						 		.text(lineas_JSON[j].linea));
						 }    
						
					});
        });
    </script>   

@endsection 