<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Galerie - EHPHASNAOUI</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .section-title h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .section-title img {
            margin: 0.5rem 0;
        }

        .required {
            color: red;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        .steps {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .step {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            background: #f0f0f0;
        }

        .step.active {
            background: #007bff;
            color: white;
        }

        .step-section {
            display: none;
        }

        .step-section.active {
            display: block;
        }

        .otp-container {
            display: flex;
            gap: 0.5rem;
        }

        .otp-input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 1.2rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .appointment {
            background: #fff;
            padding-top: 30px;
        }

        .appointment.single-page {
            background: #fff;
            padding: 100px 0;
        }

        .appointment.single-page .appointment-inner {
            padding: 40px;
            box-shadow: 0px 0px 10px #00000024;
            border-radius: 5px;
        }

        input[type="checkbox"]:hover {
            cursor: pointer;
        }

        .appointment.single-page .title h3 {
            font-size: 25px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .forminput,
        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            height: 50px;
            border: 1px solid #eee;
            padding: 20px 18px;
            color: #555;
            font-size: 14px;
            font-weight: 400;
            border-radius: 4px;
        }

        .appointment .form textarea {
            width: 100%;
            height: 200px;
            padding: 18px;
            border: 1px solid #eee;
            text-transform: capitalize;
            resize: none;
            border-radius: 4px;
        }

        .appointment .form-group .list li:hover {
            color: #fff;
            background: #1A76D1;
        }

        .appointment.single-page .button .btn {
            width: 100%;
            font-weight: 500;
        }

        .appointment.single-page .button .btn:hover {
            color: #fff;
        }

        .appointment .form p {
            margin-top: 10px;
            color: #868686;
        }

        .appointment-image {
            width: 100%;
            height: 100%;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .borderTicket {
            position: relative;
            border: 3px solid #000;
            padding: 15px;
        }

        .borderTicket::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('logo_back.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
            opacity: 0.15;
            z-index: -1;
        }

        .codeQr {
            position: relative;
            display: inline-block;
            margin-top: 0;
        }

        .textwrap {
            cursor: pointer;
            white-space: nowrap;
        }

        @media only screen and (max-width: 900px) {
            .codeQr {
                margin-top: 47px;
            }

            .textwrap {
                white-space: initial;
            }
        }

        .download-button {
            position: relative;
            border-width: 0;
            color: rgb(19, 19, 19);
            font-size: 15px;
            font-weight: 600;
            border-radius: 4px;
            z-index: 1;
        }

        .download-button .docs {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            min-height: 40px;
            padding: 0 10px;
            border-radius: 4px;
            z-index: 1;
            color: #fff;
            background-color: #000;
            border: solid 1px #e8e8e82d;
            transition: all 0.5s cubic-bezier(0.77, 0, 0.175, 1);
        }

        .download-button:hover {
            box-shadow: rgba(233, 233, 233, 0.555) 0px 54px 55px,
                rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px,
                rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        .download {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 90%;
            margin: 0 auto;
            z-index: -1;
            border-radius: 0px 0px 4px 4px;
            transform: translateY(0%);
            background-color: #01e056;
            border: solid 1px #01e0572d;
            transition: all 0.5s cubic-bezier(0.77, 0, 0.175, 1);
            cursor: pointer;
        }

        .download-button:hover .download {
            transform: translateY(100%);
        }

        .download svg polyline,
        .download svg line {
            animation: docs 1s infinite;
        }

        @keyframes docs {
            0% {
                transform: translateY(0%);
            }
            50% {
                transform: translateY(-15%);
            }
            100% {
                transform: translateY(0%);
            }
        }
    </style>
</head>
<body>
    <header>
        @include('user.topbar')
        @include('user.navbar')
    </header>

    <div class="container">
        <div class="row my-4">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h2>Prendre un Rendez-vous</h2>
                    <img src="../assets/img/section-img.png" alt="#">
                    <p>Prendre un rendez-vous médical en ligne permet de choisir facilement et rapidement le jour et l’heure de la consultation,<br> sans avoir à se déplacer. Ce service est gratuit, convivial et sécuritaire.</p>
                </div>
            </div>
        </div>

        <div id="step-content">
            <!-- Step 1: Personal Information -->
            <section id="step-1" class="step-section active">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="appointment-inner">
                            <form id="appointment-form" action="{{ url('rdv') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <label>Nom : <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-users"></i></span>
                                            <input type="text" id="FirstName" name="nom" class="form-control" placeholder="Nom *" value="{{ old('nom') }}">
                                        </div>
                                        @error('nom')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Prénom : <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-users"></i></span>
                                            <input type="text" id="LastName" name="prenom" class="form-control" placeholder="Prénom *" value="{{ old('prenom') }}">
                                        </div>
                                        @error('prenom')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Date de naissance : <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input type="date" id="DateNaissance" name="DateNaissance" class="form-control" max="2009-12-31" value="{{ old('DateNaissance') }}">
                                        </div>
                                        @error('DateNaissance')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Numéro de Téléphone : <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            <input type="text" id="NumeroTel" name="numero" class="form-control" placeholder="Numéro de téléphone *" value="{{ old('numero') }}">
                                        </div>
                                        @error('numero')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Services : <span class="required">*</span></label>
                                        <select id="Services" name="service" class="form-control">
                                            <option value="">--Select--</option>
                                            <option value="dermatologie" {{ old('service') == 'dermatologie' ? 'selected' : '' }}>Dermatologie</option>
                                            <option value="urologie" {{ old('service') == 'urologie' ? 'selected' : '' }}>Urologie</option>
                                            <option value="cardiologie" {{ old('service') == 'cardiologie' ? 'selected' : '' }}>Cardiologie</option>
                                            <option value="hématologie" {{ old('service') == 'hématologie' ? 'selected' : '' }}>Hématologie</option>
                                        </select>
                                        @error('service')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Date de Rendez-vous : <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            <input type="date" id="DateRendezVous" name="date" class="form-control" value="{{ old('date') }}">
                                        </div>
                                        @error('date')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Mail : <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                            <input type="email" id="Email" name="email" class="form-control" placeholder="Entrez votre mail" value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Heure : <span class="required">*</span></label>
                                        <input type="time" id="Heure" name="heure" class="form-control" value="{{ old('heure') }}">
                                        @error('heure')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Numéro de la carte d'identité :</label>
                                        <input type="text" id="NumeroCni" name="NumeroCni" class="form-control" placeholder="Numéro de CNI" value="{{ old('NumeroCni') }}">
                                        @error('NumeroCni')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <label>Numéro de sécurité sociale :</label>
                                        <input type="text" id="NumeroSecuriteSociale" name="NumeroSecuriteSociale" class="form-control" placeholder="Numéro de sécurité sociale" value="{{ old('NumeroSecuriteSociale') }}">
                                        @error('NumeroSecuriteSociale')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 col-md-12 d-flex mb-2">
                                        <input type="checkbox" class="form-check-input" id="langage1" name="langage1" value="javascript" required>
                                        <label for="langage1" class="mx-2">J'accepte que les informations saisies soient utilisées pour me recontacter</label>
                                        @error('langage1')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Suivant</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div>
                            <img src="../assets/img/rendez.jfif" class="appointment-image" alt="#">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Step 2: OTP Verification -->
            <section id="step-2" class="step-section">
                <p class="text-center" id="otp-message"></p>
                <div class="d-flex justify-content-center">
                    <div id="otp-inputs" class="otp-container">
                        <input type="text" maxlength="1" class="otp-input" id="otp0">
                        <input type="text" maxlength="1" class="otp-input" id="otp1">
                        <input type="text" maxlength="1" class="otp-input" id="otp2">
                        <input type="text" maxlength="1" class="otp-input" id="otp3">
                        <input type="text" maxlength="1" class="otp-input" id="otp4">
                        <input type="text" maxlength="1" class="otp-input" id="otp5">
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-secondary mx-4" onclick="goBack()">Retour</button>
                    <button class="btn btn-primary mx-4" onclick="verifyOTP()">Suivant</button>
                </div>
            </section>
        </div>
    </div>

    @include('user.footer')

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-toastify@9.0.8/dist/react-toastify.umd.js"></script>
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="../assets/vendor/wow/wow.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for multi-step form (simplified for direct submission)
        let currentStep = 1;

        function showStep(step) {
            document.querySelectorAll('.step-section').forEach(section => {
                section.classList.remove('active');
            });
            document.querySelectorAll('.step').forEach(stepEl => {
                stepEl.classList.remove('active');
            });
            document.getElementById(`step-${step}`).classList.add('active');
            document.getElementById(`step${step}`).classList.add('active');
            currentStep = step;
        }

        function goBack() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        }

        // OTP verification (adjust based on your backend)
        async function verifyOTP() {
            const otp = Array.from(document.querySelectorAll('.otp-input')).map(input => input.value).join('');
            try {
                const response = await axios.post('{{ url('verify-otp') }}', { otp });
                if (response.data.success) {
                    // Optionally show ticket with QR code
                    alert('Rendez-vous confirmé!');
                    window.location.href = '{{ url('mes-rendezvous') }}';
                } else {
                    document.getElementById('otp-message').textContent = 'Code OTP incorrect.';
                }
            } catch (error) {
                document.getElementById('otp-message').textContent = 'Erreur lors de la vérification.';
            }
        }
    </script>
</body>
</html>