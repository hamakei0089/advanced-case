@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_done.css') }}">
@endsection

@section('content')
<div class="review__container">
    <p class="review__theme">ご評価ありがとうございます</p>
        @csrf
        <div class="form__button">
            <a href="/" class="form__button-submit">戻る</a>
        </div>
</div>
@endsection