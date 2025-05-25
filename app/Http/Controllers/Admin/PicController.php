<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PicController extends Controller
{
    // Affiche la page de la galerie
    public function index()
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
    public function create()
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
    public function store(Request $request)
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
    public function edit($id)
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
    public function update(Request $request, $id)
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
    public function toggleStatus($id)
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
}