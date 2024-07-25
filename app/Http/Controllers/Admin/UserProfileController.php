<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class UserProfileController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('user_profile.show', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,)
    {

        $user = Auth::user(); // Obtener el usuario autenticado

        // // Validación de los datos del formulario
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        //     // Añade más reglas de validación según tus necesidades
        // ]);

        $validation = $request->validate([
            'select_titulo' => ['required', 'max:260', 'string'],
            'nombre' => ['required', 'max:260', 'string'],
            'apellido_paterno' => ['required', 'max:260', 'string'],
            'email' => ['required', 'max:260', 'string', 'unique:users,email,'.$user->id],
        ]);

        # Asignar el valor de los campo convertido a mayúsculas usando mb_strtoupper
        # 'UTF-8' especifica la codificación de caracteres multibyte que estamos utilizando
        $user->titulo = $request->input('select_titulo');
        $user->nombre = mb_strtoupper($request->input('nombre'),'UTF-8');
        $user->apaterno = mb_strtoupper($request->input('apellido_paterno'),'UTF-8');
        $user->amaterno = mb_strtoupper($request->input('apellido_materno'),'UTF-8');
        $user->email = $request->input('email');

        
        $user->update();






        return redirect()->route('perfil.show')->with('success', 'Perfil actualizado correctamente');



    }    
}
