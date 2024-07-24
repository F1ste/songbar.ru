<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');
            $catalog_id = $request->input('catalog_id');
            $results = Song::where('title', 'LIKE', "%{$query}%")
            ->where('catalog_id', $catalog_id)
            ->paginate(20);


            return response()->json([
                'data' => view('search_results', compact('results'))->render(),
                'pagination' => (string) $results->links()
            ]);
        }


    }
}
