<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\ConventionedDoctor;

   class ConvDoctorsSeeder extends Seeder
   {
       /**
        * Run the database seeds.
        *
        * @return void
        */
       public function run()
       {
           $doctors = [
               ['name' => 'Dr MOUSSAOUI Fethi', 'speciality' => 'CARDIOLOGUE'],
               ['name' => 'Dr OUKIL Amirouche', 'speciality' => 'Chirurgie Cardio Vasculaire'],
               ['name' => 'Dr BELHANDOUZ Lahcen', 'speciality' => 'Chirurgie Générale'],
               ['name' => 'Dr BENAROUSSI Sid Ahmed', 'speciality' => 'Chirurgie Vasculaire'],
               ['name' => 'Dr MOUMENE Kheir Eddine', 'speciality' => 'Chirurgie Viscérale'],
               ['name' => 'Dr BENATTOUCHE Omar Farouk', 'speciality' => 'Pharmacien'],
               ['name' => 'Dr. ALKHALILI Fadia', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. BERREBAH Soumia', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr EL ABBASSI Ismahen', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. BELHADJ Nabila', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. ALLOUANE Zoubida', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. MEZOUARI Yamina', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. BENYELLES Nawel', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. BOUABDALLAH Nawal', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. BOUHAFS Mustapha Nazim', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. SOULIMANE Amine', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. ALLAL Adlane', 'speciality' => 'Gynécologie Obstétrique'],
               ['name' => 'Dr. BENZEGUIR Chahinez', 'speciality' => 'Gynécologie Obstétrique'],
           ];

           foreach ($doctors as $doctor) {
               ConventionedDoctor::updateOrCreate(
                   ['name' => $doctor['name']],
                   ['speciality' => $doctor['speciality']]
               );
           }
       }
   }