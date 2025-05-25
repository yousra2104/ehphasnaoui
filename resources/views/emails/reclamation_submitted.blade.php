
<!DOCTYPE html>
<html>
<head>
    <title>Réclamation</title>
</head>
<body>
    <h1>Nouvelle réclamation</h1>
    <p><strong>Nom :</strong> {{ $reclamation->name }}  </p>
    <p><strong>Email :</strong>  {{ $reclamation->email ?? 'Non fourni' }}  </p>
    <p><strong>Téléphone :</strong> {{ $reclamation->phone }} </p>
   <p><strong>Wilaya:</strong> {{ $reclamation->wilaya }}  </p>
    <p><strong>Nature de la réclamation :</strong>{{ is_array($reclamation->complaint_type) ? implode(', ', $reclamation->complaint_type) : ($reclamation->complaint_type ?? 'Non spécifié') }}  </p>
    <p><strong>Détails de la réclamation:</strong> {{ $reclamation->message }}  </p>
    <p><strong> Solution souhaitée:</strong> {{ $reclamation->solution ?? 'Aucune' }} </p>
   

    <p>Envoyé depuis le site de l'Etablissement Hospitalier Hasnaoui.</p>
</body>
</html>