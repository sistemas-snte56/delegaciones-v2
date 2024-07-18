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
            @can('crear-rol')
                {{-- Boton abrir modal --}}
                <x-adminlte-button label="Nuevo Rol" theme="primary" icon="fas fa-pen" data-toggle="modal" data-target="#modalCreateRol" class="float-right"/>
            @endcan
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    'ID',
                    'Rol',
                    ['label' => 'Actions', 'no-export' => true, 'width' => 20],
                ];

                $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>';
                $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Borrar">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>';
                $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>';

                $config = [
                    'data' => [
                        [22, 'John Bender', '+02 (123) 123456789', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
                        [19, 'Sophia Clemens', '+99 (987) 987654321', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
                        [3, 'Peter Sousa', '+69 (555) 12367345243', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
                    ],
                    'order' => [[1, 'asc']],
                    'columns' => [null, null, null, ['orderable' => false]],
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($roles as $rol)
                    <tr>
                        <td> {{ $rol->id }} </td>
                        <td> {{ $rol->name }} </td>
                        <td>
                            {{-- @can('usuario.show') --}}
                                {{-- <a href="{{route('usuario.show',$rol)}}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Mostrar">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </a>                             --}}
                            {{-- @endcan --}}

                            @can('editar-rol')
                                <a href="{{route('rol.edit',$rol)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                    <b>AGREGAR PERMISOS</b>
                                </a>
                                
                            @endcan

                            @can('borrar-rol')
                                {{ Form::open(['route' => ['rol.destroy', $rol], 'method' => 'delete', 'class' => 'formEliminar', 'style' => 'display: inline']) }}
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
        <x-adminlte-modal id="modalCreateRol" title="Nuevo Rol" theme="primary"
            icon="fas fa-user" size='lg' disable-animations>

            

            <div class="card-body">
                {!! Form::open(['route'=>['rol.store'], 'method'=>'POST']) !!}
                    @csrf
                    <div class="row">
                        <x-adminlte-input type="text" name="nombre" id="nombre" placeholder="Ingresa nombre del rol" value="{{old('nombre')}}" fgroup-class="col-md-12" >
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
                    icon: 'success',
                    title: mensaje,
                    text: 'Se ha creado un nuevo rol y ha sido guardado satisfactoriamente.',
                    showConfirmButton: true,
                });
            });
        </script>
    @endif    

    @if(session('update_rol'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_rol') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    text: 'Se ha asignado los permisos satisfactoriamente.',
                    showConfirmButton: true,
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
            });
        </script>
    @endif






@stop
{{-- 
Swal.fire({
    title: "The Internet?",
    text: "That thing is still around?",
    icon: "question"
  }); --}}