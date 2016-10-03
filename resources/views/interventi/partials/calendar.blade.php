<div class="box box-primary">
    <div id="calendar"></div>
</div>

@section('page_scripts')
    <script>
        var globale_intervento = {'loading': 0};
        function drawCalendar() {
            $('#calendar').fullCalendar({
                allDaySlot: false,
                firstHour: 8,
                slotMinutes: 30,
                slotLabelFormat: 'HH:mm',
                timeFormat: 'H:mm',
                defaultView: 'agendaWeek',
                locale: 'it',
                columnFormat: 'ddd D/M',
                agendaWeek: {
                    columnFormat: 'ddd D/M',
                },
                header: {
                    right: 'prev,next today',
                    center: 'title',
                    left: 'month,agendaWeek,listMonth'
                },
                buttonText: {
                    today: 'Oggi',
                    month: 'Mese',
                    week: 'Settimana',
                    listMonth: 'Agenda'
                },
                @if(isset($_REQUEST['data'])) defaultDate: moment('{{$_REQUEST['data']}}'), @endif
                editable: true,
                selectable: true,
                selectHelper: true,
                loading: function (isLoading, view) {
                    if (isLoading) {
                    } else {
                        $('#calendar').fullCalendar('rerenderEvents');
                    }
                },
                select: function (start, end, resource) {
                    if(moment().isSameOrBefore(start, 'day')) {
                        $('#calendar').fullCalendar('removeEvents', 'new');
                        $('#form_title').text('Pianifica Nuovo Intervento');
                        $('#intervento_id').val('').trigger("change");
                        $('#attivitaPianificate').html('{!! session()->get('attivita')!!}');
                        $('#data').val(moment(start).format('L'));
                        if (moment(start).format('HHmm') == '0000') {
                            ora_start = moment(start).add('9', 'h');
                            ora_end = moment(start).add('18', 'h');
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
                    }
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
                eventResize: function (event, delta, revertFunc) {
                    if (event.id == 'new') {
                        $('#ora_end').val(event.end.format('HH:mm'));
                    }
                    else {
                        //ACL
                        globale_intervento.func = function () {
                            return updateIntervento();
                        };
                        loadIntervento(event, function () {
                            $('#ora_end').val(event.end.format('HH:mm'));
                        });
                        if (!(event.user_id === '{{Auth::User()->id}}')) {
                            globale_intervento = {'loading': 0};
                            revertFunc();
                        }
                    }
                },
                eventDragStart: function (calEvent, delta, revertFunc) {
                    if (calEvent.id != 'new') {
                        //$('#calendar').fullCalendar('removeEvents', 'new');
                        $('#form_title').text('Modifica Intervento ');
                        $('#intervento_id').val(calEvent.id).trigger("change");
                        $('#cliente').val(calEvent.cliente_id).trigger('change');
                        $('#cliente').val(calEvent.cliente_id).trigger('change.select2');
                        $('#contratto').val(calEvent.contratto_id);
                        $('#progetto').val(calEvent.progetto_id).trigger("change");
                        $('#listinoContratto').val(calEvent.listino_id).trigger('change.select2');
                        $('#attivita').val(calEvent.attivita_id).trigger('change.select2');
                        $('#consulente').val(calEvent.user_id).trigger('change.select2');
                        $('#attivitaPianificate').html(calEvent.attivitaPianificate);
                        $('#data').val(calEvent.start.format('L'));
                        $('#ora_start').val(calEvent.start.format('HH:mm'));
                        $('#ora_end').val(calEvent.end.format('HH:mm'));
                    }
                },
                eventDrop: function (event, delta, revertFunc) {
                    if (event.id == 'new') {
                        $('#data').val(event.start.format('L'));
                        $('#ora_start').val(event.start.format('HH:mm'));
                        $('#ora_end').val(event.end.format('HH:mm'));
                        $('#calendar').fullCalendar('unselect');
                    }
                    else {
                        console.log(moment(event.start).diff(moment(), 'days'));
                        if (event.user_id == '{{Auth::User()->id}}' && moment(event.start).diff(moment(), 'days') >= 0) {
                            globale_intervento.func = function () {
                                return updateIntervento();
                            };
                            loadIntervento(event, function () {
                                $('#data').val(moment(event.start).format('L'));
                                $('#ora_start').val(event.start.format('HH:mm'));
                                $('#ora_end').val(event.end.format('HH:mm'));
                            });
                        }
                        else {
                            globale_intervento = {'loading': 0};
                            revertFunc();
                        }
                    }
                },
                eventClick: function (calEvent, jsEvent, view) {
                    //console.log(calEvent);
                    //$('#calendar').fullCalendar('rerenderEvent');
                    //se l'evento non è NEW e non sono in fase di pianificazione prossimo intervento
                    if (calEvent.id != 'new' && $('#stampaIntervento').val() == 0) {
                        $('#calendar').fullCalendar('removeEvents', 'new');
                        if (calEvent.stampa == 0) {
                            var events = $("#calendar").fullCalendar('clientEvents', calEvent.id);
                            events.forEach(function (event) {
                                event.backgroundColor = '#ffdf65';
                            });
                            $('#calendar').fullCalendar('rerenderEvents');

                            $('#form_title').text('Modifica Intervento ');
                            $('.btnModifica').addClass('disabled');
                            loadIntervento(calEvent);
                        }
                    }
                },
                eventRender: function (event, element) {
                    if (event.id !== undefined && event.id != 'new') {
                        event.backgroundColor = event.color;
                        element.find('.fc-title').append("<br/>" + event.description);
                        element.find('.fc-title').append('<div onclick="openIntervento(' + event.id + ')" class="openIntervento btn-xs btn-flat btn-default" style="width:92%"><i class="fa fa-edit"></i> Dettagli</div>');
                        if (event.id != '' && event.id == searchParams.get('eventId')) {
                            event.backgroundColor = '#ffdf65';
                            loadIntervento(event)
                            searchParams.delete('eventId');
                        }
                    }
                },
            });
        }


        function loadIntervento(calEvent, onEnd) {
            onEnd = onEnd || function () {
                    };
            globale_intervento.loading = 1;
            //caricamento dati da fare in ajax
            $.ajax({
                url: "/ajax/interventi/getIntervento",
                type: "GET",
                data: {id: calEvent.id},
                dataType: "JSON",
            }).done(function (data) {
                if (data['status'] == 'success') {
                    var intervento = data['intervento'];
                    $('#attivitaPianificate').html(intervento.attivitaPianificate);
                    $('#data').val(moment(intervento.data_start).format('L'));
                    $('#ora_start').val(moment(intervento.data_start).format('HH:mm'));
                    $('#ora_end').val(moment(intervento.data_end).format('HH:mm'));

                    globale_intervento.cliente_id = intervento.cliente_id;
                    globale_intervento.progetto_id = intervento.progetto_id;
                    globale_intervento.contratto_id = intervento.contratto_id;
                    globale_intervento.attivita_id = intervento.attivita_id;
                    globale_intervento.listino_id = intervento.listino_id;

                    $('#intervento_id').val(intervento.id).trigger("change");
                    $('#cliente').val(intervento.cliente_id).trigger('change.select2');
                    $('#cliente').trigger("change");

                    //ACL - solo l'utente incaricato può moidificare l'intervento
                    if (intervento.user_id == parseInt('{{Auth::User()->id}}'))
                        $('.btnModifica').removeClass('disabled');
                    onEnd();
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus, data) {
                console.log("Request failed: " + data);
            });
        }
        ;

        function createIntervento() {
            var postData = {};
            postData.contratto = $('#contratto').val();
            postData.listinoContratto = $('#listinoContratto').val();
            postData.attivita = $('#attivita').val();
            postData.user_id = $('#consulente').val();
            postData.data = $('#data').val();
            postData.ora_start = $('#ora_start').val();
            postData.ora_end = $('#ora_end').val();
            postData.attivitaPianificate = $('#attivitaPianificate').html();
            postData.stampaIntervento = $('#stampaIntervento').val();
            postData.user_id_modifica = {{Auth::User()->consulente->id}};
            console.log(postData);
            $.ajax({
                url: "/ajax/interventi/createIntervento",
                type: "GET",
                data: postData,
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    console.log(data);
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    $('#calendar').fullCalendar('refetchEvents');
                    if (data['action'] == 'stampa') window.location.href = '/interventi/' + data['id_padre'];
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus, data) {
                console.log("Request failed: " + data);
            });
        }

        function updateIntervento() {
            console.log('update fired');
            var postData = {};
            postData.id = $('#intervento_id').val();
            postData.contratto = $('#contratto').val();
            postData.listinoContratto = $('#listinoContratto').val();
            postData.attivita = $('#attivita').val();
            postData.user_id = $('#consulente').val();
            postData.data = $('#data').val();
            postData.ora_start = $('#ora_start').val();
            postData.ora_end = $('#ora_end').val();
            postData.attivitaPianificate = $('#attivitaPianificate').html();
            //postData._method = 'PATCH';
            $.ajax({
                url: "/ajax/interventi/updateIntervento",
                type: "GET",
                data: postData,
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    console.log(data.input);
                    //$('#calendar').fullCalendar('refetchEvents');
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    var events = $("#calendar").fullCalendar('clientEvents', $('#intervento_id').val());
                    events.forEach(function (event) {
                        event.backgroundColor = '#ffdf65';
                    });
                    console.log('update');
                    $('#calendar').fullCalendar('rerenderEvents');
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }

        function updateClienteSource(cliente_id, bgcolor) {
            $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?calendar_id=' + 'cliente_' + cliente_id);
            $('#calendar').fullCalendar('addEventSource',
                    {
                        id: cliente_id,
                        url: '/ajax/interventi/getCalendar?calendar_id=' + 'cliente_' + cliente_id,
                        type: 'GET',
                        data: {
                            cliente_id: parseInt(cliente_id),
                        },
                        error: function () {
                            console.log('there was an error while fetching clienti!');
                        },
                        color: bgcolor,   // a non-ajax option
                        textColor: 'black' // a non-ajax option
                    }
            )
        }

        function updateConsulenteSource(user_id, bgcolor) {
            $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?calendar_id=' + 'consulente_' + user_id);
            $('#calendar').fullCalendar('addEventSource',
                    {
                        id: 'consulente_' + user_id,
                        user_id: user_id,
                        url: '/ajax/interventi/getCalendar?calendar_id=' + 'consulente_' + user_id,
                        type: 'GET',
                        data: {
                            user_id: parseInt(user_id)
                        },
                        error: function () {
                            console.log('there was an error while fetching consulenti!');
                        },
                        color: bgcolor,   // a non-ajax option
                        textColor: 'black' // a non-ajax option
                    }
            )
        }

        function updateConsuntivoSource() {
            $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?calendar_id=' + 'consulente_' + user_id);
            if ($('#progetto').val()) {
                $('#calendar').fullCalendar('addEventSource',
                        {
                            id: 'consuntivoEvents',
                            url: '/ajax/interventi/getCalendar?id=' + parseInt(cliente_id) - 2000 + 9000,
                            type: 'GET',
                            data: {
                                cliente_id: parseInt(cliente_id) - 2000,
                                stampa: 1
                            },
                            error: function () {
                                alert('there was an error while fetching events!');
                            },
                            color: '#EAAFB0',   // a non-ajax option
                            textColor: '#777777',
                            editable: false
                        }
                )
            }
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

        function openIntervento(id) {
            window.open('/interventi/' + id + '/edit', '_self');
        }
    </script>
@append
