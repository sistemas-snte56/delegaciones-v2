@extends('adminlte::page')

@section('title', 'Users - Perfil')

@section('content_header')
    <div class="title">
        <h5>
            <strong style="text-transform: uppercase;">
                Información de perfil
            </strong>
        </h5>

        <h6>
        Actualice la información de su cuenta y la dirección de correo electrónico.
        </h6>      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="/dashboard" class="btn btn-secondary float-left"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
            <div style="margin-right:0px;" class="float-left">
            </div>
        </div>
        <div class="card-body">
            
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">Información de perfil</h3>
                
                        <p class="mt-1 text-sm text-gray-600">
                            Actualice la información de su cuenta y la dirección de correo electrónico.
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                    {!! Form::open(['route'=>['perfil.update',$user], 'method'=>'PUT']) !!}
                        @csrf
                        <div class="row">
                            <x-adminlte-select name="select_titulo" label="TITULO" label-class="text-orange" fgroup-class="col-md-12">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-city text-orange"></i>
                                    </div>
                                </x-slot>
                                <option value="{{$user->titulo}}" selected>{{$user->titulo}}</option>
                                <option value="PROF."  {{ old('select_titulo',$user->titulo) == 'PROF.' ? 'selected' : '' }} >PROF.</option>
                                <option value="PROFA." {{ old('select_titulo',$user->titulo) == 'PROFA.' ? 'selected' : '' }} >PROFA.</option>
                            </x-adminlte-select>
        
        
                            <x-adminlte-input type="text" name="nombre" id="nombre" label="NOMBRE" placeholder="Ingresa tu nombre" label-class="text-orange" value="{{ old('nombre', $user->nombre) }}" fgroup-class="col-md-12">
        
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-orange"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>  
            
                            <x-adminlte-input type="text" name="apellido_paterno" id="apellido_paterno" label="PRIMER APELLIDO" placeholder="Ingresa tu apellido paterno" label-class="text-orange" value="{{old('apellido_paterno', $user->apaterno)}}" fgroup-class="col-md-12" >
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-orange"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>   
            
                            <x-adminlte-input type="text" name="apellido_materno" id="apellido_materno" label="SEGUNDO APELLIDO" placeholder="Ingresa tu apellido materno" label-class="text-orange" value="{{old('apellido_materno', $user->amaterno)}}" fgroup-class="col-md-12" >
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-orange"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>   
                        </div>
        
        
                        <div class="row">
                            {{-- Email type --}}
                            <x-adminlte-input name="email" id="email" type="email" label="CORREO ELECTRÓNICO" label-class="text-orange" placeholder="Ingresa tu email"  fgroup-class="col-md-12" value=" {{ old('email',$user->email)}} " >
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-envelope text-orange"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        

        
        
        
        
        
                        <div class="row">
                            {!! Form::button('Actualizar', ['type' => 'submit', 'class' => 'btn btn-primary float-right']) !!}
                        </div>
        
        
                    {!! Form::close() !!}
                </div>
            </div>



        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop