@extends('adminlte::page')

@section('title', 'permissiones')

@section('content_header')
    <div class="title">
        INFORMACIÓN DE LOS PERMISOS REGISTRADOS EN EL SISTEMA
        <h5>
            LISTADO GENERAL
        </h5>      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Lista de <strong>PERMISOS</strong>
                <a href="{{route('permission.create')}}" class="btn bg-primary float-right"><i class="fa fa-sm fa-fw fa-pen"></i> Nuevo permiso</a>
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    'ID',
                    'PERMISO',
                    ['label' => 'ACCIONES', 'no-export' => true, 'width' => 15],
                ];

                $config = [
                    'order' => [[0, 'asc']],
                    'columns' => [null, null, ['orderable' => false]],
                    'language' => ['url' => 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',],
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable bordered compressed>
                @foreach($permissions as $permission)
                    <tr>
                        <td> {{ $permission->id }} </td>
                        <td> {{ $permission->name }} </td>
                        <td>
                            @can('permission.edit')
                                <a href="{{route('permission.edit',$permission)}}" class="btn btn-default text-primary mx-1 shadow" title="Editar">
                                    <i class="fa fa-sm fa-fw fa-pen"></i>
                                    Editar
                                </a>
                            @endcan

                            @can('permission.destroy')
                                {!! Form::open(['route' => ['permission.destroy',$permission], 'method' => 'delete', 'class' => 'formEliminar', 'style' => 'display: inline']) !!}
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
    @if(session('success_permission'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success_permission') }}"
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: mensaje,
                    text: 'La información del permission se guardo satisfactoriamente.',
                    showConfirmButton: true,
                    // timer: 1950,
                });
            });
        </script>
    @endif    

    @if(session('update_permission'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_permission') }}"
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: mensaje,
                    text: 'Se actualizo el nombre del permission satisfactoriamente.',
                    showConfirmButton: true,
                    // timer: 1950,
                });
            });
        </script>
    @endif    

    @if(session('assign_permission'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_permission') }}"
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: mensaje,
                    text: 'Se ha asignado los permisos a el permission de forma satisfactoria.',
                    showConfirmButton: true,
                    // timer: 1950,
                });
            });
        </script>
    @endif    





    

    @if (session('delete_permission'))
        <script>
            Swal.fire({
                icon: "error",
                title: "permission Eliminado",
                text: "La información se borro satisfactoriamente.",
                showConfirmButton: true,
                confirmButtonColor: "#ee7a00",
                // timer: 1950,
            });
        </script>
    @endif
@stop