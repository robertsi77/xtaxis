@extends('layouts.master_layout')

@section('content')
    <div class="box box-primary">   
        <div class="box-header">
            <div class="row">
                <div class="col-lg-8 " >
                    <h3 class="box-title"><strong>Movimientos(Egresos & Ingresos)</strong></h3>                
                </div>
                <div class="col-lg-4 text-center" >
                    <a type="button" class="btn btn-primary" href="{{ route('movimiento.new') }}">
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

    @if( count($movimientos) >0)
        <table id="movimientos" class="table table-bordered table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="width:50px">Id</th>
                    <th>Fecha</th> 
                    <th>Taxi</th>
                    <th>Concepto</th>
                    <th>Ingreso</th>
                    <th>Egreso</th>
                    <th>Saldo</th>                    
                    <th>Acción</th>                                         
                </tr>
            </thead>
            @foreach($movimientos as $movimiento)      
                <tr role="row" class="odd">                        
                    {{-- <td class="sorting_1">{{ $movimiento->id }}</td> --}}
                    <td>{{ $movimiento->id }}</td>
                    <td>{{ $movimiento->fecha }}</td>                     
                    <td>{{ $movimiento->numeroeconomico }}</td>                  
                    <td>{{ $movimiento->concepto }}</td>
                    <td>{{ $movimiento->Ingreso }}</td>
                    <td>{{ $movimiento->Egreso }}</td>
                    <td>{{ $movimiento->Total }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('movimiento.edit',['id'=> $movimiento->id]) }}"><i class="fa fa-edit"></i></a>                            
                        {{--<button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modal-delete-liquidacion" role="button" data-idliquidacion="{{$liquidacion->id}}" ><i class="fa fa-trash"></i></i></button> --}}
                    </td>                       
                </tr>                
            @endforeach             
        </table>        
    @else 
        <div class="alert alert-danger text-center" role="alert">
            No hay registros
        </div>
    @endif


@endsection