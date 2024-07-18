@extends('adminlte::page')

@section('title', 'Roles y Permisos')

@section('content_header')
    <div class="title">
        INFORMACIÓN DE ROLES Y PERMISOS
        <h5>
            LISTADO GENERAL
        </h5>      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Lista de <strong>Roles</strong>
            @can('permiso.create')
                {{-- Boton abrir modal --}}
                <x-adminlte-button label="Nuevo permiso" theme="primary" icon="fas fa-pen" data-toggle="modal" data-target="#modalCreatePermisso" class="float-right"/>
            @endcan
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    'ID',
                    'PERMISOS',
                    ['label' => 'Actions', 'no-export' => true, 'width' => 10],
                ];
                $config = [
                    'order' => [[1, 'asc']],
                    'columns' => [null, null, null, ['orderable' => false]],
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($permission as $permiso)
                    <tr>
                        <td> {{ $permiso->id }} </td>
                        <td> {{ $permiso->name }} </td>
                        <td>
                            @can('permiso.edit')
                                <a href="{{route('permiso.edit',$permiso)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                            @endcan
                            @can('permiso.destroy')
                                {{ Form::open(['route' => ['permiso.destroy', $permiso], 'method' => 'delete', 'class' => 'formEliminar', 'style' => 'display: inline']) }}
                                    @csrf
                                    @method('DELETE')
                                    {{ Form::button('<i class="fa fa-lg fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-default text-danger mx-1 shadow', 'title' => 'Borrar']) }}
                                {{ Form::close() }}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>       
        </div>




        {{-- Themed --}}
        <x-adminlte-modal id="modalCreatePermisso" title="Nuevo Permiso" theme="primary"
            icon="fas fa-user" size='lg' disable-animations>

            

            <div class="card-body">
                {!! Form::open(['route'=>['permiso.store'], 'method'=>'POST']) !!}
                    @csrf
                    <div class="row">
                        <x-adminlte-input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del permiso" value="{{old('nombre')}}" fgroup-class="col-md-12" >
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>   
                    </div>
                    <div class="row">
                        {!! Form::button('Guardar', ['type' => 'submit', 'class' => 'btn btn-primary float-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>










        </x-adminlte-modal>



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
    @if(session('success_save'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success_save') }}"
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: mensaje,
                    text: 'La información del usuario ha sido guardada satisfactoriamente.',
                    showConfirmButton: true,
                    // timer: 1950,
                });
            });
        </script>
    @endif    

    @if(session('update_rol'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_rol') }}"
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: mensaje,
                    text: 'La información del usuario ha sido guardada satisfactoriamente.',
                    showConfirmButton: true,
                    // timer: 1950,
                });
            });
        </script>
    @endif    

    @if (session('delete_rol'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Usuario borrado",
                text: "El registro se borro satisfactoriamente.",
                showConfirmButton: true,
                confirmButtonColor: "#ee7a00",
                // timer: 1950,
            });
        </script>
    @endif






@stop