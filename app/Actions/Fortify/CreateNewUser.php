<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        
        Validator::make($input, [
            // // # Validando por default
            // // 'name' => ['required', 'string', 'max:255'],
            // // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // // 'password' => $this->passwordRules(),
            // // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',

            # Validando los campos modificados:
            'select_region' => ['required','int', 'max:255'],
            'select_delegacion' => ['required','int', 'max:655'],
            'select_secretaria' => ['required','int', 'max:255'],
            'select_titulo' => ['required','string', 'max:255'],
            'nombre' => ['required','string','max:255'],
            'apellido_paterno' => ['required','string','max:255'],
            'select_genero' => ['required','int', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',

        ])->validate();


        return User::create([
            # Se guardan los registros actuales
            // 'name' => $input['name'],
            // 'email' => $input['email'],
            // 'password' => Hash::make($input['password']),

            # Guardamos los datos modificados
            'id_region' => $input['select_region'],
            'id_delegacion' => $input['select_delegacion'],
            'id_secretaria' => $input['select_secretaria'],
            'id_genero' => $input['select_genero'],
            'titulo' => $input['select_titulo'],
            'nombre' => $input['nombre'],
            'apaterno' => $input['apellido_paterno'],
            'amaterno' => $input['apellido_materno'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
