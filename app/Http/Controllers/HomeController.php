<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Rendezvs;
use App\Models\Doctor;
use App\Models\Pic;
use App\Models\Act;
use App\Models\ContactMessage as ContactMessageModel;
use App\Models\ConventionedDoctor;
use App\Models\Organism;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use App\Models\Reclamation;

class HomeController extends Controller
{
    // Redirige l'utilisateur selon son statut d'authentification et son type
    public function redirect()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (!$user->hasVerifiedEmail()) {
                Log::info('HomeController: Email not vérifié, redirection vers vérification', ['email' => $user->email]);
                return redirect()->route('verification.notice')->with('error', 'Veuillez vérifier votre adresse email pour continuer.');
            }

            if ($user->usertype == '1') {
                Log::info('HomeController: Redirection admin vers dashboard', ['email' => $user->email]);
                return redirect()->route('dashboard');
            }

            Log::info('HomeController: Redirection utilisateur vers accueil', ['email' => $user->email]);
            return redirect()->route('home');
        }

        Log::info('HomeController: Aucun utilisateur`Aucun utilisateur authentifié, redirection vers login');
        return redirect()->route('login');
    }

    // Gère la prise de rendez-vous
    public function rdv(Request $request)
    {
        if (!Auth::id()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour prendre un rendez-vous.');
        }

        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'numero' => 'required|string|max:20',
            'service' => 'required|string|in:dermatologie,urologie,cardiologie,hématologie',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required|string',
            'DateNaissance' => 'required|date|before:today',
            'NumeroCni' => 'nullable|string|max:50',
            'NumeroSecuriteSociale' => 'nullable|string|max:50',
            'langage1' => 'required',
        ]);

        $data = new Rendezvs;
        $data->nom = $request->nom;
        $data->prenom = $request->prenom;
        $data->email = $request->email;
        $data->numero = $request->numero;
        $data->service = $request->service;
        $data->date = $request->date;
        $data->heure = $request->heure;
        $data->status = 'à confirmer';
        $data->user_id = Auth::id();
        $data->save();

        return redirect()->back()->with('message', 'Rendez-vous pris avec succès. En attente de confirmation.');
    }

    // Affiche les rendez-vous de l'utilisateur connecté
    public function myrdv()
    {
        if (Auth::id()) {
            $userid = Auth::user()->id;
            $rdv = Rendezvs::where('user_id', $userid)->get();
            Log::info('User RDVs:', ['rdv' => $rdv]);
            return view('user.myrdv', compact('rdv'));
        } else {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir vos rendez-vous.');
        }
    }

    // Affiche la page "À propos" avec la liste des médecins actifs
    public function apropos()
    {
        $doctors = Doctor::where('is_active', 1)->get();
        $conventionedDoctors = ConventionedDoctor::where('is_active', 1)->get();
        Log::info('Fetched doctors for apropos:', ['doctors_count' => $doctors->count(), 'conventioned_doctors_count' => $conventionedDoctors->count()]);
        return view('user.apropos', compact('doctors', 'conventionedDoctors'));
    }

    // Affiche la galerie d'images avec les spécialités
    public function galerie()
    {
        $pics = Pic::where('is_active', 1)->get();
        Log::info('Fetched pics for galerie:', ['pics_count' => $pics->count()]);
        $specialties = $pics->pluck('type')->unique()->filter()->map(function ($specialty) {
            return [
                'original' => $specialty,
                'sanitized' => str_replace([' ', 'é', 'à', 'è'], ['-', 'e', 'a', 'e'], strtolower($specialty))
            ];
        })->values()->toArray();

        return view('user.galerie', compact('pics', 'specialties'));
    }

    // Affiche la liste des actualités
    public function actualite()
    {
        try {
            $acts = Act::where('is_active', 1)->orderBy('date_ajout', 'desc')->get();
            Log::info('Fetched active actualites:', ['count' => $acts->count()]);
            return view('user.actualite', compact('acts'));
        } catch (\Exception $e) {
            Log::error('Error fetching actualites: ' . $e->getMessage());
            return view('user.actualite', ['acts' => []])->with('error', 'Impossible de charger les actualités.');
        }
    }

    // Affiche une actualité spécifique en JSON
    public function showActualite($id): JsonResponse
    {
        $act = Act::find($id);

        if (!$act || !$act->is_active) {
            return response()->json(['error' => 'Actualité non trouvée ou non active'], 404);
        }

        return response()->json([
            'titre' => $act->titre,
            'date' => $act->date_ajout ? \Carbon\Carbon::parse($act->date_ajout)->format('d/m/Y') : 'Non défini',
            'description' => $act->description,
            'image' => $act->image ? asset('storage/' . $act->image) : null,
        ]);
    }

    // Gère l'envoi des messages de contact
    public function storeContactMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $contactMessage = ContactMessageModel::create($validated);
            $contactData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
            ];
            Mail::to('yousralansari97@gmail.com')->send(new ContactMessage($contactData));
            Session::flash('message', 'Votre message a été envoyé avec succès !');
        } catch (\Exception $e) {
            Session::flash('error', 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.');
            Log::error('Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
        }

        return redirect()->route('contact');
    }

    // Affiche la page d'accueil avec les dernières actualités actives et organismes actifs
    public function index()
    {
        $latestActs = Act::where('is_active', 1)->orderBy('date_ajout', 'desc')->take(4)->get();
        $organisms = Organism::where('is_active', 1)->get();
        Log::info('Fetched active actualites for index:', ['count' => $latestActs->count()]);
        return view('user.home', compact('latestActs', 'organisms'));
    }

    // Affiche la page du formulaire de réclamation
    public function showReclamationForm()
    {
        return view('user.reclamations');
    }

    // Gère l'enregistrement des réclamations
    public function storeReclamation(Request $request)
    {
        Log::info('Données reçues du formulaire', $request->all());

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'required|string|max:20',
                'wilaya' => 'required|string|max:255',
                'complaint_type' => 'required|array|min:1',
                'complaint_type.*' => 'string',
                'message' => 'required|string',
                'solution' => 'nullable|string',
            ]);

            Log::info('Données validées', $validated);

            $reclamation = Reclamation::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'wilaya' => $validated['wilaya'],
                'complaint_type' => $validated['complaint_type'],
                'message' => $validated['message'],
                'solution' => $validated['solution'],
                'status' => 'pending',
            ]);

            Log::info('Réclamation enregistrée', ['reclamation_id' => $reclamation->id]);

            try {
                $recipient = env('RECLAMATION_NOTIFICATION_EMAIL', 'yousralansari97@gmail.com');
                Log::info('Préparation de l\'envoi de l\'email', [
                    'recipient' => $recipient,
                    'reclamation_data' => $reclamation->toArray()
                ]);

                Mail::send('emails.reclamation_submitted', ['reclamation' => $reclamation], function ($message) use ($recipient) {
                    $message->to($recipient)
                            ->subject('Nouvelle réclamation soumise');
                });

                Log::info('Email envoyé avec succès', ['reclamation_id' => $reclamation->id, 'recipient' => $recipient]);
            } catch (\Exception $e) {
                Log::error('Échec de l\'envoi de l\'email', [
                    'reclamation_id' => $reclamation->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            return redirect()->back()->with('message', 'Votre réclamation a été envoyée avec succès !');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement de la réclamation', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }
}