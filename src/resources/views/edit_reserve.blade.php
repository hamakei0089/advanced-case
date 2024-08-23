@extends('layouts.app')

@section('content')
<h2>予約編集</h2>

<form action="{{ route('reserve.update', ['id' => $reserve->id]) }}" method="post">
    @csrf
    @method('PUT')

    <div>
        <label for="datetime">予約日時:</label>
        <input type="datetime-local" id="datetime" name="datetime" value="{{ $reserve->formatted_datetime }}" required>
    </div>

    <div>
        <label for="number_of_people">人数:</label>
        <input type="number" id="number_of_people" name="number_of_people" value="{{ $reserve->number_of_people }}" required>
    </div>

    <button type="submit">更新</button>
</form>

@endsection
