<title>Register - EHPHASNAOUI</title>
<link rel="icon" href="../assets/img/logozoom.PNG" />
<div class="containerAdmin">
    <div class="screen">
        <div class="screen__content">
            <img src="../assets/img/medeci.gif" width="150" class="img-fluid" alt="" srcset="" />
            
            <!-- Ajout du bloc pour afficher les erreurs -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="login">
                @csrf
                <div><x-label for="name" value="{{ __('Nom') }}" /></div>
                <div class="login__field">
                    <x-input id="name" class="login__input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                <div><x-label for="email" value="{{ __('Email') }}" /></div>
                <div class="login__field">
                    <x-input id="email" class="login__input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>
                <div><x-label for="phone" value="{{ __('N° de téléphone') }}" /></div>
                <div class="login__field">
                    <x-input id="phone" class="login__input" type="text" name="phone" :value="old('phone')" required autocomplete="tel" />
                </div>
                <div><x-label for="address" value="{{ __('Addresse') }}" /></div>
                <div class="login__field">
                    <x-input id="address" class="login__input" type="text" name="address" :value="old('address')" required autocomplete="street-address" />
                </div>
                <div><x-label for="password" value="{{ __('Mot de passe') }}" /></div>
                <div class="login__field">
                    <x-input id="password" class="login__input" type="password" name="password" required autocomplete="new-password" />
                </div>
                <div><x-label for="password_confirmation" value="{{ __('Confirmer votre mot de passe') }}" /></div>
                <div class="login__field">
                    <x-input id="password_confirmation" class="login__input" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Déjà inscrit?') }}
                    </a>
                    <x-button class="login__submit ms-4">
                        {{ __('s inscrire') }}
                    </x-button>
                </div>
            </form>

            <div class="social-login mt-4">
                <img src="../assets/img/Artboard 1 1.png" class="mt-4 img-fluid art" alt="" />
                <div class="social-icons">
                    <a href="#" class="social-login__icon fab fa-instagram"></a>
                    <a href="#" class="social-login__icon fab fa-facebook"></a>
                    <a href="#" class="social-login__icon fab fa-twitter"></a>
                </div>
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

<link rel="stylesheet" href="../assets/css/register.css">