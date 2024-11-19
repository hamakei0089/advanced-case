
    document.addEventListener("DOMContentLoaded", function () {
        var dateInput = document.getElementById('date');
        var timeInput = document.getElementById('time');

        var today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);

        dateInput.addEventListener('change', function () {
            var selectedDate = this.value;
            var currentDate = new Date().toISOString().split('T')[0];
            if (selectedDate === currentDate) {
                var now = new Date();
                var currentTime = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
                timeInput.setAttribute('min', currentTime);
            } else {
                timeInput.removeAttribute('min');
            }
        });
    });