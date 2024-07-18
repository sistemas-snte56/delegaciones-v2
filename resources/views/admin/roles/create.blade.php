@extends('adminlte::page')

@section('title', 'Rol - Crear')

@section('content_header')
    <div class="title">
        INFORMACIÓN DE ROLES Y PERMISOS
        <h5>
            CREAR UN NUEVO ROL
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
            {!! Form::open(['route'=>['rol.store'], 'method'=>'POST']) !!}
                @csrf
               

                <div class="row">
                    <x-adminlte-input type="text" name="nombre" id="nombre" label="ROL" placeholder="Ingresa tu rol" label-class="text-orange" value="{{old('nombre')}}" fgroup-class="col-md-3" >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-orange"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>   
                </div>

               
                <div class="row">
                    <div class="form-group">
                        <label for="">Permisos para este rol:</label> <br>
                        @foreach ($permission as $item)
                            {!! Form::checkbox('permission[]', $item->id, false, array('class'=>'name')) !!} &ensp; {{$item->name}} <br>
                        @endforeach
                    </div>
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