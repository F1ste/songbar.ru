<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTarifs extends Model
{
    use HasFactory;

    protected $fillable = [
        'tarif_name',
        'tarif_start',
        'tarif_end',
    ];

    protected $tables = 'user_tarifs';
}
