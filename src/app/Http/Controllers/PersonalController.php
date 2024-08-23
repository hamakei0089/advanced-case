<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Reserve;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PersonalController extends Controller
{
public function index()

    {
    $user = Auth::user();
    $favorites = $user->favorites()->with('store')->get();
    $reserves = $user->reserves()->with('store')->get();

    return view('mypage', compact('user','favorites', 'reserves'));
    }
}
