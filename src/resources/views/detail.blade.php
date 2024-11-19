@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail__container">
    <div class="store__container">
        <div class="button_and_name">
            <form action="/" method="get">
            @csrf
            <button class="back_button" type="submit">＜</button>
            </form>
            <p class="store-name__cell">{{ $store['store_name'] }}</p>
        </div>
        <img src="{{ asset('storage/' . $store->thumbnail) }}" alt="{{ $store->store_name }}" />
        <p class="store-nature__cell">#{{ $store->area->name }} #{{ $store->genre->name }}</p>
        <p class="store-nature__cell">{{ $store['detail'] }}</p>
    </div>

    <div class="reservation__container">
        <h2 class="theme">予約</h2>
        <form class="reservationForm" action="/done" method="post">
            @csrf
            <input type="hidden" name="store_id" value="{{ $store->id }}">
            <input id="date" class="reservation__date" type="date" name="date" required /><br>
            <input id="time" class="reservation__time" type="time" name="time" required ><br>
            <select id="number_of_people" class="reservation__number__of__people" name="number_of_people" required ><br>
                <option value="1">1人</option>
                <option value="2">2人</option>
                <option value="3">3人</option>
                <option value="4">4人</option>
                <option value="5">5人</option>
                <option value="6">6人</option>
                <option value="7">7人</option>
                <option value="8">8人</option>
                <option value="9">9人</option>
            </select>
            <br><br>
            <div class="reservation__confirm__container">
                <table class="reservation__table">
                    <tr>
                        <td class="reservation__cell1">Shop</td>
                        <td class="reservation__cell2">{{ $store['store_name'] }}</td>
                    </tr>
                    <tr>
                        <td class="reservation__cell1">Date</td>
                        <td class="reservation__cell2"><span id="displayDate"></span></td>
                    </tr>
                    <tr>
                        <td class="reservation__cell1">Time</td>
                        <td class="reservation__cell2"><span id="displayTime"></span></td>
                    </tr>
                    <tr>
                        <td class="reservation__cell1">Number</td>
                        <td class="reservation__cell2"><span id="displayNumberOfPeople"></span>人</td>
                    </tr>
                </table>
                <button class="reservation__confirm" type="submit">予約する</button>
            </div>
        </form>
    </div>

</div>

<script src="{{ asset('js/reservation.js') }}"></script>
@endsection