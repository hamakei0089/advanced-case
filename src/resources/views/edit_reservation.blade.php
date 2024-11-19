@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<h2 class="theme">予約編集</h2>

<form action="{{ route('reservation.update', ['id' => $reservation->id]) }}" class="reservation__form" method="post">
    @csrf
    @method('PUT')

    <div class="reservation__date">
        <label for="date" class=”reservation__label”>予約日:</label>
        <input type="date" id="date" name="date" class="reservation__input" value="{{ $reservation->formatted_date }}" required>
    </div>

    <div class="reservation__time">
        <label for="time" class=”reservation__label”>予約時間:</label>
        <input type="time" id="time" name="time" class="reservation__input" value="{{ $reservation->formatted_time }}" required>
    </div>

    <div class="reservation__num">
        <label for="number_of_people" class=”reservation__label”>人数:</label>
        <select id="number_of_people" name="number_of_people" class="reservation__input" value="{{ $reservation->number_of_people }}"required><br>
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
    </div>

    <button type="submit" class="reservation__update-btn">更新</button>
</form>

<script src="{{ asset('js/edit.js') }}"></script>

@endsection
