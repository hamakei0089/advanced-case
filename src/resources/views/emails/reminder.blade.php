<p>ご予約の確認</p>

<p>{{ $reservation->user->name }} 様</p>

<p>以下のご予約を本日予定しています。</p>

<p>
    <strong>店舗名:</strong> {{ $reservation->store->store_name }}<br>
    <strong>予約日時:</strong> 本日 {{ $reservation->time }}<br>
    <strong>人数:</strong> {{ $reservation->number_of_people }} 名様
</p>

<p>お忘れなくお越しください。</p>