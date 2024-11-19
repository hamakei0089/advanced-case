
document.addEventListener('DOMContentLoaded', function() {
    var dateInput = document.getElementById('date');
    var timeInput = document.getElementById('time');
    var numberOfPeopleSelect = document.getElementById('number_of_people');

    var now = new Date();
    var today = now.toISOString().split('T')[0];
    var currentTime = now.toTimeString().split(' ')[0].slice(0, 5);

    dateInput.setAttribute('min', today);

    function updateMinTime() {
        var selectedDate = dateInput.value;

        if (selectedDate === today) {
            timeInput.setAttribute('min', currentTime);
        } else {
            timeInput.removeAttribute('min');
        }
    }

    function validateDateTime(date, time) {
        if (date && time) {
            var selectedDateTime = new Date(`${date}T${time}`);
            var now = new Date();

            if (selectedDateTime < now) {
                alert('選択された時間は過去の時間です。未来の時間を選択してください。');
                dateInput.value = '';
                timeInput.value = '';
                return false;
            }
        }
        return true;
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

    dateInput.addEventListener('input', function() {
        updateSummary();
        updateMinTime();
    });

    timeInput.addEventListener('input', updateSummary);
    numberOfPeopleSelect.addEventListener('input', updateSummary);

    updateMinTime();
});
