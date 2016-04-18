<div class="box box-primary">
    <div id="calendar"></div>
</div>
@section('page_scripts')
    <script>
        function drawCalendar() {
            var $progetto = $('#progetto').val();
            $('#calendar').fullCalendar({
                allDaySlot: false,
                firstHour: 8,
                slotMinutes: 30,
                axisFormat: 'HH:mm',
                lang: 'it',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'Oggi',
                    month: 'Mese',
                    week: 'Settimana',
                    day: 'Giorno'
                },
                editable: true,
                selectable: true,
                selectHelper: true,
                eventSources: [
                    {
                        url: '/ajax/interventi/getCalendar',
                        type: 'GET',
                        data: {
                            consulente_id: $('#consulente').val()
                        },
                        error: function (data) {
                            alert(JSON.stringify(data));
                        },
                        color: 'yellow',   // a non-ajax option
                        textColor: 'black' // a non-ajax option
                    },
                    {
                        url: '/ajax/interventi/getCalendar',
                        type: 'GET',
                        data: {
                            progetto_id: $progetto
                        },
                        error: function () {
                            //alert('there was an error while fetching events!');
                        },
                        color: 'red',   // a non-ajax option
                        textColor: 'black' // a non-ajax option
                    }
                ],
                select: function (start, end, resource) {
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    $('#form_title').text('Nuovo Intervento');
                    $('#data').val(moment(start).format('L'));
                    if (moment(start).format('HHmm') == '0000') {
                        ora_start = moment(start).add('8', 'h');
                        ora_end = moment(start).add('17', 'h');
                    }
                    else {
                        ora_start = moment(start);
                        ora_end = moment(end);
                    }
                    $('#ora_start').val(ora_start.format('HH:mm'));
                    $('#ora_end').val(ora_end.format('HH:mm'));

                    eventData = {
                        id: 'new',
                        title: 'Nuovo Intervento',
                        start: ora_start.format(),
                        end: ora_end.format(),
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true);
                    $('#calendar').fullCalendar('unselect');
                },
                selectConstraint: {
                    start: '00:00',
                    end: '24:00',
                }
            });
        }
        function createIntervento() {
            evento = $('#calendar').fullCalendar('clientEvents','new');
            data_start = evento[0].start._i;
            data_end = evento[0].end._i;
        }
    </script>
@append
