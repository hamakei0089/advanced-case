<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;


class StoreController extends Controller
{

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
