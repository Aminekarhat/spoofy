<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class off extends Model
{
    use HasFactory;
    protected $fillable = [
        'day',
        'intern_id',
    ];
}
