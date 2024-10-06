<?php

namespace App\Http\Controllers;
use App\Models\Catalog;
use Illuminate\Http\Request;
use App\Models\Design;
use App\Models\Info;
use App\Models\Song;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $host = $request->getHost(); // Получаем хост из запроса
        $parts = explode('.', $host); // Разбиваем хост на части

        // Проверяем наличие поддомена третьего уровня
        if (count($parts) === 3) { // "sub.subdomain.com" имеет 3 части
            $subdomain = $parts[0]; // Получаем поддомен третьего уровня
            $catalog = Catalog::where('address', $subdomain)->first();
            $catalog_id = $catalog->id;
            if(isset($catalog_id)){
                $design = Design::where('catalog_id', $catalog_id)->first();
                $info = Info::where('catalog_id', $catalog_id)->first();   
                $view = $design->pagination ? 'search_results' : 'search_results_infinite';             
                
                return view('template',compact('design','info','view', 'catalog_id'));
            }else{
                return view('welcome');
            }            
        } else {
            return view('welcome');
        }
        
    }
}
