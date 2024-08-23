<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

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

        /*event(new Registered($user));*/

        return redirect()->route('thanks');
    }
}
