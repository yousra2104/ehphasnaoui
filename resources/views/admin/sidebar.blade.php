<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EHP HASNAOUI Admin</title>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS for accordion -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sidebar styles to match existing design */
        #sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            height: 100vh;
            position: fixed;
        }
        #sidebar header {
            padding: 20px;
            text-align: center;
        }
        #sidebar header a {
            color: white;
            text-decoration: none;
            font-size: 24px;
        }
        .nav {
            list-style: none;
            padding: 0;
        }
        .nav li {
            padding: 10px 20px;
        }
        .nav li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .nav li a i {
            margin-right: 10px;
        }
        .nav li a:hover {
            color: #ddd;
        }
        /* Accordion link alignment */
        .accordion-button {
            color: white !important;
            background: #343a40 !important;
            padding: 10px 20px;
        }
        .accordion-button:not(.collapsed) {
            background: #495057 !important;
        }
        .accordion-button:focus {
            box-shadow: none;
        }
        .accordion-body a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 8px 20px;
        }
        .accordion-body a:hover {
            background: #495057;
        }
        .accordion-body {
            background: #2c3034;
            padding: 0;
        }
        /* Active link styling */
        .accordion-body a.active {
            background: #495057;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="viewport">
        <div id="sidebar">
            <header>
                <a href="#">EHP HASNAOUI</a>
            </header>
            <ul class="nav">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <!--li>
                    <Accordion for RendezVous >
                    <div class="accordion" style="width: 200px; padding:0px;" id="rendezVousAccordion">
                        <div class="accordion-item" style="border: none;">
                            <h2 class="accordion-header" id="headingRendezVous">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRendezVous" aria-expanded="true" aria-controls="collapseRendezVous">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    RendezVous
                                </button>
                            </h2>
                            <div id="collapseRendezVous" class="accordion-collapse collapse show" aria-labelledby="headingRendezVous" data-bs-parent="#rendezVousAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('admin.rendezvous', ['status' => 'à confirmer']) }}" class="{{ $status ?? 'all' === 'à confirmer' ? 'active' : '' }}">
                                        <i class="fas fa-question-circle me-2"></i>
                                        À confirmer
                                    </a>
                                    <a href="{{ route('admin.rendezvous', ['status' => 'confirmé']) }}" class="{{ $status ?? 'all' === 'confirmé' ? 'active' : '' }}">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Confirmé
                                    </a>
                                    <a href="{{ route('admin.rendezvous', ['status' => 'annulé']) }}" class="{{ $status ?? 'all' === 'annulé' ? 'active' : '' }}">
                                        <i class="fas fa-times-circle me-2"></i>
                                        Annulé
                                    </a>
                                    <a href="{{ route('admin.rendezvous', ['status' => 'all']) }}" class="{{ $status ?? 'all' === 'all' ? 'active' : '' }}">
                                        <i class="fas fa-list me-2"></i>
                                        Tous les rendez-vous
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li-->
                <li>
                    <a href="{{ route('admin.add_act') }}">
                        <i class="fas fa-newspaper"></i>
                        Actualités
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.add_pic') }}">
                        <i class="fas fa-images"></i>
                        Galerie
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.add_doctor') }}">
                        <i class="fas fa-hospital"></i>
                        Médecins
                    </a>
                </li>
                <li>
    <a href="{{ route('admin.conventioned_doctors') }}">
        <i class="fas fa-user-md"></i>
        Médecins Conventionnés
    </a>
</li>
<li>
    <a href="{{ route('admin.contact-messages') }}">
        <i class="fas fa-envelope"></i>
        Contact/Informations
    </a>
</li>
<li>
    <a href="{{ route('admin.reclamations') }}">
    <i class="fas fa-exclamation-triangle"></i>
        Réclamations
    </a>
</li>
<li>
    <a href="{{ route('admin.organisms') }}">
        <i class="fas fa-handshake"></i>
        Organismes conventionnés
    </a>
</li>
            </ul>
        </div>
        <div id="content">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="topbarrr d-flex align-items-center w-100">
                        <div>
                            <a href="{{route('home')}}"><img class="i1" src="../assets/img/logo.png" alt="Logo" /></a>
                        </div>
                        <div class="d-flex align-items-center ms-auto">
                            <div class="flex-shrink-0">
                                <img class="i2" src="../assets/img/imagelogin.png" alt="Profile" />
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <strong>Admin EHPH</strong>
                            </div>
                            <div>
                                <x-app-layout></x-app-layout>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>