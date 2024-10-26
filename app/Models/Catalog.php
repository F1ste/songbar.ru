<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\ViewsIncrementTrait;

class Catalog extends Model
{
    use HasFactory, ViewsIncrementTrait;

    protected $fillable = [
        'user_id', 
        'address', 
        'qr_code_path',
        'views_per_day',
        'views_per_week',
        'views_per_month',
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'catalog_songs');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function songsByDay()
    {
        return $this->songs()->orderBy('view_per_day', 'desc');
    }
    public function songsByWeek()
    {
        return $this->songs()->orderBy('view_per_week', 'desc');
    }
    public function songsByMonth()
    {
        return $this->songs()->orderBy('view_per_month', 'desc');
    }
    public function songsByAll()
    {
        return $this->songs()->orderBy('view_per_all', 'desc');
    }
}
