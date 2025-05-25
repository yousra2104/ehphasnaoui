<!-- resources/views/users/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Utilisateurs</h1>
    
    <!-- Boucle sur tous les utilisateurs -->
    @foreach($doctor as $doctors)
        <div>
            <p>Nom : {{ $doctors->name }}</p>
           
        </div>
    @endforeach
    
    <!-- Vérifier si la liste est vide -->
    @empty($users)
        <p>Aucun utilisateur trouvé</p>
    @endempty
</body>
</html>