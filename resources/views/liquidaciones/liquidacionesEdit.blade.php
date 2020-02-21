@extends('layouts.master_layout')

@section('content')
    <div class="">
        <div class="text-center">
            <h2 class="box-title"><b>Editar Liquidacion</b></h2>
        </div>
        <form id="formPropietaroEditar" name="f" method="post"  action="{{ route('liquidacion.update') }}" class="form_entrada">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="box-body col-xs-12">
                <div class="row">                
                    <input type="hidden" name="idLiquidacion" value="{{$liquidacion->id}}"> 
                    <div class="form-group col-xs-3">
                        <label for="date">Fecha *</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $liquidacion->fecha }}" placeholder="Fecha" required>
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
                        <input type="number" class="form-control" id="kilometrajeinicial" name="kilometrajeinicial" value="{{ $liquidacion->kilometrajeinicial }}"  onchange="cal()" placeholder="Kilometraje Inicial">
                    </div>                   
                    <div class="form-group col-xs-3">
                        <label for="kilometrajefinal">Kilometraje Final</label>
                        <input type="number" class="form-control" id="kilometrajefinal" name="kilometrajefinal" value="{{ $liquidacion->kilometrajefinal }}"  onchange="cal()" placeholder="Kilometraje Final">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="kilometrajetotal">Kilometros Recorridos </label>
                        <input type="number" class="form-control" id="totalKms" name="totalKms" readonly="readonly" placeholder="Kilometraje Total">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-3">
                        <label for="liquidacion">Liquidación </label>
                        <input type="number" step="0.01" class="form-control" id="liquidacion" name="liquidacion" value="{{ $liquidacion->liquidacion }}" placeholder="Liquidación">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for="gasolina">Gasolina </label>
                        <input type="number" step="0.01" class="form-control" id="gasolina" name="gasolina" value="{{ $liquidacion->gasolina }}" placeholder="Gasolina">
                    </div>
                    {{-- <div class="form-group col-xs-3">
                        <label for="lavado">Lavado </label>
                        <input type="number" step="0.01" class="form-control" id="lavado" name="lavado" value="{{ $liquidacion->lavado }}" placeholder="Lavado">
                    </div> --}}
                    <div class="form-group col-xs-3">
                        <label for="otrosgastos">Otros Gastos </label>
                        <input type="number" step="0.01" class="form-control" id="otrosgastos" name="otrosgastos" value="{{ $liquidacion->otrosgastos }}" placeholder="Otros Gastos">
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
                    <div class="form-group col-xs-12">
                        <label for="descripcionotrosgastos">Descrip. Otros Gastos  </label>
                        <input type="text" class="form-control" id="descripcionotrosgastos" name="descripcionotrosgastos" value="{{ $liquidacion->descripcionotrosgastos }}" placeholder="Descrip. Otros Gastos">
                    </div>
                </div>   
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="comentarios">Comentarios</label>
                        <textarea rows="5" class="form-control" id="comentarios" name="comentarios"  placeholder="Comentarios">{{ $liquidacion->comentarios }}</textarea>
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
                    alert(e);   
                }
        }
    </script>
    <script>
        $(function() {
            $('[data-mask]').inputmask();
            $('#taxi').val('{{ $liquidacion->taxi_id }}');    
            $('#chofer').val('{{$liquidacion->chofer_id }}');       
            $('#turno').val('{{$liquidacion->turno_id }}');
            $('#concepto').val('{{$liquidacion->concepto_id }}');
            $('#totalKms').val('{{$liquidacion->kilometrajefinal - $liquidacion->kilometrajeinicial}}');

            //habilidata o deshabilita listado conceptos
            $("#otrosgastos").change( function()
            {                              
                if ($(this).val() <= "0") {
                    $("#concepto").prop("disabled", true);
                } else {
                    $("#concepto").prop("disabled", false);
                }
            });
        });
    </script>
           
@endsection 