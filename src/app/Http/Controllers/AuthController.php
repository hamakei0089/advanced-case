<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
    $user =  Auth::user();
    $stores = Store::all();
    $areas = Store::select('place')->distinct()->get();
    $genres = Store::select('genre')->distinct()->get();

    return view('index', compact('stores', 'areas', 'genres'));

    }
}