@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="reservation__container">
    <p class="reservation__theme">ご予約ありがとうございます</p>
        @csrf
        <div class="form__button">
            <a href="/" class="form__button-submit">戻る</a>
        </div>
</div>
@endsection