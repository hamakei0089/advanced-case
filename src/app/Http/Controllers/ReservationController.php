<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ReservationRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{

public function store(ReservationRequest $request)
{
    $validated = $request->validated();

    $date = $validated['date'];
    $time = $validated['time'];

    $selectedDateTime = Carbon::parse("$date $time");
    $now = Carbon::now();

    if ($selectedDateTime->isPast()) {
        return back()->withErrors(['message' => '過去の日付や時間には予約できません。']);
    }

    Reservation::create([
        'user_id' => Auth::id(),
        'store_id' => $request->input('store_id'),
        'date' => $date,
        'time' => $time,
        'number_of_people' => $request->input('number_of_people'),
    ]);

    return view('done');
}



public function destroy($reservationId){

    $reservation = Reservation::findOrFail($reservationId);

    if ($reservation->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $reservation->delete();

    return redirect('mypage')->with('message', '予約を削除しました。');
    }

public function edit($id){

    $reservation = Reservation::findOrFail($id);
    return view('edit_reservation', compact('reservation'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required|date_format:H:i',
        'number_of_people' => 'required|integer|min:1',
    ]);

    $reservation = Reservation::findOrFail($id);
    $reservation->date = $request->input('date');
    $reservation->time = $request->input('time');
    $reservation->number_of_people = $request->input('number_of_people');
    $reservation->save();

    return redirect('mypage')->with('message', '予約が更新されました');
}
public function show($id)
{
    $reservation = Reservation::find($id);

    $qrCodeData = "名前: {$reservation->user->name}\n"
                . "店舗名: {$reservation->store->store_name}\n"
                . "日付: " . Carbon::parse($reservation->date)->format('Y-m-d') . "\n"
                . "時間: " . Carbon::parse($reservation->time)->format('H:i') . "\n"
                . "人数: {$reservation->number_of_people}人";

    $qrCodeData = mb_convert_encoding($qrCodeData, 'UTF-8', 'auto');

    $qrCode = QrCode::encoding('UTF-8')->format('png')->size(300)->generate($qrCodeData);

    $qrCodeDataUri = 'data:image/png;base64,' . base64_encode($qrCode);

    return view('qrcode', compact('reservation', 'qrCodeDataUri'));
}

}