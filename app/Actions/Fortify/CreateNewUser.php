<?php

namespace App\Actions\Fortify;

use App\Models\Promotor;
use App\Models\Rango;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'telefono' => ['required', 'numeric'],
            'nit' => ['required', 'numeric'],
            'direccion' => ['required', 'string', 'max:255'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole('promotor');
        // Obtener el rango con el menor descuento
        $rango = Rango::orderBy('descuento', 'asc')->first();
        Promotor::create([
            'user_id' => $user->id,
            'rango_id' => $rango->id,
            'telefono' => $input['telefono'],
            'direccion' => $input['direccion'],
            'nit' => $input['nit'],
            'puntos' => 5000,
        ]);

        return $user;
    }
}
