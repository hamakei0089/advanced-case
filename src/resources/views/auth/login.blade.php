@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login-form__heading">
        <h2 class="login_theme">Login</h2>
    </div>
    <form class="form" action="/login" method="post">
        @csrf
        <div class="form__group1">
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
        <div class="form__group2">
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
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
<div class="button__wrapper">
    <a href="/admin/login" class="admin_login_btn">管理者はこちら</a>
    <a href="/rep/login" class="rep_login_btn">店舗代表者はこちら</a>
</div>
@endsection