<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;




class RolController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:rol.show|rol.create|rol.edit|rol.destroy', ['only' => ['index']]);
        $this->middleware('permission:rol.create',  ['only' => ['create','store']]);
        $this->middleware('permission:rol.edit',    ['only' => ['edit','update']]);
        $this->middleware('permission:rol.destroy', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'nombre' => 'required',
            'permisos' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('nombre')]);
        $role->syncPermissions($request->input('permisos'));

        return redirect()->route('rol.index');
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
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permisos = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();
        
        return view('admin.roles.edit', compact('role','permisos','rolePermissions'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'nombre' => 'required',
            'permisos' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('nombre');
        $role->save();

        $role->syncPermissions($request->input('permisos'));
        return redirect()->route('rol.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('rol.index');
    }
}
