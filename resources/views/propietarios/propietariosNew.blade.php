@extends('layouts.master_layout')

@section('content')
<div class="">
        <div class="text-center">
            <h2 class="box-title"><b>Nuevo Propietario</b></h2>
        </div>
        
        <form id="formPropietaroNuevo" method="post"  action="{{ route('propietario.store') }}" class="form_entrada">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="box-body col-xs-12">        
                <div class="col-xs-12">
                    <div class="form-group ">
                        <label for="apellido">Apellidos *</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                    </div>
                </div>        
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="nombre">Nombre(s) *</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" required>
                    </div>        
                </div>        
                
                <div class="form-group col-xs-6">
                    <label for="rfc">RFC</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC" >
                </div>
                <div class="form-group col-xs-6">
                    <label for="curp">CURP</label>
                    <input type="text" class="form-control" id="curp" name="curp" placeholder="CURP" >
                </div>
                <div class="form-group col-xs-6">
                    <label for="fechaNacimiento">Fecha Nacimiento</label>
                    <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" placeholder="Fecha Nacimiento" >
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
                    <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle">      
                </div>
                <div class="form-group col-xs-3">
                    <label for="noExt">No. Ext.</label>
                    <input type="text" class="form-control" id="noext" name="noext" placeholder="No. Ext">      
                </div>
                <div class="form-group col-xs-3">
                    <label for="calle">No. Int.</label>
                    <input type="text" class="form-control" id="noint" name="noint" placeholder="No. Int">      
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
                    <input type="text" class="form-control" id="codigopostal" name="codigopostal" placeholder="Codigo Postal">      
                </div>    
                <div class="form-group col-xs-10">
                    <label for="referencia">Referencia</label>
                    <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Referencia">      
                </div>
                <div class="form-group col-xs-4">
                    <label for="telefonocasa">Teléfono Casa</label>
                    <input type="text" class="form-control" id="telefonocasa" name="telefonocasa" data-inputmask='"mask": "(999) 999-9999"' data-mask>      
                </div>
                <div class="form-group col-xs-4">
                    <label for="telefonocelular">Teléfono Celular</label>
                    <input type="text" class="form-control" id="telefonocelular" name="telefonocelular" data-inputmask='"mask": "(999) 999-9999"' data-mask>      
                </div>
                
                <div class="form-group col-xs-4">
                    <label for="email">Correo Electronico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo Electronico">      
                </div> 
                <div class="col-lg-12 text-right" >
                    <a class="btn btn-info" href="{{ route('propietarios.list') }}">Cerrar</a>
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
        });
    </script>    
@endsection 


