<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class OrganismController extends Controller
{
    // Affiche la liste des organismes conventionnés
    public function index()
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
    public function store(Request $request)
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
    public function edit($id)
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
    public function update(Request $request, $id)
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
    public function toggleStatus($id)
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
}