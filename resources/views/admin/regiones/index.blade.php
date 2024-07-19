@extends('adminlte::page')

@section('title', 'Regiones')

@section('content_header')
    <div class="title">
        INFORMACIÓN DE LAS REGIONES REGISTRADOS EN EL SISTEMA
        <h5>
            LISTADO GENERAL
        </h5>      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Lista de <strong>Regiones</strong>
            {{-- @can('region.create') --}}
                <a href="{{route('region.create')}}" class="btn bg-primary float-right"><i class="fa fa-sm fa-fw fa-pen"></i> Nueva región</a>
            {{-- @endcan --}}
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
            $heads = [
                'ID',
                'REGIÓN',
                'SEDE',
                ['label' => 'ACCIONES', 'no-export' => true, 'width' => 10],
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
                @foreach($regiones as $region)
                    <tr>
                        <td> {{ $region->id }} </td>
                        <td> {{ $region->region }} </td>
                        <td> {{ $region->sede }} </td>
                        <td>
                            {{-- @can('region.edit') --}}
                                <a href="{{route('region.edit',$region)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                            {{-- @endcan --}}

                            {{-- @can('region.destroy') --}}
                                {!! Form::open(['route' => ['region.destroy',$region], 'method' => 'delete', 'class' => 'formEliminar', 'style' => 'display: inline']) !!}
                                    @csrf
                                    @method('DELETE')
                                    {{ Form::button('<i class="fa fa-lg fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-default text-danger mx-1 shadow', 'title' => 'Borrar']) }}
                                {!! Form::close() !!}
                            {{-- @endcan --}}
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
    @if(session('success_region'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success_region') }}"
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: mensaje,
                    text: 'La información de la región se guardo satisfactoriamente.',
                    showConfirmButton: true,
                    // timer: 1950,
                });
            });
        </script>
    @endif    

    @if(session('update_region'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_region') }}"
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

    @if (session('delete_region'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Región borrada",
                text: "La información se borro satisfactoriamente.",
                showConfirmButton: true,
                confirmButtonColor: "#ee7a00",
                // timer: 1950,
            });
        </script>
    @endif
@stop