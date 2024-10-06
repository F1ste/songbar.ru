<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as FakerFactory;

class HomeController extends Controller
{
    use WithFaker;
    public function index(){
        $user = Auth::user();
        $catalogs = $user->catalogs;        

        foreach($catalogs as $catalog){            
            if($catalog->address == null){
                $faker = FakerFactory::create();
                $catalog->address = $faker->unique()->lexify('????????');
                $catalog->save();
            }
        }   
   
       return view('admin.home.index', compact('catalogs'));
    }

}
