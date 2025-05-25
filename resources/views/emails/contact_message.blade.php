<!DOCTYPE html>
<html>
<head>
    <title>Réclamation</title>
</head>
<body>
    <h1>Nouvelle réclamation</h1>
    <p><strong>Nom :</strong> {{ $data['name'] }}</p>
    <p><strong>Email :</strong> {{ $data['email'] }}</p>
    <p><strong>Téléphone :</strong> {{ $data['phone'] }}</p>
    <p><strong>Sujet :</strong> {{ $data['subject'] }}</p>
    <p><strong>Message :</strong></p>
    <p>{{ $data['message'] }}</p>

    <p>Envoyé depuis le site de l'Etablissement Hospitalier Hasnaoui.</p>
</body>
</html>