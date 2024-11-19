@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp

<h2 class="username">{{ $user->name }}さん</h2>
    @if (session('message'))
        <p class="alert alert-success">
            {{ session('message') }}
        </p>
    @endif
<div class="personal__container">
    <div class="reservation__container">
        <h3 class="reservation__theme">予約状況</h3>
        @if($reservations->isEmpty())
            <p>予約した情報はありません。</p>
        @else
            @foreach($reservations as $index => $reservation)
        <div class="reservation__row">
            <table class="reservation__table">
                <tr>
                    <td class="reservation__symbol">🕑</td>
                    <td class="reservation__topic">予約{{ $index + 1 }}</td>
                    <td class="reservation__cell"></td>
                    <td colspan="2" class="reservation__cell">
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">×</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td class="reservation__cell">Shop</td>
                    <td class="reservation__cell">{{ $reservation->store->store_name }}</td>
                </tr>
                <tr>
                    <td class="reservation__cell">Date</td>
                    <td class="reservation__cell">{{ Carbon::parse($reservation->date)->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <td class="reservation__cell">Time</td>
                    <td class="reservation__cell">{{ Carbon::parse($reservation->time)->format('H:i') }}</td>
                </tr>
                <tr>
                    <td class="reservation__cell">Number</td>
                    <td class="reservation__cell">{{ $reservation->number_of_people }}人</td>
                </tr>
                <tr>
                    <td class="reservation__cell">
                        <form action="{{ route('reservation.edit', ['id' => $reservation->id]) }}" method="get">
                            @csrf
                            <button class="edit_reservation_btn" type="submit">編集</button>
                        </form>
                    </td>
                    <td class="reservation__cell">
                        <form action="{{ route('qr-code.show' , ['id' => $reservation->id]) }}" method="get">
                            @csrf
                            <button class="edit_reservation_btn" type="submit">QRコード</br>生成</button>
                        </form>
                    </td>
                    <td class="reservation__cell">
                        <a class="payment_btn" href="https://buy.stripe.com/test_dR6aF5gSxg6yfK0bII">支払い
                        </a>
                    </td>
                    <td class="reservation__cell">
                        @if (Carbon::parse($reservation->formatted_datetime)->isPast())
                            <form action="{{ route('reviews.create', ['store' => $reservation->store->id]) }}" method="get">
                                @csrf
                                <button type="submit" class="evaluation_btn">評価する</button>
                            </form>
                        @endif
                        </td>
                </tr>
            </table>
        </div>
            @endforeach
        @endif
    </div>

    <div class="favorite__container">
    <h3 class="favorite__theme">お気に入り店舗</h3>
    @if($favorites->isEmpty())
        <p>お気に入りの店舗はありません。</p>
    @else
        @foreach($favorites as $favorite)
            <div class="favorite__row" data-store-id="{{ $favorite->store->id }}">
                <img src="{{ asset('storage/' . $favorite->store->thumbnail) }}" alt="{{ $favorite->store->store_name }}" />
                <div class="favorite_row__content">
                    <p class="favorite-store-name__cell">{{ $favorite->store->store_name }}</p>
                    <p class="favorite-store-nature__cell">#{{ $favorite->store->area->name }} #{{ $favorite->store->genre->name }}</p>
                    <div class="favorite__actions">
                        <form class="store_form" action="{{ route('store.detail', ['store_id' => $favorite->store->id]) }}" method="get">
                            <button>詳しくみる</button>
                        </form>
                        @php
                            $isFavorited = $favorite->store->favoritedBy->contains(auth()->id());
                        @endphp
                        <button type="button" class="favorite-btn {{ $isFavorited ? 'bg-red-500 hover:bg-red-700' : 'bg-blue-500 hover:bg-blue-700' }} text-white font-bold py-2 px-4 rounded" data-favorite="{{ $isFavorited }}">
                            {{ $isFavorited ? '❤️' : '♡' }}
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/mypage.js') }}"></script>
@endsection