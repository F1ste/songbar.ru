<?php

namespace App\Http\Controllers;
use App\Models\Catalog;
use Illuminate\Http\Request;
use App\Models\Design;
use App\Models\Info;
use Illuminate\Support\Facades\Cookie;

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
        $host = $request->getHost();
        $parts = explode('.', $host);

        if (count($parts) === 3) {
            $subdomain = $parts[0];
            $catalog = Catalog::where('address', $subdomain)->first();
            $catalog_id = $catalog->id;

            if(!$catalog->is_published) {
                return view('welcome');
            }
                
            if(isset($catalog_id)){
                $design = Design::where('catalog_id', $catalog_id)->first();
                $info = Info::where('catalog_id', $catalog_id)->first();   
                $head_script = $catalog->head_script;
                $body_script = $catalog->body_script;
                
                $viewedCatalogs = json_decode(Cookie::get('viewed_catalogs', '[]'), true);

                if (!in_array($catalog_id, $viewedCatalogs)) {
                    $catalog->viewsCount();

                    $viewedCatalogs[] = $catalog_id;
                    Cookie::queue('viewed_catalogs', json_encode($viewedCatalogs), 60 * 24 * 1);
                }
                
                return view('template',compact('design','info', 'catalog_id', 'head_script', 'body_script'));
            }
            
            return view('welcome');
        } else {
            return view('welcome');
        }
        
    }
}
