@component('mail::message')
# Réclamation marquée comme traitée

Une réclamation a été marquée comme traitée. Voici les détails :

**Nom** : {{ $reclamation->name }}  
**Email** : {{ $reclamation->email ?? 'Non fourni' }}  
**Téléphone** : {{ $reclamation->phone }}  
**Wilaya** : {{ $reclamation->wilaya }}  
**Type de réclamation** : {{ is_array($reclamation->complaint_type) ? implode(', ', $reclamation->complaint_type) : $reclamation->complaint_type }}  
**Message** : {{ $reclamation->message }}  
**Solution** : {{ $reclamation->solution ?? 'Aucune' }}  
**Statut** : {{ $reclamation->status === 'processed' ? 'Traité' : 'En attente' }}  
**Date** : {{ $reclamation->created_at ? \Carbon\Carbon::parse($reclamation->created_at)->format('d/m/Y') : 'Non définie' }}

Merci,  
{{ config('app.name') }}
@endcomponent