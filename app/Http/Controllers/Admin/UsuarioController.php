<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin\Delegacion;
use App\Models\Admin\Region;
use App\Models\Admin\Secretaria;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:usuario.show|usuario.create|usuario.edit|usuario.destroy', ['only' => ['index']]);
        $this->middleware('permission:usuario.create',  ['only' => ['create','store']]);
        $this->middleware('permission:usuario.edit',    ['only' => ['edit','update']]);
        $this->middleware('permission:usuario.destroy', ['only' => ['destroy']]);
    }
        
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        #Enviar las regiones como array 
        $regiones = Region::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->region . ' - ' . $item->sede];
        })->toArray();

        $delegaciones = Delegacion::select('delegaciones.id',
                            DB::raw("CONCAT(nomenclatura.nomenclatura, delegaciones.num_delegaciona) AS delegacion"),
                            'delegaciones.nivel_delegaciona as nivel', 'delegaciones.sede_delegaciona as sede')
                            ->join('nomenclatura', 'delegaciones.id_nomenclatura', '=', 'nomenclatura.id')
                            ->orderBy('delegacion')
                            ->get();        



        $secretarias = Secretaria::pluck('cartera_secretaria','id');
        $roles = Role::pluck('name','name')->all();
        return view('admin.usuarios.create', compact('roles','regiones','delegaciones','secretarias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'select_region' => ['required','int', 'max:255'],
            'select_delegacion' => ['required','int', 'max:655'],
            'select_secretaria' => ['required','int', 'max:255'],
            // 'select_roles' => ['required','int', 'max:255'],
            'select_titulo' => ['required','string', 'max:255'],
            'nombre' => ['required','string','max:255'],
            'apellido_paterno' => ['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|min:8|confirmed',
        ]);

        $user = new User();

        // # Asignar el valor de los campo convertido a mayúsculas usando mb_strtoupper
        // # 'UTF-8' especifica la codificación de caracteres multibyte que estamos utilizando        
        $user->id_region  = $request->input('select_region');
        $user->id_delegacion  = $request->input('select_delegacion');
        $user->id_secretaria  = $request->input('select_secretaria');
        if ($request->input('select_titulo') === 'PROF.') {
            $user->id_genero  = 1;
        } elseif ($request->input('select_titulo') === 'PROFA.') {
            $user->id_genero  = 2;
        }        

        $user->titulo  = $request->input('select_titulo');
        $user->nombre  = mb_strtoupper($request->input('nombre'),'UTF-8') ;
        $user->apaterno  = mb_strtoupper($request->input('apellido_paterno'),'UTF-8') ;
        $user->amaterno  = mb_strtoupper($request->input('apellido_materno'),'UTF-8') ;
        $user->email  = strtolower($request->input('email'));
        $user->password  = Hash::make($request->input('password')) ;

        // # Se le asigna Rol
        // $user->assignRole($request->input('select_roles'));


        # Guardar el nuevo registro en la base de datos
        $user->save(); 

        # Regresamos a la vista Index
        // return view('admin.usuarios.index', compact('user'));  
        return redirect()->route('usuario.index')->with('success_save','Registro guardado');
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
        $user = User::find($id);

        #Enviar las regiones como array 
        $regiones = Region::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->region . ' - ' . $item->sede];
        })->toArray();

        
        $userDelegacion = Delegacion::findOrFail($user->id_delegacion);
        $userSecretaria = Secretaria::findOrFail($user->id_secretaria);

        // dd($userSecretaria);

      

        $delegaciones = Delegacion::select('delegaciones.id',
                            DB::raw("CONCAT(nomenclatura.nomenclatura, delegaciones.num_delegaciona) AS delegacion"),
                            'delegaciones.nivel_delegaciona as nivel', 'delegaciones.sede_delegaciona as sede')
                            ->join('nomenclatura', 'delegaciones.id_nomenclatura', '=', 'nomenclatura.id')
                            ->orderBy('delegacion')
                            ->get();        



        $secretarias = Secretaria::pluck('cartera_secretaria','id');
       
       
       
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.usuarios.edit', compact('user','roles','userRole','regiones','delegaciones','secretarias','userDelegacion','userSecretaria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'select_region' => 'required',
            'select_delegacion' => 'required',
            'select_secretaria' => 'required',
            'select_titulo' => 'required',
            // 'select_roles' => 'required',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            // 'select_genero' => 'required',
            'email' => 'required|email|unique:maestros,email,'.$id,
        ]);

        $user = User::find($id);

        # Asignar el valor de los campo convertido a mayúsculas usando mb_strtoupper
        # 'UTF-8' especifica la codificación de caracteres multibyte que estamos utilizando        
        $user->id_region  = $request->input('select_region');
        $user->id_delegacion  = $request->input('select_delegacion');
        $user->id_secretaria  = $request->input('select_secretaria');
        $user->titulo  = mb_strtoupper($request->input('select_titulo'),'UTF-8') ;

        if ($request->input('select_titulo') === 'PROF.') {
            $user->id_genero  = 1;
        } elseif ($request->input('select_titulo') === 'PROFA.') {
            $user->id_genero  = 2;
        }   

        $user->nombre  = mb_strtoupper($request->input('nombre'),'UTF-8') ;
        $user->apaterno  = mb_strtoupper($request->input('apellido_paterno'),'UTF-8') ;
        $user->amaterno  = mb_strtoupper($request->input('apellido_materno'),'UTF-8') ;
        $user->email  = $request->input('email');

        // dd($user);
 
        $user->update();


        // DB::table('model_has_roles')->where('model_id',$id)->delete();

        // $user->assignRole($request->input('roles'));
        
        return redirect()->route('usuario.index',$user)->with('update_user','Usuario actualizado ');

        // return redirect()->route('maestro.show',$maestro)->with('update', 'Registro actualizado con éxito.');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('usuario.index')->with('delete_user', 'Registo eliminado');
    }
}
