<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <title>EHP-HASNAOUI</title>
  <link rel="icon" href="../assets/img/logozoom.PNG" />
  <link rel="stylesheet" href="../assets/css/maicons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <link rel="stylesheet" href="../assets/css/avis.css">
  <link rel="stylesheet" href="../assets/css/convention.css">
  <link rel="stylesheet" href="../assets/css/breadcrumbsapropos.css">
  <link rel="stylesheet" href="../assets/css/globals.css">
  <style>
    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    th, td {
      padding: 15px;
      text-align: center;
      font-size: 18px;
      border: 1px solid #ddd;
    }
    th {
      background-color: #1A76D1;
      color: white;
      font-weight: 600;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    .badge {
      font-size: 14px;
      padding: 8px 12px;
    }
  </style>
</head>
<body>
  <header>
    @include('user.topbar')
    @include('user.navbar')
  </header>

  <div class="container" style="padding: 70px 0;">
    <h1 class="text-center mb-4">Mes Rendez-vous</h1>
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($rdv->isEmpty())
        <p class="text-center">Aucun rendez-vous trouvé.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Date du rendez-vous</th>
                    <th>Heure</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rdv as $rdvs)
                    <tr>
                        <td>{{ ucfirst($rdvs->service) }}</td>
                        <td>{{ $rdvs->date }}</td>
                        <td>{{ $rdvs->heure }}</td>
                        <td>
                            @if($rdvs->status === 'à confirmer')
                                <span class="badge bg-warning">En attente</span>
                            @elseif($rdvs->status === 'confirmé')
                                <span class="badge bg-success">Confirmé</span>
                            @elseif($rdvs->status === 'annulé')
                                <span class="badge bg-danger">Annulé</span>
                            @else
                                <span class="badge bg-secondary">Inconnu</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
  </div>

  @include('user.footer')

  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
  <script src="../assets/vendor/wow/wow.min.js"></script>
  <script src="../assets/js/theme.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>