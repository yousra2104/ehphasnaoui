<?php

namespace App\Http\Controllers;

use App\Models\ConventionedDoctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConventionedDoctorController extends Controller
{
    // Affiche la liste des médecins conventionnés
    public function index()
    {
        $doctors = ConventionedDoctor::all();
        return view('admin.conventioned_doctors', compact('doctors'));
    }

    // Enregistre un nouveau médecin conventionné
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
        ]);

        ConventionedDoctor::create(array_merge($request->only(['name', 'speciality']), ['is_active' => true]));

        return redirect()->route('admin.conventioned_doctors')->with('message', 'Médecin conventionné ajouté avec succès.');
    }

    // Récupère les données d'un médecin conventionné pour modification
    public function edit($id)
    {
        $doctor = ConventionedDoctor::findOrFail($id);
        return response()->json($doctor);
    }

    // Met à jour les informations d'un médecin conventionné
    public function update(Request $request, $id)
    {
        $doctor = ConventionedDoctor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
        ]);

        $doctor->update($request->only(['name', 'speciality']));

        return redirect()->route('admin.conventioned_doctors')->with('message', 'Médecin conventionné modifié avec succès.');
    }

    // Bascule le statut is_active d'un médecin conventionné
    public function toggleStatus($id)
    {
        try {
            $doctor = ConventionedDoctor::findOrFail($id);
            $doctor->is_active = !$doctor->is_active;
            $doctor->save();
            Log::info('Toggled status for conventioned doctor', ['id' => $id, 'is_active' => $doctor->is_active]);
            return response()->json(['success' => true, 'is_active' => $doctor->is_active, 'message' => 'Statut mis à jour avec succès.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Conventioned doctor not found in toggleStatus', ['id' => $id, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Médecin conventionné introuvable.'], 404);
        } catch (\Exception $e) {
            Log::error('Error in toggleStatus', ['id' => $id, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Une erreur s\'est produite lors de la mise à jour du statut.'], 500);
        }
    }
}