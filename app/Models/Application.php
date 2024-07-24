<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public function doctor()
    {
        return $this->hasOne('\App\Models\User', 'id', 'doctor_id');
    }
    public function client()
    {
        return $this->hasOne('\App\Models\Client', 'id', 'client_id');
    }
}
