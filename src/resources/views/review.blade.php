@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review_container">
    <h2>{{ $store->store_name }}のレビュー</h2>
    <form action="{{ route('reviews.store', $store->id) }}" method="post">
        @csrf
        <input type="hidden" name="store_id" value="{{ $store->id }}">
        <div class="rating">
            <label for="rating">評価（1〜5）:</label>
            <select id="rating" name="rating" required>
                <option value="">選択してください</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <button type="submit">レビューを投稿する</button>
    </form>
</div>
@endsection