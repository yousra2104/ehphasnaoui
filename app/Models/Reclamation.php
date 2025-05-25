<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;

    protected $table = 'reclamations';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'wilaya',
        'complaint_type',
        'message',
        'solution',
        'status',
    ];

    protected $casts = [
        'complaint_type' => 'array',
        'status' => 'string',''
    ];
}