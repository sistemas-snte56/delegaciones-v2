{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-welcome />
        </div>
    </div>
</div>
</x-app-layout> --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <h3>{{ Auth::user()->nombre }}</h3>

    @php
        $user = Auth::user();
        $roles = $user->getRoleNames();
    @endphp

    <div>
        Bienvenido, {{ Auth::user()->nombre }}
        @if($roles->isNotEmpty())
            <p>Tus roles son: {{ $roles->implode(', ') }}</p>
            <ul>
                @foreach($roles as $roleName)
                    @php
                        $role = Spatie\Permission\Models\Role::where('name', $roleName)->first();
                    @endphp
                    @if($role)
                        <li>{{ $roleName }}:
                            <ul>
                                @foreach($role->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        @else
            <p>No tienes roles asignados.</p>
        @endif
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
