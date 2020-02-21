@extends('layouts.master_layout')

@section('content')
    <div class="">
        <div class="text-center">
            <h2 class="box-title"><b>Editar Choferes</b></h2>
        </div>
        <form id="formChoferesEditar" method="post"  action="{{ route('chofer.update') }}" class="form_entrada">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="box-body col-xs-12">        
                <div class="col-xs-12">
                    <input type="hidden" name="idChofer" value="{{$chofer->id}}">                    
                    <div class="form-group ">
                        <label for="apellido">Apellidos *</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="{{$chofer->apellidos}}" required>
                    </div>
                </div>        
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="nombre">Nombre(s) *</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" value="{{$chofer->nombre}}" required>
                    </div>        
                </div>        
                
                <div class="form-group col-xs-6">
                    <label for="rfc">RFC</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC" value="{{$chofer->rfc}}" >
                </div>
                <div class="form-group col-xs-6">
                    <label for="curp">CURP</label>
                    <input type="text" class="form-control" id="curp" name="curp" placeholder="CURP"  value="{{$chofer->curp}}">
                </div>
                <div class="form-group col-xs-6">
                    <label for="fechaNacimiento">Fecha Nacimiento</label>
                    <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" placeholder="Fecha Nacimiento" value="{{$chofer->fechanacimiento}}" >
                </div>
                <div class="form-group col-xs-6">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select>            
                </div>
                <div class="form-group col-xs-6">
                    <label for="calle">Calle</label>
                    <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" value="{{$chofer->calle}}">      
                </div>
                <div class="form-group col-xs-3">
                    <label for="noExt">No. Ext.</label>
                    <input type="text" class="form-control" id="noext" name="noext" placeholder="No. Ext" value="{{$chofer->noext}}">      
                </div>
                <div class="form-group col-xs-3">
                    <label for="calle">No. Int.</label>
                    <input type="text" class="form-control" id="noint" name="noint" placeholder="No. Int" value="{{$chofer->noint}}">      
                </div>    
                <div class="form-group col-xs-6">
                    <label for="colonia">Colonia</label>
                    <select name="colonia" id="colonia" class="form-control">
                        <option value="" hidden selected>Seleccionar Colonia</option>
                        @foreach ($colonias as $colonia)
                            <option value="{{ $colonia->id }}"> {{ $colonia->colonia }} </option>
                        @endforeach
                    </select>
                </div>    
                <div class="form-group col-xs-6">
                    <label for="localidad">Localidad</label>
                    <select name="localidad" id="localidad" class="form-control">
                        <option value="" hidden selected>Seleccionar Localidad</option>
                        @foreach ($localidades as $localidad)
                            <option value="{{ $localidad->id }}">{{ $localidad->localidad }}</option>
                        @endforeach
                    </select>
                </div>    
                <div class="form-group col-xs-2">
                    <label for="codigoPostal">Codigo Postal</label>
                    <input type="text" class="form-control" id="codigopostal" name="codigopostal" placeholder="Codigo Postal" value="{{$chofer->codigopostal}}">      
                </div>                    
                <div class="form-group col-xs-2">
                    <label for="telefonocasa">Teléfono Casa</label>
                    <input type="text" class="form-control" id="telefonocasa" name="telefonocasa" value="{{$chofer->telefonocasa}}" data-inputmask='"mask": "(999) 999-9999"' data-mask>      
                </div>
                <div class="form-group col-xs-2">
                    <label for="telefonocelular">Teléfono Celular</label>
                    <input type="text" class="form-control" id="telefonocelular" name="telefonocelular" value="{{$chofer->telefonocelular}}" data-inputmask='"mask": "(999) 999-9999"' data-mask>      
                </div>
                
                <div class="form-group col-xs-4">
                    <label for="email">Correo Electronico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$chofer->email}}" placeholder="Correo Electronico">      
                </div> 
                <div class="form-group col-xs-6">
                    <label for="tipoLicencia">Tipo Licencia</label>
                    <select name="tipoLicencia" id="tipoLicencia" class="form-control">
                        <option value="" hidden selected>Seleccionar Tipo Licencia</option>
                        @foreach ($tiposLicencias as $tipoLicencia)
                            <option value="{{ $tipoLicencia->id }}"> {{ $tipoLicencia->tipoLicencia }} </option>
                        @endforeach
                    </select>
                </div>    
                <div class="form-group col-xs-6">
                    <label for="vigencia">Vigencia</label>
                    <input type="date" class="form-control" id="vigencia" name="vigencia" value="{{$chofer->vigencia}}"placeholder="Vigencia Licencia" >
                </div>

                <div class="col-lg-12 text-right" >
                    <a class="btn btn-info" href="{{ route('choferes.list') }}">Cerrar</a>
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
            $('#sexo').val('{{ $chofer->sexo }}');    
            $('#colonia').val('{{$chofer->colonia_id }}');       
            $('#localidad').val('{{$chofer->localidad_id }}');
            $('#tipoLicencia').val('{{$chofer->tipoLicencia_id }}');
        });
    </script>    
@endsection 