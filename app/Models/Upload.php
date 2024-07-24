<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'file_path', 
        'catalog_id',
        'last_processed_row'
    ];
}
