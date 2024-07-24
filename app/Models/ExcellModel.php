<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcellModel extends Model
{
    use HasFactory;

    protected $table = 'songs';

    protected $fillable = ['catalog_id', 'singer', 'title'];
}
