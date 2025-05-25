<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rendezvs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RendezvousController extends Controller
{
    // Gère l'affichage des rendez-vous avec filtrage par statut
    public function index(Request $request)
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
}