@extends('adminlte::page')

@section('title', 'Region - Crear')

@section('content_header')
    <div class="title">
    INFORMACIÓN DE LAS REGIONES REGISTRADOS EN EL SISTEMA
        <h5>
            CREAR NUEVA REGIÓN
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
            {!! Form::open(['route'=>['region.store'], 'method'=>'POST']) !!}
                @csrf

                <div class="row" style="width: 60%, margin: 0 auto; ">

                    <x-adminlte-input type="text" name="region" id="region" label="REGIÓN" placeholder="Ingresa nombre de region" label-class="text-orange" value="{{old('region')}}" fgroup-class="col-md-6" >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-orange"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>  
    
                    <x-adminlte-input type="text" name="sede" id="sede" label="SEDE" placeholder="Ingresa tu apellido paterno" label-class="text-orange" value="{{old('sede')}}" fgroup-class="col-md-6" >
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