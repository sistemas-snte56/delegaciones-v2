@extends('adminlte::page')

@section('title', 'Permisos - Crear')

@section('content_header')
    <div class="title">
    INFORMACIÓN DE LOS PERMISOS REGISTRADOS EN EL SISTEMA
        <h5>
            CREAR NUEVO PERMISO
        </h5>      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div style="margin-right:0px;" class="float-left">
                <a href="{{ url('admin/permissions') }}" class="btn btn-secondary float-right"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['route'=>['permission.store'], 'method'=>'POST']) !!}
                @csrf
                <div class="row">
                    <x-adminlte-input type="text" name="nombre" id="nombre" label="ASIGNAR NOMBRE AL NUEVO PERMISO" placeholder="Ingresa nombre del permiso" label-class="text-orange" value="{{old('nombre')}}" fgroup-class="col-md-12" >
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