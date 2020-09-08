document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        // plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        dateClick: function (info) {
            alert('a day has been clicked!');
        },
        headerToolbar: {
            start: 'prevYear,prev', // will normally be on the left. if RTL, will be on the right
            center: 'title today,dayGridMonth,timeGridWeek,timeGridDay',
            end: 'next,nextYear' // will normally be on the right. if RTL, will be on the left
        }
    });

    calendar.render();
});