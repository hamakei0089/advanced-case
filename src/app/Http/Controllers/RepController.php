<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Representative;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Store;
use App\Models\Reservation;



class RepController extends Controller
{
    public function index()
    {
        return view('rep.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('representative_id', 'password');

        if (Auth::guard('representatives')->attempt($credentials)) {

            return redirect('/rep/home');
        }

        return back()->withErrors([
            'representative_id' => 'ログイン情報が正しくありません。',
        ]);
    }

    public function logout()
    {
        Auth::guard('representatives')->logout();

        return redirect('/rep/login');
    }

    public function home()
    {
        $representative = Auth::guard('representatives')->user();

        $areas = Area::all();
        $genres = Genre::all();
        $stores = Store::where('rep_id', $representative->id)->with('reservations')->get();

    return view('rep.home', compact('representative', 'stores','areas','genres'));
    }

    public function create(Request $request)
    {
        $area = Area::where('name', $request->input('area'))->first();
        $genre = Genre::where('name', $request->input('genre'))->first();

        $image_path = $request->file('thumbnail')->store('public/');

        Store::create([
        'store_name' => $request->input('store_name'),
        'detail' => $request->input('detail'),
        'thumbnail' => basename($image_path),
        'area_id' => $area->id,
        'genre_id' => $genre->id,
        'rep_id' => $request->input('rep_id'),
        ]);

        return redirect()->route('rep.home')->with('success', '店舗が登録されました');
    }

    public function show($storeid)
    {
    $store = Store::with(['area', 'genre'])->findOrFail($storeid);

    $reservations = Reservation::with('user')->where('store_id', $storeid)
    ->orderBy('date', 'asc')
    ->orderBy('time', 'asc')
    ->get();
    return view('rep.detail', compact('store','reservations'));
    }

    public function edit($id)
{
    $store = Store::findOrFail($id);
    $areas = Area::all();
    $genres = Genre::all();
    return view('rep.edit_store', compact('store','areas','genres'));
}

    public function update(Request $request, $id)
{
    $store = Store::findOrFail($id);

    if ($request->hasFile('thumbnail')) {

        if ($store->thumbnail) {
            Storage::delete('public/' . $store->thumbnail);
        }

        $image_path = $request->file('thumbnail')->store('public/');
        $store->thumbnail = basename($image_path);
    }

    $store->store_name = $request->input('store_name');
    $store->detail = $request->input('detail');

    $area = Area::where('name', $request->input('area'))->first();
    $genre = Genre::where('name', $request->input('genre'))->first();

    $store->area_id = $area->id;
    $store->genre_id = $genre->id;

    $store->save();

    return redirect()->route('rep.home')->with('success', '店舗情報が更新されました');
}

    public function delete($store_id)
    {
    $store = Store::findOrFail($store_id);
    $store->delete();

    return redirect()->route('rep.home')->with('success', '店舗が削除されました。');
    }
}
