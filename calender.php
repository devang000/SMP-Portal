<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AGENDA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Dashboard</title>

    

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.css" rel="stylesheet">
    
</head>

<body>

    <div class="card mb-4 mt-3 p-2">
        <div id='calendar'></div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/locales-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'en-in', // Set locale to Indian English
            eventDisplay: 'block',
            firstDay: 1,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            editable: false,
            droppable: false,
            eventClick: function(el) {
                el.jsEvent.preventDefault();
                $("#showEventModal").modal('show');
                $("#showEventModal").on('shown.bs.modal', function(e) {
                    $('#loading_zone').hide();
                    $('#target_zone').show();
                });
                $("#target_zone").load(decodeURIComponent(el.event.id));
            }
        });

        calendar.render();
    });
</script>

<!-- DATATABLE -->

</html>