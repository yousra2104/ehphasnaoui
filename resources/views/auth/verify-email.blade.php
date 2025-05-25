<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de l'email - EHPHASNAOUI</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="containerAdmin">
        <div class="screen">
            <div class="screen__content">
                <img src="../assets/img/medeci.gif" width="150" class="img-fluid" alt="Logo" srcset="" />
                <h2>Vérifiez votre adresse email</h2>

                <!-- Affichage des erreurs -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <p>
                    Un lien de vérification a été envoyé à votre adresse email. Veuillez vérifier votre boîte de réception (et vos spams) pour confirmer votre compte.
                </p>

                <!-- Formulaire pour renvoyer l'email de vérification -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <p>
                        Si vous n'avez pas reçu l'email, vous pouvez en demander un nouveau :
                    </p>
                    <x-button class="button login__submit text-center">
                        {{ __('Renvoyer l\'email de vérification') }}
                    </x-button>
                </form>

                <!-- Lien pour se déconnecter -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="underline text-sm text-gray-600 hover:text-gray-900">
                       {{ __('Se déconnecter') }}
                    </a>
                </form>
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