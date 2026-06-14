<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'user_agent',
        'referrer',
        'path',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
