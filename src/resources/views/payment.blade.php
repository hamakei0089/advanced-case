@extends('layouts.app3')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="store__container">
    <form action="/process-payment" method="POST">
        @csrf
        <label for="card_number">カード番号</label>
        <input type="text" id="card_number" name="card_number" required>

        <label for="exp_month">有効期限（月）</label>
        <input type="text" id="exp_month" name="exp_month" required>

        <label for="exp_year">有効期限（年）</label>
        <input type="text" id="exp_year" name="exp_year" required>

        <label for="cvc">CVC</label>
        <input type="text" id="cvc" name="cvc" required>

        <button type="submit">支払い</button>
    </form>
</div>
@endsection
