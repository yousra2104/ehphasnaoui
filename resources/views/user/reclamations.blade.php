<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Réclamations - EHPHASNAOUI</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/BreadcumbsVisite.css" />
    <link rel="stylesheet" href="../assets/css/theme.css" />
    <link rel="stylesheet" href="../assets/css/contactform.css" />
    <link rel="stylesheet" href="../assets/css/globals.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icofont/1.0.1/icofont.min.css" />
    <style>
        /* Ensure the entire page is responsive */
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Container for better responsiveness */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Contact section */
        .contact-us.section {
            padding: 40px 0;
        }

        .contact-us .inner {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Left side (Google Maps) */
        .contact-us-left {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .contact-us-left iframe {
            width: 100%;
            height: 100%;
            max-height: 100%;
            border: 0;
        }

        /* Form styling */
        .contact-us-form {
            padding: 20px;
        }

        .contact-us-form h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .contact-us-form p {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        /* Form field borders and consistent styling */
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select,
        .form-group textarea,
        .form-group input[type="checkbox"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #23B6EA;
            outline: none;
            box-shadow: 0 0 5px rgba(35, 182, 234, 0.3);
        }

        /* Checkbox styling to match other inputs */
        .form-group input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
            vertical-align: middle;
        }

        .form-group label {
            font-size: 1rem;
            color: #333;
            cursor: pointer;
        }

        /* Checkbox group for complaint types */
        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
            vertical-align: middle;
        }

        .checkbox-group label {
            font-size: 1rem;
            cursor: pointer;
        }

        /* Error messages */
        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 10px;
            display: block;
        }

        /* Button styling */
        .btn-primary {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #1a9cd1;
            border-color: #1a9cd1;
        }

        /* Contact info section */
        .contact-info .single-info {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #23B6EA;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .contact-info .single-info i {
            font-size: 1.5rem;
            color: #fff;
        }

        .contact-info .single-info h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #fff;
        }

        .contact-info .single-info p {
            margin: 0;
            font-size: 1rem;
            color: #fff;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .contact-us .inner .col-lg-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .contact-us-left iframe {
                height: 300px;
            }

            .contact-us-form {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .contact-us-form h2 {
                font-size: 1.5rem;
            }

            .contact-us-form p {
                font-size: 0.9rem;
            }

            .form-group input[type="text"],
            .form-group input[type="email"],
            .form-group select,
            .form-group textarea {
                font-size: 0.9rem;
                padding: 8px;
            }

            .btn-primary {
                font-size: 0.9rem;
                padding: 10px;
            }

            .contact-info .single-info {
                flex-direction: column;
                text-align: center;
            }

            .contact-info .single-info i {
                margin-bottom: 10px;
            }

            .form-group label,
            .checkbox-group label {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <header>
        @include('user.topbar')
        @include('user.navbar')
    </header>
    <div>
        <div class="breadcrumbs mb-4 overlay">
            <div class="container">
                <div class="bread-inner">
                    <div class="row">
                        <div class="col-12 position-relative">
                            <div class=""></div>
                            <h2 class="text-white position-relative z-index-1">Réclamations</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-us section">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-us-left">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13044.387540437854!2d-0.6318223!3d35.1791377!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd7f01f802624f5b%3A0x23bae99ee4007340!2sEtablissement%20Hospitalier%20Priv%C3%A9%20HASNAOUI!5e0!3m2!1sfr!2sdz!4v1713175879749!5m2!1sfr!2sdz" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-us-form">
                            <h2>Nous sommes à votre écoute</h2>
                            <p>Votre satisfaction est notre priorité. Si vous avez une réclamation ou une suggestion, merci de remplir le formulaire ci-dessous. Nous traiterons votre demande dans les plus brefs délais.</p>

                            @if(session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('reclamations.store') }}" method="POST" id="reclamationsForm">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Nom" value="{{ old('name') }}" required>
                                            @error('name')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Mail" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group d-flex flex-wrap align-items-center">
                                            <div class="w-50 pe-2">
                                                <input type="text" name="phone" placeholder="Téléphone" value="{{ old('phone') }}" required>
                                                @error('phone')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="w-50 ps-2">
                                                <select name="wilaya" id="wilaya" required>
                                                    <option value="">Wilaya</option>
                                                    <option value="Adrar">Adrar</option>
                                                    <option value="Chlef">Chlef</option>
                                                    <option value="Laghouat">Laghouat</option>
                                                    <option value="Oum El Bouaghi">Oum El Bouaghi</option>
                                                    <option value="Batna">Batna</option>
                                                    <option value="Béjaïa">Béjaïa</option>
                                                    <option value="Biskra">Biskra</option>
                                                    <option value="Béchar">Béchar</option>
                                                    <option value="Blida">Blida</option>
                                                    <option value="Bouïra">Bouïra</option>
                                                    <option value="Tamanrasset">Tamanrasset</option>
                                                    <option value="Tébessa">Tébessa</option>
                                                    <option value="Tlemcen">Tlemcen</option>
                                                    <option value="Tiaret">Tiaret</option>
                                                    <option value="Tizi Ouzou">Tizi Ouzou</option>
                                                    <option value="Algiers">Algiers</option>
                                                    <option value="Djelfa">Djelfa</option>
                                                    <option value="Jijel">Jijel</option>
                                                    <option value="Sétif">Sétif</option>
                                                    <option value="Saïda">Saïda</option>
                                                    <option value="Skikda">Skikda</option>
                                                    <option value="Sidi Bel Abbès">Sidi Bel Abbès</option>
                                                    <option value="Annaba">Annaba</option>
                                                    <option value="Guelma">Guelma</option>
                                                    <option value="Constantine">Constantine</option>
                                                    <option value="Médéa">Médéa</option>
                                                    <option value="Mostaganem">Mostaganem</option>
                                                    <option value="M'Sila">M'Sila</option>
                                                    <option value="Mascara">Mascara</option>
                                                    <option value="Ouargla">Ouargla</option>
                                                    <option value="Oran">Oran</option>
                                                    <option value="El Bayadh">El Bayadh</option>
                                                    <option value="Illizi">Illizi</option>
                                                    <option value="Bordj Bou Arréridj">Bordj Bou Arréridj</option>
                                                    <option value="Boumerdès">Boumerdès</option>
                                                    <option value="El Tarf">El Tarf</option>
                                                    <option value="Tindouf">Tindouf</option>
                                                    <option value="Tissemsilt">Tissemsilt</option>
                                                    <option value="El Oued">El Oued</option>
                                                    <option value="Khenchela">Khenchela</option>
                                                    <option value="Souk Ahras">Souk Ahras</option>
                                                    <option value="Tipaza">Tipaza</option>
                                                    <option value="Mila">Mila</option>
                                                    <option value="Aïn Defla">Aïn Defla</option>
                                                    <option value="Naâma">Naâma</option>
                                                    <option value="Aïn Témouchent">Aïn Témouchent</option>
                                                    <option value="Ghardaïa">Ghardaïa</option>
                                                    <option value="Relizane">Relizane</option>
                                                    <option value="Timimoun">Timimoun</option>
                                                    <option value="Bordj Badji Mokhtar">Bordj Badji Mokhtar</option>
                                                    <option value="Ouled Djellal">Ouled Djellal</option>
                                                    <option value="Béni Abbès">Béni Abbès</option>
                                                    <option value="Ain Salah">Ain Salah</option>
                                                    <option value="Ain Guezzam">Ain Guezzam</option>
                                                    <option value="Touggourt">Touggourt</option>
                                                    <option value="Djanet">Djanet</option>
                                                    <option value="El M'Ghair">El M'Ghair</option>
                                                    <option value="El Menia">El Menia</option>
                                                </select>
                                                @error('wilaya')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Nature de la réclamation :</label><br>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="checkbox-group">
                                                        <label><input type="checkbox" name="complaint_type[]" value="Lenteur de prise en charge"> Lenteur de prise en charge</label><br>
                                                        <label><input type="checkbox" name="complaint_type[]" value="Erreur sur les documents"> Erreur sur les documents</label><br>
                                                        <label><input type="checkbox" name="complaint_type[]" value="Personnel de l'EHPH"> Personnel de l'EHPH</label><br>
                                                        <label><input type="checkbox" name="complaint_type[]" value="Prestation médicale"> Prestation médicale</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkbox-group">
                                                        <label><input type="checkbox" name="complaint_type[]" value="Propreté"> Propreté</label><br>
                                                        <label><input type="checkbox" name="complaint_type[]" value="Accueil"> Accueil</label><br>
                                                        <label><input type="checkbox" name="complaint_type[]" value="Horaire"> Horaire</label><br>
                                                        <label><input type="checkbox" name="complaint_type[]" value="Autre"> Autre</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('complaint_type')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Détails de la réclamation" required rows="5">{{ old('message') }}</textarea>
                                            @error('message')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea name="solution" placeholder="Solution souhaitée" rows="5">{{ old('solution') }}</textarea>
                                            @error('solution')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="consent" id="consent" value="1" {{ old('consent') ? 'checked' : '' }}>
                                                J'accepte que mes données soient utilisées et stockées conformément à la loi 18/07.
                                            </label>
                                            @error('consent')
                                                < Himanshu span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="response" style="color: red;"></div>
                                    </div>
                                    <div class="col-12">
                                        <button style="background-color: #23B6EA; border-color: #23B6EA;" class="btn btn-primary w-100 py-3" type="submit">Envoyer ma réclamation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container contact-info">
                <div class="row">
                    <div class="col-lg-4 col-12 mb-3">
                        <div class="single-info">
                            <i class="icofont icofont-ui-call"></i>
                            <div class="content">
                                <a href="tel:048771441" target="_blank" style="text-decoration: none;"><h3>048 77 14 41</h3></a>
                                <a href="mailto:info@ehph-hasnaoui.com" target="_blank" style="text-decoration: none;"><p>info@ehph-hasnaoui.com</p></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                        <div class="single-info">
                            <i class="icofont icofont-google-map"></i>
                            <div class="content">
                                <a href="https://www.google.com/maps/place/Etablissement+Hospitalier+Priv%C3%A9+HASNAOUI/@35.1791377,-0.6318223,15z/data=!4m2!3m1!1s0x0:0x23bae99ee4007340?sa=X&ved=1t:2428&ictx=111" target="_blank" style="text-decoration: none;">
                                    <h3>Bloc J05 Makam El Chahid</h3>
                                    <p>Sidi Bel Abbes</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-info">
                            <i class="icofont icofont-wall-clock"></i>
                            <div class="content">
                                <h3>Samedi - Vendredi:</h3>
                                <p>24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.footer')

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="../assets/vendor/wow/wow.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('reclamationsForm').addEventListener('submit', function(event) {
            const consentCheckbox = document.getElementById('consent');
            const responseDiv = document.getElementById('response');

            if (!consentCheckbox.checked) {
                event.preventDefault();
                responseDiv.textContent = 'Veuillez accepter l’utilisation et le stockage de vos données conformément à la loi 18/07.';
            } else {
                responseDiv.textContent = '';
            }
        });
    </script>