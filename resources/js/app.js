/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

// $('.toast').toast(autohide=false);
/* import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
        dateClick: function (info) {
            alert('a day has been clicked!');
        },
        headerToolbar: {
            start: 'prevYear,prev', // will normally be on the left. if RTL, will be on the right
            center: 'title',
            end: 'today,dayGridMonth,timeGridWeek,timeGridDay next,nextYear' // will normally be on the right. if RTL, will be on the left
        }
    });

    calendar.render();
}); */

import { Sortable } from '@shopify/draggable';

const sortable = new Sortable(document.querySelectorAll("ul[name='drag_zone']"), {
    draggable: "li"
});


// draggable.on('drag:start', () => console.log('drag:start'));
// draggable.on('drag:move', () => console.log('drag:move'));
// draggable.on('drag:stop', () => console.log('drag:stop'));

// sortable.on('sortable:start', () => console.log('sortable:start'));
// sortable.on('sortable:sort', () => console.log('sortable:sort'));
// sortable.on('sortable:sorted', () => console.log('sortable:sorted'));
// sortable.on('sortable:stop', () => console.log('sortable:stop',sortable));