<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserTarifs;
use Auth;

class SubscribeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activeTarifs = UserTarifs::where('user_id', $user->id)
            ->where('tarif_end', '>', now())
            ->get();

        if ($activeTarifs->isEmpty()) {
            return redirect()->route('tarif');
        }


        return view('admin.subscribe.index', compact('activeTarifs'));
    }
}
