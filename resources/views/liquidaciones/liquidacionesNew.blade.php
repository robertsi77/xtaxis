@extends('layouts.master_layout')

@section('content')
    <div class="">
        <div class="text-center">
            <h2 class="box-title"><b>Agregar Liquidación</b></h2>
        </div>
        <form id="formPropietaroNuevo" name="f" method="post"  action="{{ route('liquidacion.store') }}" class="form_entrada">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            {{-- este campo de abajo es para mandar un uno a la tabla de liquidaciones 
                indicando que es una liquidacion --}}
            <input type="hidden" name="origen" value="1">
            <div class="box-body col-xs-12">
                <div class="row">                 
                    <div class="form-group col-xs-3">
                        <label for="date">Fecha *</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ date('Y-m-d') }}"  placeholder="Fecha" required>
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
                    <div class="form-group col-xs-3">
                        <label for="chofer">Chofer *</label>
                        <select name="chofer" id="chofer" class="form-control" required>
                            <option value="" hidden selected>Seleccionar Chofer</option>
                            @foreach ($choferes as $chofer)
                                <option value="{{ $chofer->id }}"> {{ $chofer->nombre }} {{ $chofer->apellidos }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="turno">Turno *</label>
                        <select name="turno" id="turno" class="form-control" required>
                            <option value="" hidden selected>Seleccionar Turno</option>
                            @foreach ($turnos as $turno)
                                <option value="{{ $turno->id }}"> {{ $turno->turno }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-3">
                        <label for="kilometrajeincial">Kilometraje Inicial</label>
                        <input type="number" class="form-control" id="kilometrajeinicial" name="kilometrajeinicial" value="0" onchange="cal()" placeholder="Kilometraje Inicial" required>
                    </div>                   
                    <div class="form-group col-xs-3">
                        <label for="kilometrajefinal">Kilometraje Final</label>
                        <input type="number" class="form-control" id="kilometrajefinal" name="kilometrajefinal" value="0" onchange="cal()"  placeholder="Kilometraje Final" required>
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="kilometrajetotal">Kilometros Recorridos </label>
                        {{-- <span>El resultado es: </span> <span id="spTotal"></span> --}}
                        <input type="number" class="form-control" id="totalKms" name="totalKms" readonly="readonly" placeholder="Kilometraje Total">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="liquidacion">Liquidación </label>
                        <input type="number" step="0.01" class="form-control" id="liquidacion" name="liquidacion" value="0" placeholder="Liquidación" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-3">
                        <label for="gasolina">Gasolina </label>
                        <input type="number" step="0.01" class="form-control" id="gasolina" name="gasolina" value="0" placeholder="Gasolina">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="lavado">Lavado </label>
                        <input type="number" step="0.01" class="form-control" id="lavado" name="lavado" placeholder="Lavado">
                    </div> 
                    <div class="form-group col-xs-3">
                        <label for="otrosgastos">Otros Gastos </label>
                        <input type="number" step="0.01" class="form-control" id="otrosgastos" name="otrosgastos" value="0" placeholder="Otros Gastos">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="conceptoGasto">Concepto Gasto </label>
                        <select name="concepto" id="concepto" class="form-control" disabled>
                            <option value="" hidden selected>Seleccionar Concepto</option>
                            @foreach ($conceptos as $concepto)
                                <option value="{{ $concepto->id }}"> {{ $concepto->concepto }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>                
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="descripcionotrosgastos">Descrip. Otros Gastos  </label>
                        <textarea rows="5" class="form-control" id="descripcionotrosgastos" name="descripcionotrosgastos" placeholder="Descrip. Otros Gastos"></textarea>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="comentarios">Comentarios</label>
                        <textarea rows="5" class="form-control" id="comentarios" name="comentarios" placeholder="Comentarios"></textarea>
                    </div>
                </div>      
                <div class="row">
                    <div class="col-lg-12 text-right" >
                        <a class="btn btn-info" href="{{ route('liquidaciones.list') }}">Cerrar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>                        
                    </div>  
                </div>     
            </div>    
        </form> 
    </div>
@endsection
@section('js')    
    <script>        
        function cal() 
        {
            try 
            {
                var a = parseInt(document.f.kilometrajeinicial.value),
                    b = parseInt(document.f.kilometrajefinal.value);
                document.f.totalKms.value = b-a;
            } catch (e)             
                {
                 }
        }
    </script>

    <script>
        $(function() {
            $('[data-mask]').inputmask();

            //habilidata o deshabilita listado conceptos
            $("#otrosgastos").change( function() {                              
                if ($(this).val() <= "0") {
                    $("#concepto").prop("disabled", true);
                } else {
                    $("#concepto").prop("disabled", false);
                }
            });
        });

        $('#taxi').on('change', function(e){                                         
            var idtaxi = $(this).val();            
            var _token = '{{ csrf_token() }}';                        
            $.ajax({                
                type: "POST",
                url: "{{route('liquidacion.kilometrajeFinal')}}",
                data: {
                    _token: _token,
                    idtaxi: idtaxi                    							
                },
            }).done(function(liquidacion) {
                liquidacion_tmp = JSON.stringify(liquidacion);
                liquidacion_JSON = JSON.parse(liquidacion_tmp);
                $('#kilometrajeinicial').val(liquidacion_JSON.kilometrajefinal);						
            });
        });
    </script> 
@endsection 