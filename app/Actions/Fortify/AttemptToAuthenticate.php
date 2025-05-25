<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AttemptToAuthenticate
{
    public function handle(Request $request, $next)
    {
        Log::info('AttemptToAuthenticate: Starting', ['email' => $request->email]);

        if (Auth::attempt($request->only(['email', 'password']), $request->filled('remember'))) {
            $user = Auth::user();
            Log::info('AttemptToAuthenticate: User authenticated', [
                'email' => $user->email,
                'verified' => $user->hasVerifiedEmail()
            ]);

            if (!$user->hasVerifiedEmail()) {
                Log::info('AttemptToAuthenticate: Email not verified, logging out');
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                session()->flash('error', 'Veuillez vérifier votre adresse email avant de vous connecter.');
                return null;
            }

            Log::info('AttemptToAuthenticate: Authentication successful');
            return $user;
        }

        Log::info('AttemptToAuthenticate: Authentication failed');
        session()->flash('error', 'Les identifiants fournis sont incorrects.');
        return null;
    }
}