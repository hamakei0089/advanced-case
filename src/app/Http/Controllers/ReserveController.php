<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ReserveRequest;

class ReserveController extends Controller
{

    public function store(ReserveRequest $request)
    {
        $validated = $request->validated();

        $datetime = $datetime = $validated['date'] . ' ' . $validated['time'];

    Reserve::create([
        'user_id' => Auth::id(),
        'store_id' => $request->input('store_id'),
        'datetime' => $datetime,
        'number_of_people' => $request->input('number_of_people'),
    ]);

        return view('done');
    }

    public function destroy($reservationId){

    $reservation = Reserve::findOrFail($reservationId);

    if ($reservation->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $reservation->delete();

    return redirect('mypage')->with('message', '予約を削除しました。');
    }

    public function edit($id){

    $reserve = Reserve::findOrFail($id);
    $reserve->formatted_datetime = Carbon::parse($reserve->datetime)->format('Y-m-d\TH:i');
    return view('edit_reserve', compact('reserve'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'datetime' => 'required|date',
            'number_of_people' => 'required|integer|min:1',
        ]);

        $reserve = Reserve::findOrFail($id);
        $reserve->datetime = $request->input('datetime');
        $reserve->number_of_people = $request->input('number_of_people');
        $reserve->save();

        return redirect('mypage')->with('message', '予約が更新されました');
    }
}