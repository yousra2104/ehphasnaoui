<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EHPHASNAOUI</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="containerAdmin">
        <div class="screen">
            <div class="screen__content">
                <img src="../assets/img/medeci.gif" width="150" class="img-fluid" alt="Logo" srcset="" />
                <form class="login" method="POST" action="{{ route('login') }}">
                    @csrf    
                    <p>Connecter à votre compte</p>

                    <!-- Display General Authentication Error -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Email Field -->
                    <div class="login__field">
                        <x-input 
                            id="email" 
                            class="login__input" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username" 
                            placeholder="E-mail" 
                        />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @endif
                    </div>

                    <!-- Password Field -->
                    <div class="login__field">
                        <x-input 
                            id="password" 
                            class="login__input" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password" 
                            placeholder="Mot de passe" 
                        />
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @endif
                    </div>

                    <a href="{{ route('register') }}">Pas encore inscrit ?</a>
                    <x-button class="button login__submit text-center">
                        {{ __('Se connecter') }}
                    </x-button>
                </form>
                <div class="social-login mt-4">
                    <img src="../assets/img/Artboard 1 1.png" class="art mt-4 img-fluid" alt="Artboard" />
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>        
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>        
        </div>
    </div>
</body>
</html>