var calendar;
document.addEventListener('DOMContentLoaded', function () {
    // get container
    var calendarEl = document.getElementById('calendar');

    // create event object
    calendar = new FullCalendar.Calendar(calendarEl, {
        // plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        dateClick: function (info) {
            // alert('a day has been clicked!');
        },
        headerToolbar: {
            start: 'prevYear,prev', // will normally be on the left. if RTL, will be on the right
            center: 'title today,dayGridMonth,timeGridWeek,timeGridDay',
            end: 'next,nextYear' // will normally be on the right. if RTL, will be on the left
        },
        // events: [
        //     { // this object will be "parsed" into an Event Object
        //         //  standard field
        //         'title': 'The Title for event', // a property!
        //         /* start: '2020-09-20 00:00:00', // a property!
        //         end: '2020-09-26 24:00:00', // a property! ** see important note below about 'end' ** */
        //         startRecur: '2020-09-20',
        //         endRecurr: '2020-09-25',
        //         startTime: '17:30:00',
        //         endTime: '21:30:00',
        //         'daysOfWeek': [2, 4, 6],
        //         backgroundColor: "green",
        //         //  non-standard field
        //         extendedProps: {
        //             other: "more properties of event",
        //         },
        //         description: "this is description of event",
        //         /**
        //          * > id : identifier of an event (getEventById)
        //          * > groupId : events that share a groupId will be dragged and resized together automatically
        //          * > title : title of event
        //          * > className / classNames : ['class1' 'class2'] ** style for events **
        //          * > display : 'auto'/'block'/'list-item'/'background'/'inverse-background'/'none' ** only in day-grid view **
        //          * > color : '#f00'/'#ff0000'/'rgb(255,0,0)'/'red' ** set color background and border **
        //          * >> backgroundColor, borderColor, textColor
        //          * > url : external link will visit when click on event (eventClick)
        //          * > edit: enable edit (DragnDrop) on a single event (requires the interaction plugin)
        //          * >> editable : enable all
        //          * >> startEditable : enable change date
        //          * >> durationEditable : enable change duration (day, time)
        //          * 
        //          * For continue events
        //          * > start, end : parse timestamp '2020-09-15T00:00:00'
        //          * > allDay ** if use this, the end day must be after the last day ** 
        //          * 
        //          * For recurring events
        //          * > daysOfWeek : [0,1,2,3,4,5,6] => Sun -> Sat
        //          * this property effect with: startTime, endTime, startRecur, endRecur
        //          * > startTime, endTime : parse time
        //          * > startRecur, endRecur : parse date
        //          * 
        //          * for all non-standard field will be move into extendedProps
        //          * 
        //          */
        //     },
        // ]
    });

    // getEvents()
    // calendar.addEvent(getEvents());
    calendar.render();
});

function getEvents(class_id) {
    let events;
    $("#get_class").parents('div.form-group').addClass('was-validated');
    if ("" == class_id || undefined == class_id) {
        class_id = $("#get_class").val();
    }
    if ("" !== class_id) {
        $.get(window.location.origin + "/events/" + class_id, function (data) {
            events = JSON.stringify(data);
            // console.log(data);
            calendar.getEvents().forEach(e => {
                e.remove();
            });
            data.forEach(e => {
                calendar.addEvent(e);
                calendar.render();
            });
        });
    }
};