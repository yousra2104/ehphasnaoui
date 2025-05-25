<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pic extends Model
{
    protected $fillable = ['type', 'image','description', 'is_active'];
}
