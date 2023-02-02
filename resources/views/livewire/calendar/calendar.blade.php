<div>
    <script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.1/index.global.min.js "></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('{{ $elementId.$random }}');
          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($convertedEvents),
            eventTimeFormat: {
              hour: '2-digit',
              minute: '2-digit',
              meridiem: false
            },
            eventClick: function(info){
              @this.clickEvent(info);
            }
          });
          calendar.setOption('locale', '{{ $locale }}');
          calendar.render();
        });
    </script>

    <div id='{{ $elementId.$random }}' wire:ignore.self></div>
</div>
