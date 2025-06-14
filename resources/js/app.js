import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin (focus);
Alpine.start ();

// FullCalendar
import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';
import '@fortawesome/fontawesome-free/css/all.min.css';

document.addEventListener ('DOMContentLoaded', function () {
  const calendarEl = document.getElementById ('calendar');
  if (!calendarEl) return;

  const calendar = new Calendar (calendarEl, {
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: 'dayGridMonth,timeGridWeek,timeGridDay',
      center: 'title',
      right: 'prev,next today',
    },
    locale: esLocale,
    events: '/api/events',
    eventClick: function (info) {
      Livewire.emit ('showEventDetails', {
        title: info.event.title,
        start: info.event.start,
        end: info.event.end,
        extendedProps: info.event.extendedProps,
      });
    },
    height: 'auto',
    editable: true,
    selectable: true,
    select: function (info) {
      // Emitir un evento a Livewire con las fechas seleccionadas
      Livewire.emit ('showEventCreateModal', {
        start: info.startStr,
        end: info.endStr,
        allDay: info.allDay,
      });
    },
    eventContent: function (arg) {
      // Si el evento tiene la propiedad type, usa gray-500
      const hasType = !!arg.event.extendedProps.type;
      const bgColor = hasType ? 'bg-gray-500' : 'bg-gray-700';

      return {
        html: `
      <div class="flex items-center gap-5 ${bgColor} hover:bg-gray-500 text-l text-white">
        <i class="fas fa-calendar-alt fa-lg"></i>
        <span class="m-5">${arg.event.title}</span>
      </div>
    `,
      };
    },
  });

  calendar.render ();
});
