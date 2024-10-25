<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use App\Models\UserTarifs;
use Auth;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activeTarifs = UserTarifs::where('user_id', $user->id)
            ->where('tarif_end', '>', now())
            ->get();

        return view('admin.tarif.index', compact('activeTarifs'));
    }
}
