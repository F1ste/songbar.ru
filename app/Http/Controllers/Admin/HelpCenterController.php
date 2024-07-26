<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    public function index()
    {
        return view('admin.help-center.index');
    }
}
