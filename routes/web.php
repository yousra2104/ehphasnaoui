<?php

   use App\Http\Controllers\Admin\ActController;
   use App\Http\Controllers\Admin\ContactMessageController;
   use App\Http\Controllers\ConventionedDoctorController;
   use App\Http\Controllers\Admin\DashboardController;
   use App\Http\Controllers\Admin\DoctorController;
   use App\Http\Controllers\Admin\MiscellaneousController;
   use App\Http\Controllers\Admin\OrganismController;
   use App\Http\Controllers\Admin\PicController;
   use App\Http\Controllers\Admin\ReclamationController;
   use App\Http\Controllers\Admin\RendezvousController;
   use App\Http\Controllers\HomeController;
   use Illuminate\Support\Facades\Route;

   // Public routes (no authentication required)
   Route::get('/', [HomeController::class, 'index'])->name('home');
   Route::get('/apropos', [HomeController::class, 'apropos'])->name('apropos');
   Route::get('/galerie', [HomeController::class, 'galerie'])->name('galerie');
   Route::get('/actualite', [HomeController::class, 'actualite'])->name('actualite');
   Route::get('/actualites/{id}', [HomeController::class, 'showActualite'])->name('actualite.show');
   Route::get('/contact', function () {
       return view('user.contact');
   })->name('contact');
   Route::get('/reclamations', [HomeController::class, 'showReclamationForm'])->name('reclamations');
   Route::post('/reclamations/store', [HomeController::class, 'storeReclamation'])->name('reclamations.store');
   Route::post('/contact', [HomeController::class, 'storeContactMessage'])->name('contact.store');
   Route::get('/visite', function () {
       return view('user.visite');
   })->name('visite');

   // Service routes (public, no auth required)
   Route::get('/urologie', function () {
       return view('services.urologie');
   })->name('urologie');
   Route::get('/pediaterie', function () {
       return view('services.pediaterie');
   })->name('pediaterie');
   Route::get('/traumatologie', function () {
       return view('services.traumatologie');
   })->name('traumatologie');
   Route::get('/gastro', function () {
       return view('services.gastro');
   })->name('gastro');
   Route::get('/cardiologie', function () {
       return view('services.cardiologie');
   })->name('cardiologie');
   Route::get('/gynecologie', function () {
       return view('services.gynecologie');
   })->name('gynecologie');
   Route::get('/reanimation', function () {
       return view('services.reanimation');
   })->name('reanimation');
   Route::get('/imagerie', function () {
       return view('services.imagerie');
   })->name('imagerie');
   Route::get('/cardiovasculaire', function () {
       return view('services.cardiovasculaire');
   })->name('cardiovasculaire');
   Route::get('/labo', function () {
       return view('services.labo');
   })->name('labo');
   Route::get('/consultation', function () {
       return view('services.consultation');
   })->name('consultation');
   Route::get('/chirugie', function () {
       return view('services.chirugie');
   })->name('chirugie');

   // Authenticated user routes
   Route::middleware(['auth', 'verified'])->group(function () {
       Route::get('/rdv', function () {
           return view('user.rdv');
       })->name('rdv');
       Route::post('/rdv', [HomeController::class, 'rdv'])->name('rdv.store');
       Route::get('/myrdv', [HomeController::class, 'myrdv'])->name('myrdv');
   });

   // Admin routes
   Route::prefix('admin')->middleware(['auth', 'verified', 'can:access-admin,App\Models\User'])->group(function () {
       // Dashboard
       Route::get('/dashboard', [DashboardController::class, 'dashcount'])->name('dashboard');

       // Rendezvous
       Route::get('/rendezvous', [RendezvousController::class, 'index'])->name('admin.rendezvous');
       Route::get('/rendezvous/confirm/{id}', [RendezvousController::class, 'confirm'])->name('admin.rdv.confirm');
       Route::get('/rendezvous/cancel/{id}', [RendezvousController::class, 'cancel'])->name('admin.rdv.cancel');

       // Acts
       Route::get('/actualites', [ActController::class, 'index'])->name('admin.add_act');
       Route::get('/addactview', [ActController::class, 'create'])->name('admin.addactview');
       Route::post('/upload_act', [ActController::class, 'store'])->name('upload_act');
       Route::get('/edit_act/{id}', [ActController::class, 'edit'])->name('edit_act');
       Route::put('/update_act/{id}', [ActController::class, 'update'])->name('update_act');
       Route::patch('/toggle_act_status/{id}', [ActController::class, 'toggleStatus'])->name('toggle_act_status');
       // Route::delete('/delete_act/{id}', [ActController::class, 'deleteAct'])->name('delete_act'); // Missing in ActController, uncomment if implemented

       // Doctors
       Route::get('/medecins', [DoctorController::class, 'index'])->name('admin.add_doctor');
       Route::get('/add_doctor', [DoctorController::class, 'create'])->name('admin.add_doctor_create');
       Route::post('/upload_doctor', [DoctorController::class, 'store'])->name('upload_doctor');
       Route::get('/edit_doctor/{doctor}', [DoctorController::class, 'edit'])->name('edit_doctor');
       Route::put('/update_doctor/{doctor}', [DoctorController::class, 'update'])->name('update_doctor');
       Route::patch('/toggle_doctor_status/{id}', [DoctorController::class, 'toggleStatus'])->name('toggle_doctor_status');

       // Conventioned Doctors
       Route::get('/conventioned_doctors', [ConventionedDoctorController::class, 'index'])->name('admin.conventioned_doctors');
       Route::post('/upload_conventioned_doctor', [ConventionedDoctorController::class, 'store'])->name('upload_conventioned_doctor');
       Route::get('/edit_conventioned_doctor/{id}', [ConventionedDoctorController::class, 'edit'])->name('edit_conventioned_doctor');
       Route::put('/update_conventioned_doctor/{id}', [ConventionedDoctorController::class, 'update'])->name('update_conventioned_doctor');
       Route::patch('/toggle_conventioned_doctor_status/{id}', [ConventionedDoctorController::class, 'toggleStatus'])->name('toggle_conventioned_doctor_status');

       // Pics
       Route::get('/galerie', [PicController::class, 'index'])->name('admin.add_pic');
       Route::get('/addpicview', [PicController::class, 'create'])->name('admin.addpicview');
       Route::post('/upload_pic', [PicController::class, 'store'])->name('upload_pic');
       Route::get('/edit_pic/{id}', [PicController::class, 'edit'])->name('edit_pic');
       Route::put('/update_pic/{id}', [PicController::class, 'update'])->name('update_pic');
       Route::patch('/toggle_pic_status/{id}', [PicController::class, 'toggleStatus'])->name('toggle_pic_status');
       // Route::delete('/delete_pic/{id}', [PicController::class, 'deletePic'])->name('delete_pic'); // Missing in PicController, uncomment if implemented

       // Contact Messages
       Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('admin.contact-messages');
       Route::patch('/contact-messages/{id}/mark-processed', [ContactMessageController::class, 'markProcessed'])->name('admin.contact-messages.mark-processed');

       // Organisms
       Route::get('/organisms', [OrganismController::class, 'index'])->name('admin.organisms');
       Route::post('/organisms', [OrganismController::class, 'store'])->name('admin.organisms.store');
       Route::get('/organisms/{id}/edit', [OrganismController::class, 'edit'])->name('admin.organisms.edit');
       Route::put('/organisms/{id}', [OrganismController::class, 'update'])->name('admin.organisms.update');
       Route::patch('/toggle_organism_status/{id}', [OrganismController::class, 'toggleStatus'])->name('toggle_organism_status');

       // Reclamations
       Route::get('/reclamations', [ReclamationController::class, 'index'])->name('admin.reclamations');
       Route::patch('/reclamations/{id}/mark-processed', [ReclamationController::class, 'markProcessed'])->name('admin.reclamations.mark-processed');

       // Miscellaneous
       Route::get('/offres', [MiscellaneousController::class, 'offres'])->name('admin.offres');
       Route::get('/remises', [MiscellaneousController::class, 'remises'])->name('admin.remises');
       Route::get('/usermobile', [MiscellaneousController::class, 'usermobile'])->name('admin.usermobile');
       Route::get('/notifications', [MiscellaneousController::class, 'notifications'])->name('admin.notifications');
       Route::get('/version', [MiscellaneousController::class, 'version'])->name('admin.version');
       Route::get('/ambulance', [MiscellaneousController::class, 'ambulance'])->name('admin.ambulance');
   });

   // Redirect route
   Route::get('/home', [HomeController::class, 'redirect'])->middleware(['auth', 'verified']);