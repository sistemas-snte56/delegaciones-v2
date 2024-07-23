@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="title">
        INFORMACIÓN DE LOS PERMISOS PARA ROLES REGISTRADOS EN EL SISTEMA      
    </div> 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Role : {{ $role->name }}
                <a href="{{ url('admin/roles') }}" class="btn btn-secondary float-end"><i class="fa fa-sm fa-fw fa-home"></i>&nbsp;Regresar</a>
            </h3>






        </div>
        <div class="card-body">

            <form action="{{ route('rol.give.permissions',$role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    @error('permission')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="">Permisos para {{$role->name}} </label>

                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="permission[]"
                                        id="permission-{{ $permission->id }}"
                                        value="{{ $permission->name }}"
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                    />
                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    

                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Asignar rol</button>
                </div>
            </form>


        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
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
@stop