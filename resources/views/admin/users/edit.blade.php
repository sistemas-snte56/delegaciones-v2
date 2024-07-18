@extends('adminlte::page')

@section('title', 'Users - Editar')

@section('content_header')
    <div class="title">
        {{$user->nombre}} {{$user->apaterno}} {{$user->amaterno}}
        <h5>
            ACTUALIZAR INFORMACIÓN
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
            {!! Form::open(['route'=>['user.update',$user], 'method'=>'PATCH']) !!}
                @csrf

                <div class="row">
                    <x-adminlte-select name="select_region" label="REGIÓN" label-class="text-orange" fgroup-class="col-md-4">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-city text-orange"></i>
                            </div>
                        </x-slot>
                        {{-- <option value="{{$delegacion->region->id}}" selected>{{$delegacion->region->region}} - {{$delegacion->region->sede}}</option> --}}
                        <option value=" {{ $userDelegacion->region->id }} "> {{$userDelegacion->region->region}} - {{$userDelegacion->region->sede}} </option>
                        <x-adminlte-options :options="$regiones" :selected="old('select_region')" empty-option="Selecciona Región" />
                    </x-adminlte-select>

                    <x-adminlte-select name="select_delegacion" label="DELEGACIÓN" label-class="text-orange" fgroup-class="col-md-4">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-city text-orange"></i>
                            </div>
                        </x-slot>
                        <option value=" {{$userDelegacion->id}} " selected > 
                            {{$userDelegacion->nomenclatura->nomenclatura}}{{$userDelegacion->num_delegaciona}} |
                            {{$userDelegacion->nivel_delegaciona}} |
                            {{$userDelegacion->sede_delegaciona}}
                        </option>
                        @foreach($delegaciones as $delegacion)
                            <option value="{{ $delegacion->id }}" {{ old('select_delegacion') == $delegacion->id ? 'selected' : '' }}> {{ $delegacion->delegacion }} | {{ $delegacion->nivel }} | {{ $delegacion->sede }}</option>
                        @endforeach                        
                    </x-adminlte-select>

                    <x-adminlte-select name="select_secretaria" label="SECRETARÍA" label-class="text-orange" fgroup-class="col-md-4">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-city text-orange"></i>
                            </div>
                        </x-slot>
                        <option value="{{$userSecretaria->id}}" selected> {{$userSecretaria->cartera_secretaria }} </option>
                        @foreach ($secretarias as $id => $secretaria)
                            <option value="{{$id}}" {{ old('select_secretaria') == $id ? 'selected' : '' }} >{{$secretaria}}</option>
                        @endforeach
                    </x-adminlte-select>                    

                </div>                

                <div class="row">
                    <x-adminlte-select name="select_titulo" label="TITULO" label-class="text-orange" fgroup-class="col-md-3">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-city text-orange"></i>
                            </div>
                        </x-slot>
                        <option value="{{$user->titulo}}" selected>{{$user->titulo}}</option>
                        <option value="PROF."  {{ old('select_titulo',$user->titulo) == 'PROF.' ? 'selected' : '' }} >PROF.</option>
                        <option value="PROFA." {{ old('select_titulo',$user->titulo) == 'PROFA.' ? 'selected' : '' }} >PROFA.</option>
                    </x-adminlte-select>


                    <x-adminlte-input type="text" name="nombre" id="nombre" label="NOMBRE" placeholder="Ingresa tu nombre" label-class="text-orange" value="{{ old('nombre', $user->nombre) }}" fgroup-class="col-md-3">

                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-orange"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>  
    
                    <x-adminlte-input type="text" name="apellido_paterno" id="apellido_paterno" label="PRIMER APELLIDO" placeholder="Ingresa tu apellido paterno" label-class="text-orange" value="{{old('apellido_paterno', $user->apaterno)}}" fgroup-class="col-md-3" >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-orange"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>   
    
                    <x-adminlte-input type="text" name="apellido_materno" id="apellido_materno" label="SEGUNDO APELLIDO" placeholder="Ingresa tu apellido materno" label-class="text-orange" value="{{old('apellido_materno', $user->amaterno)}}" fgroup-class="col-md-3" >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-orange"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>   
                </div>


                <div class="row">
                    {{-- Email type --}}
                    <x-adminlte-input name="email" id="email" type="email" label="CORREO ELECTRÓNICO" label-class="text-orange" placeholder="Ingresa tu email"  fgroup-class="col-md-3" value=" {{ old('email',$user->email)}} " >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-envelope text-orange"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-input name="telefono" id="telefono" type="text" label="CORREO ELECTRÓNICO" label-class="text-orange" placeholder="Ingresa tu telefono"  fgroup-class="col-md-3" value=" {{ old('telefono',$user->telefono)}} " >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-phone text-orange"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                </div>
                
                <hr>

                <div class="row">
                    <x-adminlte-select name="select_rol" label="ROL" label-class="text-orange" fgroup-class="col-md-12">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-users text-orange"></i>
                            </div>
                        </x-slot>
                        <option value="" empty-option="Selecciona un Rol" >Selecciona un Rol</option>
                        @foreach($roles as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>



                <div class="row">
                    {!! Form::button('Actualizar', ['type' => 'submit', 'class' => 'btn btn-primary float-right']) !!}
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
    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borrarlo!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });

            })
        });
    </script>
@stop