<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConventionedDoctor extends Model
{
    use HasFactory;
protected $table = 'conv_doctors';
    protected $fillable = ['name', 'speciality', 'image'];
}