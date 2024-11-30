<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('administrator_id', 'password');

        if (Auth::guard('administrators')->attempt($credentials)) {

            return redirect('/admin/home');
        }

        return back()->withErrors([
            'administrator_id' => 'ログイン情報が正しくありません。',
        ]);
    }

    public function logout()
    {
        Auth::guard('administrators')->logout();

        return redirect('/admin/login');
    }

    public function home()
    {
        return view('admin.home');
    }

    public function create(Request $request)
{

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'representative_id' => 'required|string|max:255|unique:representatives',
        'password' => 'required|string|min:8',
    ]);

    Representative::create([
        'name' => $validatedData['name'],
        'representative_id' => $validatedData['representative_id'],
        'password' => Hash::make($validatedData['password']),
    ]);

    return redirect()->route('admin.home')->with('success', '店舗代表者を作成しました');
}

public function sendBroadcastEmail(Request $request)
{
    $request->validate([
        'email_title' => 'required|string|max:255',
        'email_body' => 'required|string',
    ]);

    $users = User::all();

    foreach ($users as $user) {
        Mail::raw($request->email_body, function ($message) use ($user, $request) {
            $message->to($user->email)
                    ->subject($request->email_title);
        });
    }

    return redirect()->back()->with('broadcast_success', 'メールを送信しました！');
}
}
