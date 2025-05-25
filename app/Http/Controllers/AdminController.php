<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rendezvs;
use App\Models\Doctor;
use App\Models\Pic;
use App\Models\Act;
use App\Models\ContactMessage;
use App\Models\Organism;
use App\Models\Reclamation;
use App\Models\ConventionedDoctor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    // Affiche les statistiques du tableau de bord
    public function dashcount()
    {
        $galCount = Pic::count();
        $actCount = Act::count();
        $medCount = Doctor::count();
        $medconvCount = ConventionedDoctor::count();
        $recCount = Reclamation::count();
        $contactCount = ContactMessage::count();
        $organismCount = Organism::count();
        return view('admin.dashboard', compact('medCount', 'galCount', 'actCount', 'medconvCount', 'recCount', 'contactCount', 'organismCount'));
    }

    // Gère l'affichage des rendez-vous avec filtrage par statut
    public function rendezvous(Request $request)
    {
        $status = $request->query('status', 'all');
        $query = Rendezvs::query();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $rdvs = $query->get();
        return view('admin.rendezvous', compact('rdvs', 'status'));
    }

    // Confirme un rendez-vous
    public function confirm($id)
    {
        try {
            $rdv = Rendezvs::findOrFail($id);
            if ($rdv->status === 'confirmé') {
                return redirect()->back()->with('message', 'Ce rendez-vous est déjà confirmé.');
            }
            $rdv->status = 'confirmé';
            $rdv->save();
            return redirect()->back()->with('message', 'Rendez-vous confirmé avec succès');
        } catch (\Exception $e) {
            Log::error('Error confirming rendezvous: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la confirmation.');
        }
    }

    // Annule un rendez-vous
    public function cancel($id)
    {
        try {
            $rdv = Rendezvs::findOrFail($id);
            if ($rdv->status === 'annulé') {
                return redirect()->back()->with('message', 'Ce rendez-vous est déjà annulé.');
            }
            $rdv->status = 'annulé';
            $rdv->save();
            return redirect()->back()->with('message', 'Rendez-vous annulé avec succès');
        } catch (\Exception $e) {
            Log::error('Error canceling rendezvous: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'annulation.');
        }
    }

    // Affiche la page des actualités
    public function actualite()
    {
        try {
            $acts = Act::all();
            Log::info('Fetching acts', ['count' => $acts->count()]);
            if (!view()->exists('admin.add_act')) {
                Log::error('View admin.add_act does not exist');
                throw new \Exception('View admin.add_act not found');
            }
            return view('admin.add_act', compact('acts'));
        } catch (\Exception $e) {
            Log::error('Error in actualite: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite: ' . $e->getMessage());
        }
    }

    // Affiche la vue pour ajouter une actualité
    public function addactview()
    {
        try {
            $acts = Act::all();
            return view('admin.add_act', compact('acts'));
        } catch (\Exception $e) {
            Log::error('Error in addactview: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite: ' . $e->getMessage());
        }
    }

    // Ajoute une nouvelle actualité
    public function uploadact(Request $request)
    {
        try {
            $request->validate([
                'titre' => 'required|string|max:255',
                'description' => 'required|string|max:10000',
                'type' => 'required|in:événement,annonce,article',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'date_ajout' => 'required|date',
                'is_active' => 'required|boolean',
            ]);

            $data = [
                'titre' => $request->titre,
                'description' => $request->description,
                'type' => $request->type,
                'date_ajout' => $request->date_ajout,
                'is_active' => $request->is_active,
            ];

            if ($request->hasFile('image')) {
                $originalFilename = $request->file('image')->getClientOriginalName();
                $filename = $originalFilename;
                $counter = 1;
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                while (Storage::disk('public')->exists("actualites/{$filename}")) {
                    $filename = "{$nameWithoutExtension}_{$counter}.{$extension}";
                    $counter++;
                }
                $imagePath = $request->file('image')->storeAs('actualites', $filename, 'public');
                $data['image'] = "storage/{$imagePath}";
            }

            Act::create($data);

            return redirect()->route('admin.add_act')->with('message', 'Actualité ajoutée avec succès');
        } catch (ValidationException $e) {
            Log::error('Validation error in uploadact: ' . $e->getMessage(), ['errors' => $e->errors()]);
            $errorMessages = collect($e->errors())->flatten()->all();
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Erreur de validation: ' . implode(', ', $errorMessages));
        } catch (QueryException $e) {
            Log::error('Database error in uploadact: ' . $e->getMessage());
            if (strpos($e->getMessage(), 'Data too long') !== false) {
                return redirect()->back()->withInput()->with('error', 'La description est trop longue. Veuillez la limiter à 10 000 caractères.');
            }
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de l\'actualité.');
        } catch (\Exception $e) {
            Log::error('Error in uploadact: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de l\'actualité.');
        }
    }

    // Récupère les données d'une actualité pour édition
    public function editAct($id)
    {
        try {
            $act = Act::findOrFail($id);
            return response()->json([
                'id' => $act->id,
                'titre' => $act->titre,
                'description' => $act->description,
                'type' => $act->type,
                'image' => $act->image ? url($act->image) : '',
                'date_ajout' => $act->date_ajout ? \Carbon\Carbon::parse($act->date_ajout)->format('Y-m-d') : '',
                'is_active' => $act->is_active,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in editAct: ' . $e->getMessage());
            return response()->json(['error' => 'Actualité introuvable.'], 404);
        }
    }

    // Met à jour une actualité
    public function updateAct(Request $request, $id)
    {
        try {
            $request->validate([
                'titre' => 'required|string|max:255',
                'description' => 'required|string|max:10000',
                'type' => 'required|in:événement,annonce,article',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'date_ajout' => 'required|date',
                'is_active' => 'required|boolean',
            ]);

            $act = Act::findOrFail($id);

            $data = [
                'titre' => $request->titre,
                'description' => $request->description,
                'type' => $request->type,
                'date_ajout' => $request->date_ajout,
                'is_active' => $request->is_active,
            ];

            if ($request->hasFile('image')) {
                if ($act->image && Storage::disk('public')->exists(str_replace('storage/', '', $act->image))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $act->image));
                }
                $originalFilename = $request->file('image')->getClientOriginalName();
                $filename = $originalFilename;
                $counter = 1;
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                while (Storage::disk('public')->exists("actualites/{$filename}")) {
                    $filename = "{$nameWithoutExtension}_{$counter}.{$extension}";
                    $counter++;
                }
                $imagePath = $request->file('image')->storeAs('actualites', $filename, 'public');
                $data['image'] = "storage/{$imagePath}";
            }

            $act->update($data);

            return redirect()->route('admin.add_act')->with('message', 'Actualité mise à jour avec succès');
        } catch (ValidationException $e) {
            Log::error('Validation error in updateAct: ' . $e->getMessage(), ['errors' => $e->errors()]);
            $errorMessages = collect($e->errors())->flatten()->all();
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Erreur de validation: ' . implode(', ', $errorMessages));
        } catch (QueryException $e) {
            Log::error('Database error in updateAct: ' . $e->getMessage());
            if (strpos($e->getMessage(), 'Data too long') !== false) {
                return redirect()->back()->withInput()->with('error', 'La description est trop longue. Veuillez la limiter à 10 000 caractères.');
            }
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour de l\'actualité.');
        } catch (\Exception $e) {
            Log::error('Error in updateAct: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour de l\'actualité.');
        }
    }

    // Bascule le statut is_active d'une actualité
    public function toggleStatus($id)
    {
        try {
            $act = Act::findOrFail($id);
            $act->is_active = !$act->is_active;
            $act->save();
            Log::info('Toggled status for act', ['id' => $id, 'is_active' => $act->is_active]);
            return response()->json(['success' => true, 'is_active' => $act->is_active, 'message' => 'Statut mis à jour avec succès.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Act not found in toggleStatus', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Actualité introuvable.'], 404);
        } catch (\Exception $e) {
            Log::error('Error in toggleStatus', ['id' => $id, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Une erreur s\'est produite lors de la mise à jour du statut.'], 500);
        }
    }

    // Affiche la vue pour ajouter un médecin
    public function addview()
    {
        try {
            $doctors = Doctor::all();
            return view('admin.add_doctor', compact('doctors'));
        } catch (\Exception $e) {
            Log::error('Error in addview: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite: ' . $e->getMessage());
        }
    }

    // Affiche la liste des médecins
    public function medecins()
    {
        try {
            $doctors = Doctor::all();
            return view('admin.add_doctor', compact('doctors'));
        } catch (\Exception $e) {
            Log::error('Error in medecins: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite: ' . $e->getMessage());
        }
    }

    // Ajoute un nouveau médecin avec image
    public function upload(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'speciality' => 'required|in:dermatologie,urologie,cardiologie,hématologie,pédiatrie,médecine générale,gynécologie obstétrique,chirurgie générale',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            $data = [
                'name' => $validated['name'],
                'speciality' => $validated['speciality'],
            ];

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                try {
                    $originalFilename = $request->file('image')->getClientOriginalName();
                    $filename = $originalFilename;
                    $counter = 1;
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                    while (Storage::disk('public')->exists("doctors/{$filename}")) {
                        $filename = "{$nameWithoutExtension}_{$counter}.{$extension}";
                        $counter++;
                    }
                    $imagePath = $request->file('image')->storeAs('doctors', $filename, 'public');
                    $data['image'] = "storage/{$imagePath}";
                } catch (\Exception $e) {
                    Log::error('Error uploading doctor image: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Erreur lors du téléchargement de l\'image: ' . $e->getMessage());
                }
            }

            try {
                Doctor::create($data);
            } catch (\Exception $e) {
                Log::error('Error creating doctor: ' . $e->getMessage(), ['data' => $data]);
                return redirect()->back()->with('error', 'Erreur lors de la création du médecin dans la base de données: ' . $e->getMessage());
            }

            return redirect()->route('admin.add_doctor')->with('message', 'Médecin ajouté avec succès');
        } catch (ValidationException $e) {
            Log::error('Validation error in upload: ' . $e->getMessage(), ['errors' => $e->errors()]);
            $errorMessages = collect($e->errors())->flatten()->all();
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Erreur de validation: ' . implode(', ', $errorMessages));
        } catch (\Exception $e) {
            Log::error('Unexpected error in upload: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Une erreur inattendue s\'est produite lors de l\'ajout du médecin: ' . $e->getMessage());
        }
    }

    // Récupère les données d'un médecin pour édition
    public function editDoctor(Doctor $doctor)
    {
        try {
            return response()->json([
                'id' => $doctor->id,
                'name' => $doctor->name,
                'speciality' => $doctor->speciality,
                'image' => $doctor->image ? url($doctor->image) : '',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in editDoctor: ' . $e->getMessage());
            return response()->json(['error' => 'Médecin introuvable.'], 404);
        }
    }

    // Met à jour les informations d'un médecin
    public function updateDoctor(Request $request, Doctor $doctor)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'speciality' => 'required|in:dermatologie,urologie,cardiologie,hématologie,pédiatrie,médecine générale',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            Log::info('Updating doctor ID: ' . $doctor->id, $request->all());

            $data = [
                'name' => $request->name,
                'speciality' => $request->speciality,
            ];

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($doctor->image && Storage::disk('public')->exists(str_replace('storage/', '', $doctor->image))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $doctor->image));
                }
                $originalFilename = $request->file('image')->getClientOriginalName();
                $filename = $originalFilename;
                $counter = 1;
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                while (Storage::disk('public')->exists("doctors/{$filename}")) {
                    $filename = "{$nameWithoutExtension}_{$counter}.{$extension}";
                    $counter++;
                }
                $imagePath = $request->file('image')->storeAs('doctors', $filename, 'public');
                $data['image'] = "storage/{$imagePath}";
            }

            $doctor->update($data);

            return redirect()->route('admin.add_doctor')->with('message', 'Médecin mis à jour avec succès');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in updateDoctor: ' . $e->getMessage());
            $errorMessages = collect($e->errors())->flatten()->all();
            return redirect()->back()->withErrors($e->validator)->withInput()->with('error', 'Erreur de validation: ' . implode(', ', $errorMessages));
        } catch (\Exception $e) {
            Log::error('Error in updateDoctor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour du médecin: ' . $e->getMessage());
        }
    }

    // Bascule le statut is_active d'un médecin
    public function toggleDoctorStatus($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->is_active = !$doctor->is_active;
            $doctor->save();
            Log::info('Toggled status for doctor', ['id' => $id, 'is_active' => $doctor->is_active]);
            return response()->json(['success' => true, 'is_active' => $doctor->is_active, 'message' => 'Statut mis à jour avec succès.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Doctor not found in toggleDoctorStatus', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Médecin introuvable.'], 404);
        } catch (\Exception $e) {
            Log::error('Error in toggleDoctorStatus', ['id' => $id, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Une erreur s\'est produite lors de la mise à jour du statut.'], 500);
        }
    }

    // Affiche la page de la galerie
    public function galerie()
    {
        try {
            $pics = Pic::all();
            return view('admin.add_pic', compact('pics'));
        } catch (\Exception $e) {
            Log::error('Error in galerie: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite: ' . $e->getMessage());
        }
    }

    // Affiche la vue pour ajouter une image à la galerie
    public function addpicview()
    {
        try {
            $pics = Pic::all();
            return view('admin.add_pic', compact('pics'));
        } catch (\Exception $e) {
            Log::error('Error in addpicview: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite: ' . $e->getMessage());
        }
    }

    // Ajoute une image à la galerie
    public function uploadpic(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|in:Pédiatries et néonatologie,Salle opératoire,Stérilisation,Laboratoire,Imagerie,Hospitalisation,Les urgences',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'description' => 'nullable|string|max:1000',
                'is_active' => 'required|boolean',
            ]);

            $originalFilename = $request->file('image')->getClientOriginalName();
            $filename = $originalFilename;
            $counter = 1;
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
            while (Storage::disk('public')->exists("gallery/{$filename}")) {
                $filename = "{$nameWithoutExtension}_{$counter}.{$extension}";
                $counter++;
            }
            $imagePath = $request->file('image')->storeAs('gallery', $filename, 'public');

            Pic::create([
                'type' => $request->type,
                'image' => "storage/{$imagePath}",
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);

            return redirect()->route('admin.add_pic')->with('message', 'Image ajoutée avec succès');
        } catch (ValidationException $e) {
            Log::error('Validation error in uploadpic: ' . $e->getMessage(), ['errors' => $e->errors()]);
            $errorMessages = collect($e->errors())->flatten()->all();
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Erreur de validation: ' . implode(', ', $errorMessages));
        } catch (\Exception $e) {
            Log::error('Error in uploadpic: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de l\'image.');
        }
    }

    // Récupère les données d'une image pour édition
    public function editPic($id)
    {
        try {
            $pic = Pic::findOrFail($id);
            return response()->json([
                'id' => $pic->id,
                'type' => $pic->type,
                'image' => $pic->image ? url($pic->image) : '',
                'description' => $pic->description,
                'is_active' => $pic->is_active,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in editPic: ' . $e->getMessage());
            return response()->json(['error' => 'Image introuvable.'], 404);
        }
    }

    // Met à jour une image de la galerie
    public function updatePic(Request $request, $id)
    {
        try {
            $request->validate([
                'type' => 'required|in:Pédiatries et néonatologie,Salle opératoire,Stérilisation,Laboratoire,Imagerie,Hospitalisation,Les urgences',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'description' => 'nullable|string|max:1000',
                'is_active' => 'required|boolean',
            ]);

            $pic = Pic::findOrFail($id);

            $data = [
                'type' => $request->type,
                'description' => $request->description,
                'is_active' => $request->is_active,
            ];

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($pic->image && Storage::disk('public')->exists(str_replace('storage/', '', $pic->image))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $pic->image));
                }
                $originalFilename = $request->file('image')->getClientOriginalName();
                $filename = $originalFilename;
                $counter = 1;
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                while (Storage::disk('public')->exists("gallery/{$filename}")) {
                    $filename = "{$nameWithoutExtension}_{$counter}.{$extension}";
                    $counter++;
                }
                $imagePath = $request->file('image')->storeAs('gallery', $filename, 'public');
                $data['image'] = "storage/{$imagePath}";
            }

            $pic->update($data);

            return redirect()->route('admin.add_pic')->with('message', 'Image mise à jour avec succès');
        } catch (ValidationException $e) {
            Log::error('Validation error in updatePic: ' . $e->getMessage(), ['errors' => $e->errors()]);
            $errorMessages = collect($e->errors())->flatten()->all();
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Erreur de validation: ' . implode(', ', $errorMessages));
        } catch (\Exception $e) {
            Log::error('Error in updatePic: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour de l\'image.');
        }
    }

    // Bascule le statut is_active d'une image
    public function togglePicStatus($id)
    {
        try {
            $pic = Pic::findOrFail($id);
            $pic->is_active = !$pic->is_active;
            $pic->save();
            Log::info('Toggled status for pic', ['id' => $id, 'is_active' => $pic->is_active]);
            return response()->json(['success' => true, 'is_active' => $pic->is_active, 'message' => 'Statut mis à jour avec succès.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Pic not found in togglePicStatus', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Image introuvable.'], 404);
        } catch (\Exception $e) {
            Log::error('Error in togglePicStatus', ['id' => $id, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Une erreur s\'est produite lors de la mise à jour du statut.'], 500);
        }
    }

    // Affiche la liste des messages de contact
    public function contactMessages()
    {
        try {
            $messages = ContactMessage::all();
            Log::info('Fetched contact messages', ['count' => $messages->count()]);
            return view('admin.contact-messages', compact('messages'));
        } catch (\Exception $e) {
            Log::error('Error in contactMessages: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite lors de la récupération des messages.');
        }
    }

    // Marque un message de contact comme traité
    public function markContactMessageProcessed($id)
    {
        try {
            $message = ContactMessage::findOrFail($id);
            if ($message->status === 'processed') {
                return redirect()->route('admin.contact-messages')->with('message', 'Ce message est déjà traité.');
            }
            $message->status = 'processed';
            $message->save();
            return redirect()->route('admin.contact-messages')->with('message', 'Message marqué comme traité.');
        } catch (\Exception $e) {
            Log::error('Error in markContactMessageProcessed: ' . $e->getMessage());
            return redirect()->route('admin.contact-messages')->with('error', 'Une erreur s\'est produite lors du marquage du message.');
        }
    }

    // Affiche la liste des organismes conventionnés
    public function organisms()
    {
        try {
            $organisms = Organism::all();
            Log::info('Fetching organisms', ['count' => $organisms->count()]);
            if (!view()->exists('admin.organisms')) {
                Log::error('View admin.organisms does not exist');
                throw new \Exception('View admin.organisms not found');
            }
            return view('admin.organisms', compact('organisms'));
        } catch (\Exception $e) {
            Log::error('Error in organisms: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite: ' . $e->getMessage());
        }
    }

    // Ajoute un nouvel organisme
    public function uploadOrganism(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:organisms,name',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            $data = [
                'name' => $request->name,
            ];

            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                try {
                    $originalFilename = $request->file('logo')->getClientOriginalName();
                    $filename = $originalFilename;
                    $counter = 1;
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                    while (Storage::disk('public')->exists("organisms/{$filename}")) {
                        $filename = "{$nameWithoutExtension}_{$counter}.{$extension}";
                        $counter++;
                    }
                    $imagePath = $request->file('logo')->storeAs('organisms', $filename, 'public');
                    $data['logo'] = $imagePath;
                } catch (\Exception $e) {
                    Log::error('Error uploading organism logo: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Erreur lors du téléchargement du logo: ' . $e->getMessage());
                }
            }

            try {
                Organism::create($data);
            } catch (\Exception $e) {
                Log::error('Error creating organism: ' . $e->getMessage(), ['data' => $data]);
                return redirect()->back()->with('error', 'Erreur lors de la création de l\'organisme dans la base de données: ' . $e->getMessage());
            }

            return redirect()->route('admin.organisms')->with('message', 'Organisme ajouté avec succès');
        } catch (ValidationException $e) {
            Log::error('Validation error in uploadOrganism: ' . $e->getMessage(), ['errors' => $e->errors()]);
            $errorMessages = collect($e->errors())->flatten()->all();
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Erreur de validation: ' . implode(', ', $errorMessages));
        } catch (\Exception $e) {
            Log::error('Unexpected error in uploadOrganism: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Une erreur inattendue s\'est produite lors de l\'ajout de l\'organisme: ' . $e->getMessage());
        }
    }

    // Récupère les données d'un organisme pour édition
    public function editOrganism($id)
    {
        try {
            $organism = Organism::findOrFail($id);
            return response()->json([
                'id' => $organism->id,
                'name' => $organism->name,
                'logo' => $organism->logo ? asset('storage/' . $organism->logo) : '',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in editOrganism: ' . $e->getMessage());
            return response()->json(['error' => 'Organisme introuvable.'], 404);
        }
    }

    // Met à jour un organisme
    public function updateOrganism(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:organisms,name,' . $id,
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            $organism = Organism::findOrFail($id);

            $data = [
                'name' => $request->name,
            ];

            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                if ($organism->logo && Storage::disk('public')->exists($organism->logo)) {
                    Storage::disk('public')->delete($organism->logo);
                }
                $originalFilename = $request->file('logo')->getClientOriginalName();
                $filename = $originalFilename;
                $counter = 1;
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                while (Storage::disk('public')->exists("organisms/{$filename}")) {
                    $filename = "{$nameWithoutExtension}_{$counter}.{$extension}";
                    $counter++;
                }
                $imagePath = $request->file('logo')->storeAs('organisms', $filename, 'public');
                $data['logo'] = $imagePath;
            }

            $organism->update($data);

            return redirect()->route('admin.organisms')->with('message', 'Organisme mis à jour avec succès');
        } catch (ValidationException $e) {
            Log::error('Validation error in updateOrganism: ' . $e->getMessage(), ['errors' => $e->errors()]);
            $errorMessages = collect($e->errors())->flatten()->all();
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Erreur de validation: ' . implode(', ', $errorMessages));
        } catch (\Exception $e) {
            Log::error('Error in updateOrganism: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour de l\'organisme: ' . $e->getMessage());
        }
    }

    // Bascule le statut is_active d'un organisme
    public function toggleOrganismStatus($id)
    {
        try {
            $organism = Organism::findOrFail($id);
            $organism->is_active = !$organism->is_active;
            $organism->save();
            Log::info('Toggled status for organism', ['id' => $id, 'is_active' => $organism->is_active]);
            return response()->json(['success' => true, 'is_active' => $organism->is_active, 'message' => 'Statut mis à jour avec succès.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Organism not found in toggleOrganismStatus', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Organisme introuvable.'], 404);
        } catch (\Exception $e) {
            Log::error('Error in toggleOrganismStatus', ['id' => $id, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Une erreur s\'est produite lors de la mise à jour du statut.'], 500);
        }
    }

    // Affiche la liste des réclamations
    public function reclamations()
    {
        try {
            $reclamations = Reclamation::all()->fresh();
            Log::info('Fetched reclamations', ['count' => $reclamations->count()]);
            if (!view()->exists('admin.reclamations')) {
                Log::error('View admin.reclamations does not exist');
                throw new \Exception('View admin.reclamations not found');
            }
            return view('admin.reclamations', compact('reclamations'));
        } catch (\Exception $e) {
            Log::error('Error in reclamations: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite lors de la récupération des réclamations.');
        }
    }

    // Marquer une réclamation comme traitée
    public function markReclamationProcessed($id)
    {
        try {
            $reclamation = Reclamation::findOrFail($id);
            Log::info('Attempting to mark reclamation as processed', ['reclamation_id' => $reclamation->id]);
            $reclamation->status = 'processed';
            $reclamation->save();
            Log::info('Reclamation marked as processed', ['reclamation_id' => $reclamation->id, 'status' => $reclamation->status]);
            return redirect()->route('admin.reclamations')->with('message', 'Réclamation marquée comme traitée avec succès');
        } catch (\Exception $e) {
            Log::error('Error in markReclamationProcessed: ' . $e->getMessage(), ['reclamation_id' => $id]);
            return redirect()->route('admin.reclamations')->with('error', 'Une erreur s\'est produite lors du marquage de la réclamation.');
        }
    }

    // Affiche la page des offres
    public function offres()
    {
        try {
            return view('admin.offres');
        } catch (\Exception $e) {
            Log::error('Error in offres: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite lors du chargement des offres.');
        }
    }

    // Affiche la page des remises
    public function remises()
    {
        try {
            return view('admin.remises');
        } catch (\Exception $e) {
            Log::error('Error in remises: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite lors du chargement des remises.');
        }
    }

    // Affiche la liste des utilisateurs mobiles
    public function usermobile()
    {
        try {
            $users = User::whereNotNull('mobile_token')->get();
            return view('admin.usermobile', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error in usermobile: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite lors du chargement des utilisateurs mobiles.');
        }
    }

    // Affiche la page des notifications
    public function notifications()
    {
        try {
            return view('admin.notifications');
        } catch (\Exception $e) {
            Log::error('Error in notifications: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite lors du chargement des notifications.');
        }
    }

    // Affiche la page de gestion des versions
    public function version()
    {
        try {
            return view('admin.version');
        } catch (\Exception $e) {
            Log::error('Error in version: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite lors du chargement de la page des versions.');
        }
    }

    // Affiche la page de gestion des ambulances
    public function ambulance()
    {
        try {
            return view('admin.ambulance');
        } catch (\Exception $e) {
            Log::error('Error in ambulance: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Une erreur s\'est produite lors du chargement de la page des ambulances.');
        }
    }
}