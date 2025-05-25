<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>EHP-HASNAOUI - rendez-vous</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/globals.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/admincss/tableau.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #1A76D1;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .badge {
            font-size: 14px;
            padding: 8px 12px;
        }
        .no-rdv-message {
            font-style: italic;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
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
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Numéro</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Date de prise de RDV</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($rdvs->isEmpty())
                            <tr>
                                <td colspan="10" class="no-rdv-message">Aucun rendez-vous à afficher</td>
                            </tr>
                        @else
                            @foreach($rdvs as $rdv)
                                <tr>
                                    <td>{{ $rdv->nom }}</td>
                                    <td>{{ $rdv->prenom }}</td>
                                    <td>{{ $rdv->email }}</td>
                                    <td>{{ $rdv->numero }}</td>
                                    <td>{{ ucfirst($rdv->service) }}</td>
                                    <td>{{ $rdv->date }}</td>
                                    <td>{{ $rdv->heure }}</td>
                                    <td>{{ $rdv->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($rdv->status === 'à confirmer')
                                            <span class="badge bg-warning">À confirmer</span>
                                        @elseif($rdv->status === 'confirmé')
                                            <span class="badge bg-success">Confirmé</span>
                                        @elseif($rdv->status === 'annulé')
                                            <span class="badge bg-danger">Annulé</span>
                                        @else
                                            <span class="badge bg-secondary">Inconnu</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($rdv->status !== 'confirmé')
                                            <form action="{{ route('admin.rdv.confirm', $rdv->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Confirmer</button>
                                            </form>
                                        @endif
                                        @if($rdv->status !== 'annulé')
                                            <form action="{{ route('admin.rdv.cancel', $rdv->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>