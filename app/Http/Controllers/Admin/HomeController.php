<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        $catalogs = Catalog::where('user_id', $user->id)->get();        

        foreach($catalogs as $cat){            
            if($cat->address == NULL){
                $table = 'catalogs'; // Название таблицы
                $column = 'address'; // Название столбца, где должна быть уникальная строка
    
                $uniqueString = $this->generateUniqueString($table, $column);
                $cat->address = $uniqueString;
                $cat->save();
            }
        }   

        $catalogs = Catalog::where('user_id', $user->id)->get();      
       return view('admin.home.index', compact('catalogs'));
    }

    public function generateUniqueString($table, $column, $length = 8)
    {
        do {
            // Генерация случайной строки
            $string = Str::random($length);

            // Проверка уникальности строки в указанной таблице и столбце
            $exists = DB::table($table)->where($column, $string)->exists();
        } while ($exists);

        return $string;
    }
}
