@extends('layouts.master_layout')

@section('content')
    <div class="">
        <div class="text-center">
            <h2 class="box-title"><b>Editar Taxi</b></h2>
        </div>
        <form id="formTaxiEditar" method="post"  action="{{ route('taxi.update') }}" class="form_entrada">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="row">
                <div class="form-group col-xs-6">
                    <input type="hidden" name="idTaxi" value="{{$taxi->id}}">
                    <label for="propietario">Propietario *</label>
                    <select name="propietario" id="propietario" class="form-control" required>
                        <option value="" hidden selected>Seleccionar Propietario</option>
                        @foreach ($propietarios as $propietario)
                            <option value="{{ $propietario->id }}"> {{ $propietario->apellidos }} {{ $propietario->nombre }} </option>
                        @endforeach
                    </select>
                </div>    
            </div>
            <div class="row">
                <div class="form-group col-xs-3">
                    <label for="sitio">Sitio *</label>
                <input type="number" class="form-control" id="sitio" name="sitio" placeholder="Sitio" value="{{$taxi->sitio}}" required>      
                </div>
                <div class="form-group col-xs-3">
                    <label for="numeroeconomico">Número Económico *</label>
                    <input type="number" class="form-control" id="numeroeconomico" name="numeroeconomico" value="{{$taxi->numeroeconomico}}" placeholder="Número Económico" required>      
                </div>
                <div class="form-group col-xs-3">
                    <label for="placas">Placas *</label>
                    <input type="text" class="form-control" id="placas" name="placas" value="{{$taxi->placas}}" placeholder="Placas" required>      
                </div>
                <div class="form-group col-xs-3">
                    <label for="numeroserie">Número de Serie</label>
                    <input type="text" class="form-control" id="numeroserie" name="numeroserie" value="{{$taxi->numeroserie}}" placeholder="Número de Serie">      
                </div>
            </div>  
            <div class="row">
                <div class="form-group col-xs-3">
                    <label for="marca">Marca</label>
                    <select name="marca" id="marca" class="form-control">
                        <option value="" hidden selected>Seleccionar Marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}"> {{ $marca->marca }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-xs-3">
                    <label for="linea">Linea</label>
                    <select name="linea" id="linea" class="form-control">
                        <option value="" hidden selected>Seleccionar Linea</option>
                        @foreach ($lineas as $linea)
                            <option value="{{ $linea->id }}"> {{ $linea->linea }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-xs-3">
                    <label for="tipoVehiculo">Tipo de Vehiculo</label>
                    <select name="tipovehiculo" id="tipovehiculo" class="form-control">
                        <option value="" hidden selected>Seleccionar Tipo de Vehiculo</option>
                        @foreach ($tiposVehiculos as $tipoVehiculo)
                            <option value="{{ $tipoVehiculo->id }}"> {{ $tipoVehiculo->tipoVehiculo }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-3">
                    <label for="kilometrajeactual">Kilometraje Actual</label>
                    <input type="number" class="form-control" id="kilometrajeactual" name="kilometrajeactual" value="{{$taxi->kilometrajeactual}}" placeholder="Kilometraje Actual">      
                </div>
                <div class="form-group col-xs-3">
                    <label for="serviciocada">Servicio Cada(kms)</label>
                    <input type="number" class="form-control" id="serviciocada" name="serviciocada" value="{{$taxi->serviciocada}}" placeholder="Servicio Cada(kms)">      
                </div>
                <div class="form-group col-xs-3">
                    <label for="fechaultimoservicio">Fecha Último Servicio</label>
                    <input type="date" class="form-control" id="fechaultimoservicio" name="fechaultimoservicio" value="{{$taxi->fechaultimoservicio}}" placeholder="Fecha Último Servicio">      
                </div>
                <div class="form-group col-xs-3">
                    <label for="kilometrajeultimoservicio">Kilometraje Último Servicio</label>
                    <input type="number" class="form-control" id="kilometrajeultimoservicio" name="kilometrajeultimoservicio" value="{{$taxi->kilometrajeultimoservicio}}" placeholder="Kilometraje Último Servicio">      
                </div>
            </div> 
            <div class="row">
                <div class="form-group col-xs-2">
                   <i>* Campos obligatorios</i> 
                </div>
                <div class="col-lg-10 text-right" >
                    <a class="btn btn-info" href="{{ route('taxis.list') }}">Cerrar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>                        
                </div>   
            </div>       
        </form>   
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            $('[data-mask]').inputmask();
            $('#propietario').val('{{ $taxi->propietario_id }}');    
            $('#marca').val('{{$taxi->marca_id }}');       
            $('#linea').val('{{$taxi->linea_id }}');
            $('#tipovehiculo').val('{{$taxi->tipovehiculo_id }}');
        });
    </script>    
@endsection 