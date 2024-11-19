@extends('layouts.app_rep')

@section('css')
<link rel="stylesheet" href="{{ asset('css/rep_home.css') }}">
@endsection

@section('content')
<h2 class="name">ようこそ、{{ $representative->name }}様</h2>
        @if(session('success'))
            <p class="registration__success">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="registration__error">{{ session('error') }}</p>
        @endif
<div class="main__container">
    <div class="registration__container">
        <h2 class="theme">店舗登録</h2>
        <form action="{{ route('rep.createStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="rep_id" value="{{ $representative->id }}">
            <div class="form-group">
                <label for="store_name">店舗名</label>
                <input type="text" name="store_name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="description">店舗の詳細</label>
                <textarea name="detail" class="form-control" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <label for="thumbnail">画像</label>
                <input type="file" name="thumbnail" class="form-control-file" required>
            </div>
            <div class="form-group">
            <label for="area">所在地</label>
            <select name="area" class="form-control" required>
                <option value="" disabled selected>選択してください</option>
                @foreach($areas as $area)
                    <option value="{{ $area->name }}" {{ old('area') == $area->name ? 'selected' : '' }}>{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="genre">ジャンル</label>
            <select name="genre" class="form-control" required>
                <option value="" disabled selected>選択してください</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->name }}" {{ old('genre') == $genre->name ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
            <button class="registration__btn">登録</button>
        </form>
    </div>

    <div class="store__container">
        <h2 class="theme">登録店舗一覧</h2>
        @foreach($stores as $store)
            <div class="store__row" data-store-id="{{ $store->id }}" data-area="{{ $store->area->name }}" data-genre="{{ $store->genre->name }}">
                <div class="store_row__image">
                    <img src="{{ asset('storage/' . $store->thumbnail) }}" alt="{{ $store->store_name }}" />
                </div>
                <div class="store_row__content">
                    <p class="store-name__cell">{{ $store->store_name }}</p>
                    <p class="store-nature__cell">#{{ $store->area->name }} #{{ $store->genre->name }}</p>
                        <form class="store_form" action="{{ route('rep.detail', ['store_id' => $store->id]) }}" method="get">
                            <button>詳しくみる</button>
                        </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection