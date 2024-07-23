@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="title">
        INFORMACIÓN DE LOS ROL'S REGISTRADOS EN EL SISTEMA
        <h5>
            LISTADO GENERAL
        </h5>      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Lista de <strong>Roles</strong>
                <a href="{{route('rol.create')}}" class="btn bg-primary float-right"><i class="fa fa-sm fa-fw fa-pen"></i> Nuevo Rol</a>
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
            $heads = [
                'ID',
                'ROL',
                ['label' => 'ACCIONES', 'no-export' => true, 'width' => 25],
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
                'order' => [[1, 'asc']],
                'columns' => [null, null, ['orderable' => false]],
            ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($roles as $rol)
                    <tr>
                        <td> {{ $rol->id }} </td>
                        <td> {{ $rol->name }} </td>
                        <td>
                            @can('role.edit')
                                <a href="{{route('rol.add.permissions',$rol)}}" class="btn btn-default text-success mx-1 shadow" title="Editar">
                                    <i class="fa fa-sm fa-fw fa-cog"></i> 
                                    Asignar
                                </a>
                            @endcan

                            @can('role.edit')
                                <a href="{{route('rol.edit',$rol)}}" class="btn btn-default text-primary mx-1 shadow" title="Editar">
                                    <i class="fa fa-sm fa-fw fa-pen"></i>
                                    Editar
                                </a>
                            @endcan


                            @can('role.destroy')
                                {!! Form::open(['route' => ['rol.destroy',$rol], 'method' => 'delete', 'class' => 'formEliminar', 'style' => 'display: inline']) !!}
                                    @csrf
                                    @method('DELETE')
                                    {{ Form::button('<i class="fa fa-sm fa-fw fa-trash"></i> Borrar', ['type' => 'submit', 'class' => 'btn btn-default text-danger mx-1 shadow', 'title' => 'Borrar']) }}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>      

            
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
    @if(session('success_rol'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success_rol') }}"
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: mensaje,
                    text: 'La información del rol se guardo satisfactoriamente.',
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
                    text: 'Se actualizo el nombre del rol satisfactoriamente.',
                    showConfirmButton: true,
                    // timer: 1950,
                });
            });
        </script>
    @endif    

    @if(session('assign_rol'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_rol') }}"
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: mensaje,
                    text: 'Se ha asignado los permisos a el rol de forma satisfactoria.',
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
                title: "Rol Eliminado",
                text: "La información se borro satisfactoriamente.",
                showConfirmButton: true,
                confirmButtonColor: "#ee7a00",
                // timer: 1950,
            });
        </script>
    @endif
@stop