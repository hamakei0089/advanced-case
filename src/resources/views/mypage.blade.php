@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp

<h2 class="username">{{ $user->name }}さん</h2>
<div class="personal_container">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="reserve_container">
         <h3 class="reserve_theme">予約状況</h3>
        @if($reserves->isEmpty())
            <p>予約した情報はありません。</p>
        @else
            @foreach($reserves as $index => $reserve)
        <div class="reserve_row">
            <table class="reserve_table">
                <tr>
                    <td class="reserve_symbol">🕑</td>
                    <td class="reserve_topic">予約{{ $index + 1 }}</td>
                    <td class="reserve_cell"></td>
                    <td colspan="2" class="reserve_cell">
                        <form action="{{ route('reservations.destroy', $reserve->id) }}" method="post" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">×</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td class="reserve_cell">Shop</td>
                    <td class="reserve_cell">{{ $reserve->store->store_name }}</td>
                </tr>
                <tr>
                    <td class="reserve_cell">Date</td>
                    <td class="reserve_cell">{{ Carbon::parse($reserve->datetime)->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <td class="reserve_cell">Time</td>
                    <td class="reserve_cell">{{ Carbon::parse($reserve->datetime)->format('H:i') }}</td>
                </tr>
                <tr>
                    <td class="reserve_cell">Number</td>
                    <td class="reserve_cell">{{ $reserve->number_of_people }}人</td>
                </tr>
                <tr>
                    <td class="reserve_cell">
                        <form action="{{ route('reserve.edit', ['id' => $reserve->id]) }}" method="get">
                            @csrf
                            <button class="edit_reserve_btn" type="submit">編集</button>
                        </form>
                    </td>
                    <td class="reserve_cell">
                        @if (Carbon::parse($reserve->datetime)->isPast())
                            <form action="{{ route('reviews.create', ['store' => $reserve->store->id]) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-primary">評価する</button>
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
    <h3 class="favorite_theme">お気に入り店舗</h3>
    @if($favorites->isEmpty())
        <p>お気に入りの店舗はありません。</p>
    @else
        @foreach($favorites as $favorite)
            <div class="favorite__row" data-store-id="{{ $favorite->store->id }}">
                <div class="favorite_row__image">
                    <img src="{{ asset('storage/' . $favorite->store->thumbnail) }}" alt="{{ $favorite->store->store_name }}" />
                </div>
                <div class="favorite_row__content">
                    <p class="favorite-store-name__cell">{{ $favorite->store->store_name }}</p>
                    <p class="favorite-store-nature__cell">#{{ $favorite->store->place }} #{{ $favorite->store->genre }}</p>
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
@endsection

@section('scripts')
<script src="{{ asset('js/script.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.favorite-btn').click(function() {
            var button = $(this);
            var storeId = button.closest('.favorite__row').data('store-id');
            var isFavorite = button.data('favorite');

            $.ajax({
                url: '/stores/' + storeId + '/favorite',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {

                    isFavorite = !isFavorite;
                    button.data('favorite', isFavorite);
                    button.html(isFavorite ? '♡' : '❤️');
                    button.toggleClass('bg-red-500 hover:bg-red-700 bg-blue-500 hover:bg-blue-700');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
