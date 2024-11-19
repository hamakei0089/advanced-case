@extends('layouts.app_rep')

@section('css')
<link rel="stylesheet" href="{{ asset('css/rep_edit.css') }}">
@endsection

@section('content')
<h2 class="theme">店舗情報編集ページ</h2>

<form action="{{ route('rep.update.store',['store_id' => $store->id])}}" class="edit-store__form" method="post">
    @csrf
    @method('PUT')

    <div class="store_name">
        <label for="store_name" class="name__label">店舗名:</label>
        <input type="text" id="store_name" name="store_name" class="name__input" value="{{ $store->store_name }}" required>
    </div>

    <div class="store__thumbnail">
        <label for="thumbnail" class="thumbnail__label">店舗画像:</label>
        <input type="file" id="thumbnail" name="thumbnail" class="thumbnail__input">
        <img src="{{ asset('storage/' . $store->thumbnail) }}" alt="{{ $store->store_name }}" style="max-width: 150px; margin-top: 10px;" />
    </div>

    <div class="store__area">
        <label for="area" class="area__label">エリア:</label>
        <select id="area" name="area" class="reservation__input" required>
            <option value="" disabled selected>エリアを選択してください</option>
            @foreach($areas as $area)
                <option value="{{ $area->name }}" {{ $store->area_id == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="reservation__num">
        <label for="genre" class="genre__label">ジャンル:</label>
        <select id="genre" name="genre" class="genre__input" required>
            <option value="" disabled selected>ジャンルを選択してください</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->name }}" {{ $store->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="store__detail">
        <label for="detail" class="detail__label">詳細:</label>
        <textarea id="detail" name="detail" class="detail__input" rows="4" required>{{ $store->detail }}</textarea>
    </div>

    <button type="submit" class="store__update-btn">更新</button>

</form>
@endsection
