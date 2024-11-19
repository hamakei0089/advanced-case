@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review__container">
    <h2 class="theme">{{ $store->store_name }}のレビュー</h2>
    <form action="{{ route('reviews.store', $store->id) }}" method="post">
        @csrf
        <input type="hidden" name="store_id" value="{{ $store->id }}">

            <label for="rating">評価（(悪い)1〜5(良い)）:</label>
                <select id="rating" name="rating" required>
                    <option value="">選択してください</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

            <label for="comment">コメント:</label>
                <textarea id="comment" name="comment"  rows="5" placeholder="ここにコメントを記入してください"></textarea></br>

        <button type="submit" class="review__btn">レビューを投稿する</button>
    </form>
</div>
@endsection