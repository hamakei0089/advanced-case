@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/qrcode.css') }}">
@endsection

@section('content')
<div class="reservation__container">
    <h1 class="theme">予約詳細</h1>
    <table class="reservation__table">
        <tr>
            <td class="reservation__cell">予約者名</td>
            <td class="reservation__cell">{{ $reservation->user->name }}</td>
        </tr>
        <tr>
            <td class="reservation__cell">店舗名</td>
            <td class="reservation__cell">{{ $reservation->store->store_name }}</td>
        </tr>
        <tr>
            <td class="reservation__cell">日付</td>
            <td class="reservation__cell">{{ \Carbon\Carbon::parse($reservation->date)->format('Y-m-d') }}</td>
        </tr>
        <tr>
            <td class="reservation__cell">予約時間</td>
            <td class="reservation__cell">{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
        </tr>
        <tr>
            <td class="reservation__cell">人数</td>
            <td class="reservation__cell">{{ $reservation->number_of_people }}人</td>
        </tr>
    </table>

    <div class="qr-code__container">
        <h3 class="theme">QRコード</h3>
        <p>こちらを店舗様へ提示してください。</p>
        <img src="{{ $qrCodeDataUri }}" alt="QR Code" />
    </div>
</div>
@endsection
