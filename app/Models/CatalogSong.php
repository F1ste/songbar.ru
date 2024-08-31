<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogSong extends Model
{
    protected $table = 'catalog_songs';

    protected $fillable = [
        'song_id',
        'catalog_id',
    ];

}
