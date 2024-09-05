<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Filterable;

class Song extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = ['catalog_id', 'title', 'singer'];

    public function catalogs()
    {
        return $this->belongsToMany(Catalog::class, 'catalog_songs');
    }
}
