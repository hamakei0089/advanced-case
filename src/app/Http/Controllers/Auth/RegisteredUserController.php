<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;

class RegisteredUserController extends Controller
{
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actions\Fortify\CreateNewUser  $creator
     * @return \Laravel\Fortify\Contracts\RegisterResponse
     */
    public function store(RegisterUserRequest $request, CreateNewUser $creator)
    {
        $user = $creator->create($request->validated());

        $user->sendEmailVerificationNotification();

        /*event(new Registered($user));*/

        return redirect()->route('thanks');
    }
}
