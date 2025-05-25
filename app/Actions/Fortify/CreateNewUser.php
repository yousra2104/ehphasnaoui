<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Log;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        Log::info('CreateNewUser: Attempting to create user', ['email' => $input['email']]);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], [
            'email.email' => "L'email que vous avez fourni n'est pas valide",
            'email.unique' => "Cet email est déjà utilisé",
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'usertype' => isset($input['usertype']) ? $input['usertype'] : '0',
        ]);

        Log::info('CreateNewUser: User created', ['email' => $user->email]);

        $user->sendEmailVerificationNotification();

        return $user;
    }
}