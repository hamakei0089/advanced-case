<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
    $user =  Auth::user();
    $stores = Store::all();
    $areas = Area::all();
    $genres = Genre::all();

    return view('index', compact('stores', 'areas', 'genres'));

    }
}