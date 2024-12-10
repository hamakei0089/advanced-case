<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    public function index()
    {
    $user =  Auth::user();
    $stores = Store::all();
    $areas = Area::all();
    $genres = Genre::all();

    return view('index', compact('stores', 'areas', 'genres'));

    }

public function show($id)
    {
        $store = Store::findOrFail($id);
        return view('detail', compact('store'));
    }

public function like(Store $store)
    {
        $user = auth()->user();

        if ($user->favorites()->where('store_id', $store->id)->exists()) {

            $user->favorites()->where('store_id', $store->id)->delete();
        } else {

            $user->favorites()->create(['store_id' => $store->id]);
        }

        return response()->json(['success' => true]);
    }

}
