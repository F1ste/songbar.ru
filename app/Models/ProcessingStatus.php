<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_rows', // Добавьте атрибут 'title'
        'processed_rows', // Добавьте атрибут 'singer'
        'status', // Добавьте атрибут 'singer'
        'catalog_id' // Добавьте атрибут 'catalog_id'
    ];
}
