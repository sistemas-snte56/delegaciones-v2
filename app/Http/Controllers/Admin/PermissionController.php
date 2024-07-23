<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission.index')->only('index');

        #El permiso permission.edit sera cuando se vaya a la vista edit o update
        $this->middleware('permission:permission.edit')->only('edit','update');
        $this->middleware('permission:permission.create')->only('create','store');
        $this->middleware('permission:permission.destroy')->only('destrit');
    }    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::get();
        return view('admin.permisos.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permisos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'nombre' => [ 'required','string','unique:permissions,name' ],
        ]);

        Permission::create([
            'name' => $request->input('nombre'),
        ]);

        return redirect()->route('permission.index')->with('success_permission','Permission Guardado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        
        return view('admin.permisos.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validation = $request->validate([
            'nombre' => [ 'required','string','unique:permissions,name,'.$permission->id],
        ]);

        $permission->update([
            'name' => $request->input('nombre'),
        ]);

        return redirect()->route('permission.index')->with('update_permission','Permission Actualizado.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission.index')->with('delete_permission','Permission Borrado.');
    }
}
