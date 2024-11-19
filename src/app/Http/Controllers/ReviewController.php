<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function index(Store $store)
    {
        return view('review', compact('store'));
    }

    public function store(Request $request, $storeId)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        $store = Store::findOrFail($storeId);

        Review::create([
            'store_id' => $store->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return view('review_done');
    }
}
