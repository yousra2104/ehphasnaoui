<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
      
   
      // Specify the table name if it's not the plural form of the model name
      protected $table = 'actualites';
   
    
   protected $fillable = ['id', 'titre', 'description', 'image','type', 'date_ajout','is_active',];
}
