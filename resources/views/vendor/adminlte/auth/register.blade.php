@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        @csrf


        {{-- Región field --}}
        <?php
            $regiones = App\Models\Admin\Region::all();
        ?>
        <div class="input-group mb-3">
            <select name="select_region"  class="form-control @error('select_region') is-invalid @enderror">
                <option value="" autofocus>Selecciona región</option>
                @foreach($regiones as $region)
                    <option value="{{ $region->id }}" {{ old('select_region') == $region->id ? 'selected' : '' }}>{{ $region->region }} - {{ $region->sede }}</option>
                @endforeach
            </select>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-venus-mars"></span>
                </div>
            </div>

            @error('select_region')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
        </div>          


        {{-- Delegación field --}}
        <?php
            // $delegaciones = App\Models\Admin\Delegacion::all();
            $delegaciones = App\Models\Admin\Delegacion::select('delegaciones.id',
                                   DB::raw("CONCAT(nomenclatura.nomenclatura, delegaciones.num_delegaciona) AS delegacion"),
                                   'delegaciones.nivel_delegaciona as nivel', 'delegaciones.sede_delegaciona as sede')
                ->join('nomenclatura', 'delegaciones.id_nomenclatura', '=', 'nomenclatura.id')
                ->orderBy('delegacion')
                ->get();
        ?>
        <div class="input-group mb-3">
            <select name="select_delegacion"  class="form-control @error('select_delegacion') is-invalid @enderror">
                <option value="" autofocus>Selecciona delegación</option>
                @foreach($delegaciones as $delegacion)
                    <option value="{{ $delegacion->id }}" {{ old('select_delegacion') == $delegacion->id ? 'selected' : '' }}> {{ $delegacion->delegacion }} | {{ $delegacion->nivel }} | {{ $delegacion->sede }}</option>
                @endforeach
            </select>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-venus-mars"></span>
                </div>
            </div>

            @error('select_delegacion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
        </div> 



        {{-- Secretaría field --}}
        <?php
            $secretarias = App\Models\Admin\Secretaria::all();
        ?>
        <div class="input-group mb-3">
            <select name="select_secretaria"  class="form-control @error('select_secretaria') is-invalid @enderror">
                <option value="" autofocus>Selecciona Secretaría</option>
                @foreach($secretarias as $secretaria)
                    <option value="{{ $secretaria->id }}" {{ old('select_secretaria') == $secretaria->id ? 'selected' : '' }}>{{ $secretaria->cartera_secretaria }}</option>
                @endforeach
            </select>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-venus-mars"></span>
                </div>
            </div>

            @error('select_secretaria')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
        </div>   



        {{-- Titulo field --}}
        <div class="input-group mb-3">
            <select name="select_titulo" class="form-control @error('select_titulo') is-invalid @enderror">
                <option value="" autofocus>Selecciona Título</option>
                <option value="PROF." {{ old('select_titulo') == 'PROF.' ? 'selected' : '' }}>PROF.</option>
                <option value="PROFA." {{ old('select_titulo') == 'PROFA.' ? 'selected' : '' }}>PROFA.</option>
            </select>
            

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-venus-mars"></span>
                </div>
            </div>

            @error('select_titulo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
        </div>   



        {{-- Nombre field --}}
        <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                   value="{{ old('nombre') }}" placeholder="Nombre (s)" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Primer apellido field --}}
        <div class="input-group mb-3">
            <input type="text" name="apellido_paterno" class="form-control @error('apellido_paterno') is-invalid @enderror"
                   value="{{ old('apellido_paterno') }}" placeholder="Primer apellido" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @error('apellido_paterno')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Segundo apellido field --}}
        <div class="input-group mb-3">
            <input type="text" name="apellido_materno" class="form-control @error('apellido_materno') is-invalid @enderror"
                   value="{{ old('apellido_materno') }}" placeholder="Segundo apellido" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @error('apellido_materno')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Genero field --}}
        <?php
            $generos = App\Models\Admin\Genero::all();
        ?>
        <div class="input-group mb-3">
            <select name="select_genero"  class="form-control @error('select_genero') is-invalid @enderror">
                <option value="">Selecciona género</option>
                @foreach($generos as $genero)
                    <option value="{{ $genero->id }}" {{ old('select_genero') == $genero->id ? 'selected' : '' }}>{{ $genero->genero }}</option>
                @endforeach
            </select>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-venus-mars"></span>
                </div>
            </div>

            @error('select_genero')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror            
        </div>  



        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>




        {{-- Teléfono field --}}
        <div class="input-group mb-3">
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                   value="{{ old('telefono') }}" placeholder="Teléfono" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Dirección field --}}
        <div class="input-group mb-3">
            <input type="text" name="dirección" class="form-control @error('dirección') is-invalid @enderror"
                   value="{{ old('dirección') }}" placeholder="Dirección" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-street-view {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @error('dirección')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Código postal field --}}
        <div class="input-group mb-3">
            <input type="text" name="codigo_postal" class="form-control @error('codigo_postal') is-invalid @enderror"
                   value="{{ old('codigo_postal') }}" placeholder="Código postal" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @error('codigo_postal')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Ciudad field --}}
        <div class="input-group mb-3">
            <input type="text" name="ciudad" class="form-control @error('ciudad') is-invalid @enderror"
                   value="{{ old('ciudad') }}" placeholder="Ciudad" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-city {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @error('ciudad')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Estado field --}}
        <div class="input-group mb-3">
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror"
                   value="{{ old('estado') }}" placeholder="Estado" >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-city {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @error('estado')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>







        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
