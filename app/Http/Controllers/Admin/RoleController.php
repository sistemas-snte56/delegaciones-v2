<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:view role', ['only' => ['index']]);
        // $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        // $this->middleware('permission:update role', ['only' => ['update','edit']]);
        // $this->middleware('permission:delete role', ['only' => ['destroy']]);

        $this->middleware('permission:role.index')->only('index');

        #El permiso role.edit sera cuando se vaya a la vista edit o update
        $this->middleware('permission:role.edit')->only('edit','update');
        $this->middleware('permission:role.create')->only('create','store','addPermissionToRole','givePermissionToRole');
        $this->middleware('permission:role.destroy')->only('destrit');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'nombre' => [ 'required','string','unique:roles,name' ],
        ]);

        Role::create([
            'name' => $request->input('nombre'),
        ]);

        return redirect()->route('rol.index')->with('success_rol','Rol guardado.');
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
        $role = Role::findOrFail($id);
        return view('admin.roles.edit',compact('role'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'nombre' => [ 'required','string','unique:roles,name,'.$id ],
        ]);

        $role = Role::find($id);

        $role->name = $request->input('nombre');
        $role->update();

        return redirect()->route('rol.index')->with('update_rol','Rol Actualizado.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('rol.index')->with('delete_rol','Rol Eliminado.');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();
        return view('admin.roles.add-permissions', compact('role','permissions','rolePermissions'));
    }    

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);

        

        $role->syncPermissions($request->permission);

        return redirect()->back()->with('assign_rol','Asignación de Permisos');
        // return redirect()->route('rol.index')->with('assign_rol','Asignación de Permisos');
    }    
}
