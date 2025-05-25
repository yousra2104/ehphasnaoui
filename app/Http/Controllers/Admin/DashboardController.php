<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Act;
use App\Models\ContactMessage;
use App\Models\ConventionedDoctor;
use App\Models\Doctor;
use App\Models\Organism;
use App\Models\Pic;
use App\Models\Reclamation;

class DashboardController extends Controller
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
}