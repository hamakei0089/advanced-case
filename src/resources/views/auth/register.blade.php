@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="register-form__heading">
        <h2 class="register_theme">Register</h2>
    </div>
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form__group1">
            <div class="form__group-content">
                <div class="form__input--text">
                    <span class="form__icon">👤</span>
                    <input type="name" name="name" value="{{ old('name') }}" placeholder="Username" class="custom-input"/>
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group1">
            <div class="form__group-content">
                <div class="form__input--text">
                    <span class="form__icon">✉️</span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="custom-input"/>
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group2">
            <div class="form__group-content">
                <div class="form__input--text">
                    <span class="form__icon">🔓</span>
                    <input type="password" name="password" placeholder="Password" class="custom-input"/>
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection