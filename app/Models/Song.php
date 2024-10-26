<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Filterable;
use App\Models\Traits\ViewsIncrementTrait;

class Song extends Model
{
    use HasFactory;
    use Filterable, ViewsIncrementTrait;

    protected $fillable = [
        'catalog_id', 
        'title', 
        'singer',
        'view_per_day',
        'view_per_week',
        'view_per_month',
    ];

    public function catalogs()
    {
        return $this->belongsToMany(Catalog::class, 'catalog_songs');
    }
}
