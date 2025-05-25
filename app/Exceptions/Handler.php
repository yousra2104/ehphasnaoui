<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            Log::warning('AuthorizationException caught', [
                'user' => Auth::check() ? Auth::user()->email : 'guest',
                'verified' => Auth::check() ? Auth::user()->hasVerifiedEmail() : false,
                'path' => $request->path(),
            ]);

            if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')->withErrors([
                    'email' => 'Veuillez vérifier votre adresse email pour accéder à cette page.',
                ]);
            }

            return response()->view('errors.403', [], 403);
        }

        return parent::render($request, $exception);
    }
}