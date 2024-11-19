<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PersonalController extends Controller
{
public function index()

    {
    $user = Auth::user();
    $favorites = $user->favorites()->with('store.area', 'store.genre')->get();
    $reservations = $user->reservations()->with('store.area', 'store.genre')->get();

    return view('mypage', compact('user','favorites', 'reservations'));
    }
}
