<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permiso.show|permiso.create|permiso.edit|permiso.destroy',['only' => ['index']]);
        $this->middleware('permission:permiso.create',  ['only' => ['create','store']]);
        $this->middleware('permission:permiso.edit',    ['only' => ['edit','update']]);
        $this->middleware('permission:permiso.destroy', ['only' => ['destroy']]);
    }    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = Permission::get();
        return view('admin.permisos.index', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $permission = Permission::create(['name' => $request->input('nombre')]);
        return redirect()->route('permiso.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
