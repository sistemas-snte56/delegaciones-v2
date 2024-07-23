@extends('adminlte::page')

@section('title', 'Rol - Editar')

@section('content_header')
    <div class="title">
    INFORMACIÓN DE LOS ROL'S REGISTRADOS EN EL SISTEMA
        <h5>
            EDITAR ROL 
        </h5>      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="margin-right:0px;" class="float-left">
                <a href="{{ URL::previous() }}" class="btn btn-secondary float-right"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['route'=>['rol.update',$role->id], 'method'=>'PUT']) !!}
                @csrf
                <div class="row">
                    <x-adminlte-input type="text" name="nombre" id="nombre" label="NOMBRE DEL ROL" placeholder="Ingresa nombre de rol" label-class="text-orange" value="{{old('nombre', $role->name)}}" fgroup-class="col-md-12" >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-orange"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>  
                </div>
                <div class="row">
                    {!! Form::button('Guardar', ['type' => 'submit', 'class' => 'btn btn-primary float-right']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop