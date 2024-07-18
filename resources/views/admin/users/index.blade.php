@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <div class="title">
        INFORMACIÓN DE USUARIOS REGISTRADOS EN EL SISTEMA
        <h5>
            LISTADO GENERAL
        </h5>      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Lista de <strong>Regiones</strong>
            @can('user.create')
                <a href="{{route('user.create')}}" class="btn btn-primary float-right"><i class="fa fa-sm fa-fw fa-pen"></i>&emsp;Nuevo usuario</a>
            @endcan
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
            $heads = [
                'ID',
                'Name',
                ['label' => 'Email', 'width' => 40],
                'Rol',
                ['label' => 'Actions', 'no-export' => true, 'width' => 10],
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
                @foreach($users as $user)
                    <tr>
                        <td> {{ $user->id }} </td>
                        <td> {{ $user->titulo }} {{ $user->nombre }} {{ $user->apaterno }} {{ $user->amaterno }} </td>
                        <td> {{ $user->email }} </td>
                        <td> 
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $rolName)
                                    <h5><span class="badge badge-dark">{{$rolName}}</span></h5>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @can('user.show')
                                <a href="{{route('user.show',$user)}}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Mostrar">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </a>                            
                            @endcan

                            @can('user.edit')
                                <a href="{{route('user.edit',$user)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                            @endcan

                            @can('user.destroy')
                                {!! Form::open(['route' => ['user.destroy',$user], 'method' => 'delete', 'class' => 'formEliminar', 'style' => 'display: inline']) !!}
                                    @csrf
                                    @method('DELETE')
                                    {{ Form::button('<i class="fa fa-lg fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-default text-danger mx-1 shadow', 'title' => 'Borrar']) }}
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

    @if(session('update_user'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_user') }}"
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

    @if (session('delete_user'))
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
{{-- 
Swal.fire({
    title: "The Internet?",
    text: "That thing is still around?",
    icon: "question"
  }); --}}