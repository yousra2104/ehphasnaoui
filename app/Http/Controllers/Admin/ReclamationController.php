<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reclamation;
use Illuminate\Support\Facades\Log;

class ReclamationController extends Controller
{
    // Affiche la liste des réclamations
    public function index()
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
    public function markProcessed($id)
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
}