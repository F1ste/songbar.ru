<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function store(Request $request)
    {
        $song = Song::create(['title' => $request->title, 'singer' => $request->singer]);
        $song->catalogs()->attach($request->catalogId);

        return response()->json([
            'status' => 'success',
            'song' => $song,
            'message' => 'Песня успешно добавлена в каталог.'
        ]);
    }

    public function destroy(Request $request, Song $song)
    {
        $catalogId = $request->input('catalog_id');
        $song->catalogs()->detach($catalogId);

        return response()->json([
            'status' => 'success',
            'message' => 'Песня успешно удалена из каталога.'
        ]);
    }
}
