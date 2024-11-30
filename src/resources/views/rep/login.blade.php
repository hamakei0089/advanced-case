@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login-form__heading">
        <h2 class="login_theme">店舗代表者用Login</h2>
    </div>
    <form class="form" action="/rep/login" method="post">
        @csrf
        <div class="form__group1">
            <div class="form__input--text">
                <span class="form__icon">👤</span>
                <input type="representative_id" name="representative_id" value="{{ old('representative_id') }}" placeholder="representative_id" class="custom-input"/>
            </div>
            <div class="form__error">
                @error('representative_id')
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
    <a href="/login" class="back_btn">戻る</a>
</div>
@endsection