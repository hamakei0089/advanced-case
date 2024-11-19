@extends('layouts.app_rep')

@section('css')
<link rel="stylesheet" href="{{ asset('css/rep_detail.css') }}">
@endsection

@section('content')
<div class="detail__container">
    <div class="store__container">
        <div class="button_and_name">
            <form action="/rep/home" method="get">
            @csrf
            <button class="back_button" type="submit">＜</button>
            </form>
            <p class="store-name__cell">{{ $store['store_name'] }}</p>
        </div>
        <img src="{{ asset('storage/' . $store->thumbnail) }}" alt="{{ $store->store_name }}" />
        <p class="store-nature__cell">#{{ $store->area->name }} #{{ $store->genre->name }}</p>
        <p class="store-nature__cell">{{ $store['detail'] }}</p>
        <form action="{{ route('rep.edit.store', ['store_id' => $store->id]) }}" method="get">
        @csrf
        <button class="edit_reservation_btn" type="submit">編集</button>
        </form>
    </div>

    <div class="reservation__container">
        <h2 class="theme">予約一覧</h2>
        @if($reservations->isEmpty())
            <p>予約した情報はありません。</p>
        @else
            @foreach($reservations as $reservation)
                <table class="reservation__table">
                    <tr>
                        <td class="reservation__cell1">Name</td>
                        <td class="reservation__cell2">{{ $reservation->user->name }} 様</td>
                    </tr>
                    <tr>
                        <td class="reservation__cell1">Date</td>
                        <td class="reservation__cell2">{{ $reservation->date }}</td>
                    </tr>
                    <tr>
                        <td class="reservation__cell1">Time</td>
                        <td class="reservation__cell2">{{ $reservation->time }}</td>
                    </tr>
                    <tr>
                        <td class="reservation__cell1">Number</td>
                        <td class="reservation__cell2">{{ $reservation->number_of_people }}名様</td>
                    </tr>
                </table>
            @endforeach
        @endif
    </div>

</div>
@endsection