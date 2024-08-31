<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'address'];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'catalog_songs');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
