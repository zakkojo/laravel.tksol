<div class="box box-primary">
    <div id="calendar"></div>
</div>
@section('page_scripts')
    <script>
        var globale_progetto;
        var globale_consulente;
        function drawCalendar() {
            $('#calendar').fullCalendar({
                allDaySlot: false,
                firstHour: 8,
                slotMinutes: 30,
                axisFormat: 'HH:mm',
                timeFormat: {
                    agenda: 'H:mm'
                },

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
                select: function (start, end, resource) {
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    $('#form_title').text('Nuovo Intervento');
                    $('#intervento_id').val('').trigger("change");
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
                },
                eventConstraint: {
                    start: '00:00',
                    end: '24:00',
                },
                eventResizeStart: function (calEvent, delta, revertFunc) {
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    $('#form_title').text('Modifica Intervento ' + calEvent.id);
                    $('#intervento_id').val(calEvent.id).trigger("change");
                    $('#contratto').val(calEvent.contratto_id);
                    $('#listinoContratto').val(calEvent.listino_id).trigger('change.select2');
                    $('#attivita').val(calEvent.attivita_id).trigger('change.select2');
                    $('#consulente').val(calEvent.consulente_id).trigger('change.select2');
                    $('#data').val(calEvent.start.format('L'));
                    $('#ora_start').val(calEvent.start.format('HH:mm'));
                    $('#ora_end').val(calEvent.end.format('HH:mm'));
                },
                eventResize: function (event, delta, revertFunc) {
                    $('#ora_end').val(event.end.format('HH:mm'));
                    updateIntervento();
                },
                eventDragStart: function (calEvent, delta, revertFunc) {
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    $('#form_title').text('Modifica Intervento ' + calEvent.id);
                    $('#intervento_id').val(calEvent.id).trigger("change");
                    $('#contratto').val(calEvent.contratto_id);
                    $('#listinoContratto').val(calEvent.listino_id).trigger('change.select2');
                    $('#attivita').val(calEvent.attivita_id).trigger('change.select2');
                    $('#consulente').val(calEvent.consulente_id).trigger('change.select2');
                    $('#data').val(calEvent.start.format('L'));
                    $('#ora_start').val(calEvent.start.format('HH:mm'));
                    $('#ora_end').val(calEvent.end.format('HH:mm'));
                },
                eventDrop: function (event, delta, revertFunc) {
                    $('#data').val(moment(event.start).format('L'));
                    $('#ora_start').val(event.start.format('HH:mm'));
                    $('#ora_end').val(event.end.format('HH:mm'));
                    updateIntervento();
                },
                eventClick: function (calEvent, jsEvent, view) {
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    $('#form_title').text('Modifica Intervento ' + calEvent.id);
                    $('#intervento_id').val(calEvent.id).trigger("change");
                    $('#contratto').val(calEvent.contratto_id);
                    $('#listinoContratto').val(calEvent.listino_id).trigger('change.select2');
                    $('#attivita').val(calEvent.attivita_id).trigger('change.select2');
                    $('#consulente').val(calEvent.consulente_id).trigger('change.select2');
                    $('#data').val(calEvent.start.format('L'));
                    $('#ora_start').val(calEvent.start.format('HH:mm'));
                    $('#ora_end').val(calEvent.end.format('HH:mm'));
                },
                eventRender: function (event, element) {
                    element.find('.fc-title').append("<br/>" + event.description);
                }
            });
        }
        function createIntervento() {
            var postData = {};
            postData.contratto = $('#contratto').val();
            postData.listinoContratto = $('#listinoContratto').val();
            postData.attivita = $('#attivita').val();
            postData.consulente = $('#consulente').val();
            postData.data = $('#data').val();
            postData.ora_start = $('#ora_start').val();
            postData.ora_end = $('#ora_end').val();
            $.ajax({
                url: "/ajax/interventi/createIntervento",
                type: "POST",
                data: postData,
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    $('#calendar').fullCalendar('refetchEvents');
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
        function updateIntervento() {
            var postData = {};
            postData.id = $('#intervento_id').val().trigger("change");
            postData.contratto = $('#contratto').val();
            postData.listinoContratto = $('#listinoContratto').val();
            postData.attivita = $('#attivita').val();
            postData.consulente = $('#consulente').val();
            postData.data = $('#data').val();
            postData.ora_start = $('#ora_start').val();
            postData.ora_end = $('#ora_end').val();
            postData._method = 'PATCH';
            $.ajax({
                url: "/ajax/interventi/updateIntervento",
                type: "POST",
                data: postData,
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    $('#calendar').fullCalendar('refetchEvents');
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
        function updateProgettoSource() {
            $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?id=12');
            if ($('#progetto').val()) {
                $('#calendar').fullCalendar('addEventSource',
                        {
                            id: 'progettoEvents',
                            url: '/ajax/interventi/getCalendar?id=12',
                            type: 'GET',
                            data: {
                                progetto_id: globale_progetto
                            },
                            error: function () {
                                alert('there was an error while fetching events!');
                            },
                            color: 'red',   // a non-ajax option
                            textColor: 'black' // a non-ajax option
                        }
                )
            }
        }
        function updateConsulenteSource() {
            $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?id=1');
            $('#calendar').fullCalendar('addEventSource',
                    {
                        id: 'consulenteEvents',
                        url: '/ajax/interventi/getCalendar?id=1',
                        type: 'GET',
                        data: {
                            consulente_id: globale_consulente
                        },
                        error: function () {
                            alert('there was an error while fetching events!');
                        },
                        color: 'yellow',   // a non-ajax option
                        textColor: 'black' // a non-ajax option
                    }
            )
        }

        function annullaCreateIntervento() {
            $('#calendar').fullCalendar('removeEvents', 'new');
        }
        function deleteIntervento() {
            $.ajax({
                url: "/ajax/interventi/deleteIntervento",
                type: "POST",
                data: {_method: 'DELETE', id: $('#intervento_id').val()},
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    $('#calendar').fullCalendar('refetchEvents');
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
    </script>
@append
