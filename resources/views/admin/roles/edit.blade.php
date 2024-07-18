@extends('adminlte::page')

@section('title', 'Roles y Permisos')

@section('content_header')
    <div class="title">
        INFORMACIÓN DE ROLES Y PERMISOS
        <h5>
            ASIGNAR PERMISOS
        </h5>      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            
            
            <div class="title float-left">
                <h5>
                    <strong style="text-transform:uppercase">Rol de {{$role->name}}</strong>
                </h5>
            </div>
            <div style="margin-right:0px;" class="float-right">
                <a href="{{ URL::previous() }}" class="btn btn-secondary float-right"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
            </div>
        </div>
        <div class="card-body">
            <div class="card-text">
                {!! Form::model($role, ['route'=>['rol.update',$role],'method'=>'PUT']) !!}
                    <label for="">Permisos para este rol:</label> <br>

                    @foreach ($permisos as $item)
                        {!! Form::checkbox('permisos[]', $item->id, array_key_exists($item->id, $rolePermissions), ['class'=>'mr-1']) !!} &ensp; {{$item->name}} <br>
                    @endforeach


                    {!! Form::button('<i class="fa fa-key"></i> Asignar permisos', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-left', 'aria-hidden' => 'true']) !!}

                {!! Form::close() !!}
            </div>

            
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
{{-- 
Swal.fire({
    title: "The Internet?",
    text: "That thing is still around?",
    icon: "question"
  }); --}}