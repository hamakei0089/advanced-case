@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail_container">

    <div class="store__container">
        <div class="store__row">
            <div class="button_and_name">
                <form action="/" method="get">
                @csrf
                <button class="back_button" type="submit">＜</button>
                </form>
                <p class="store-name__cell">{{ $store['store_name'] }}</p>
            </div>
            <img src="{{ asset('storage/' . $store->thumbnail) }}" alt="{{ $store->store_name }}" />
            <p class="store-nature__cell">#{{ $store['place'] }} #{{ $store['genre'] }}</p>
            <p class="store-nature__cell">{{ $store['detail'] }}</p>
        </div>
    </div>
    <div class="reserve_container">
        <div class="reserve_row">
            <h2 class="theme">予約</h2>
            <form class="reservationForm" action="/done" method="post">
                @csrf
                <input type="hidden" name="store_id" value="{{ $store->id }}">
                <input id="date" class="reserve_date" type="date" name="date" required /><br>
                <input id="time" class="reserve_time" type="time" name="time" required ><br>
                <select id="number_of_people" class="reserve_number_of_people" name="number_of_people" required ><br>
                    <option value="">-</option>
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
                <div class="reserve_confirm_container">
                    <table class="reserve_table">
                        <tr>
                            <td class="reserve_cell1">Shop</td>
                            <td class="reserve_cell2">{{ $store['store_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="reserve_cell1">Date</td>
                            <td class="reserve_cell2"><span id="displayDate"></span></td>
                        </tr>
                        <tr>
                            <td class="reserve_cell1">Time</td>
                            <td class="reserve_cell2"><span id="displayTime"></span></td>
                        </tr>
                        <tr>
                            <td class="reserve_cell1">Number</td>
                            <td class="reserve_cell2"><span id="displayNumberOfPeople"></span>人</td>
                        </tr>
                    </table>
                    <button class="reserve_confirm" type="submit">予約する</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var dateInput = document.getElementById('date');
    var timeInput = document.getElementById('time');
    var numberOfPeopleSelect = document.getElementById('number_of_people');

    var now = new Date();
    var today = now.toISOString().split('T')[0];
    var currentTime = now.toTimeString().split(' ')[0].slice(0, 5);

    dateInput.setAttribute('min', today);
    timeInput.setAttribute('min', currentTime);

    dateInput.addEventListener('input', function() {
        updateSummary();
        updateMinTime();
    });

    timeInput.addEventListener('input', updateSummary);
    numberOfPeopleSelect.addEventListener('input', updateSummary);

    function updateMinTime() {
        var selectedDate = dateInput.value;
        var minTime;
        if (selectedDate === today) {

            minTime = currentTime;
        } else {

            minTime = '00:00';
        }
        timeInput.setAttribute('min', minTime);
    }

    function updateSummary() {
        var date = dateInput.value;
        var time = timeInput.value;
        var numberOfPeople = numberOfPeopleSelect.value;

        document.getElementById('displayDate').innerText = date;
        document.getElementById('displayTime').innerText = time;
        document.getElementById('displayNumberOfPeople').innerText = numberOfPeople;

        validateDateTime(date, time);
    }

    function validateDateTime(date, time) {
        if (date && time) {
            var selectedDateTime = new Date(`${date}T${time}`);
            if (selectedDateTime < now) {
                alert('選択された日時は過去の日時です。未来の日時を選択してください。');
                dateInput.value = '';
                timeInput.value = '';
                document.getElementById('displayDate').innerText = '';
                document.getElementById('displayTime').innerText = '';
            }
        }
    }
});

</script>
@endsection