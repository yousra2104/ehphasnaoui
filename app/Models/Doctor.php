<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    
    protected $fillable = [
        'name',
        'speciality',
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];}
