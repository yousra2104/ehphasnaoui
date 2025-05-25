<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Act;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class ActController extends Controller
{
    // Affiche la page des actualités
    public function index()
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
    public function create()
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
    public function store(Request $request)
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
    public function edit($id)
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
    public function update(Request $request, $id)
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
}