@extends('layouts.app3')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="store__container">
        @foreach($stores as $store)
            <div class="store__row" data-store-id="{{ $store->id }}" data-area="{{ $store->area->name }}" data-genre="{{ $store->genre->name }}">
                <div class="store_row__image">
                    <img src="{{ asset('storage/' . $store->thumbnail) }}" alt="{{ $store->store_name }}" />
                </div>
                <div class="store_row__content">
                    <p class="store-name__cell">{{ $store->store_name }}</p>
                    <p class="store-nature__cell">#{{ $store->area->name }} #{{ $store->genre->name }}</p>
                    <div class="store__actions">
                        <form class="store_form" action="{{ route('store.detail', ['store_id' => $store->id]) }}" method="get">
                            <button>詳しくみる</button>
                        </form>
                        @php
                            $isFavorited = $store->favoritedBy->contains(auth()->id());
                        @endphp
                        <button type="button" class="favorite-btn {{ $isFavorited ? 'bg-red-500 hover:bg-red-700' : 'bg-blue-500 hover:bg-blue-700' }} text-white font-bold py-2 px-4 rounded" data-favorite="{{ $isFavorited }}">
                            {{ $isFavorited ? '❤️' : '♡' }}
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/favorite.js') }}"></script>
@endsection
