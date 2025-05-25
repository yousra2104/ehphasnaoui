<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class DoctorController extends Controller
{
    // Affiche la vue pour ajouter un médecin
    public function create()
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
    public function index()
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
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'speciality' => 'required|string|max:255', // Modification : texte libre
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
    public function edit(Doctor $doctor)
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
    public function update(Request $request, Doctor $doctor)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'speciality' => 'required|string|max:255', // Modification : texte libre
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
    public function toggleStatus($id)
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
}