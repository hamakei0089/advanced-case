@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks_content">
    <p class="thanks_theme">会員登録ありがとうございます</p>
        @csrf
        <div class="form__button">
            <a href="/login" class="form__button-submit">ログインする</a>
        </div>
</div>
@endsection