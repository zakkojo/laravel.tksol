<div class="box box-primary">
    <div id="calendar"></div>
</div>

@section('page_scripts')
    <script>
        var globale_cliente;
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
                defaultView: 'agendaWeek',
                lang: 'it',
                columnFormat: 'ddd D/M',
                header: {
                    right: 'prev,next today',
                    center: 'title',
                    left: 'month,agendaWeek'
                },
                buttonText: {
                    today: 'Oggi',
                    month: 'Mese',
                    week: 'Settimana',
                    day: 'Giorno'
                },
                @if(isset($_REQUEST['data'])) defaultDate: moment('{{$_REQUEST['data']}}'), @endif
                editable: true,
                selectable: true,
                selectHelper: true,
                select: function (start, end, resource) {
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
                    if (calEvent.id != 'new') {
                        $('#form_title').text('Modifica Intervento');
                        $('#intervento_id').val(calEvent.id).trigger("change");
                        $('#contratto').val(calEvent.contratto_id);
                        $('#listinoContratto').val(calEvent.listino_id).trigger('change.select2');
                        $('#attivita').val(calEvent.attivita_id).trigger('change.select2');
                        $('#consulente').val(calEvent.consulente_id).trigger('change.select2');
                        $('#attivitaPianificate').html(calEvent.attivitaPianificate);
                        $('#data').val(calEvent.start.format('L'));
                        $('#ora_start').val(calEvent.start.format('HH:mm'));
                        $('#ora_end').val(calEvent.end.format('HH:mm'));
                    }
                },
                eventResize: function (event, delta, revertFunc) {
                    if (event.id == 'new') {
                        $('#ora_end').val(event.end.add(delta).format('HH:mm'));

                        eventData = {
                            id: 'new',
                            title: 'Nuovo Intervento',
                            start: event.start.format(),
                            end: event.end.format(),
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true);
                        $('#calendar').fullCalendar('unselect');
                    }
                    else {
                        $('#ora_end').val(event.end.format('HH:mm'));
                        //ACL
                        if (event.consulente_id == '{{Auth::User()->consulente->id}}')updateIntervento();
                        else revertFunc();
                    }
                },
                eventDragStart: function (calEvent, delta, revertFunc) {
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    if (calEvent.id != 'new') {
                        $('#form_title').text('Modifica Intervento ');
                        $('#intervento_id').val(calEvent.id).trigger("change");
                        $('#cliente').val(calEvent.cliente_id).trigger('change');
                        $('#cliente').val(calEvent.cliente_id).trigger('change.select2');
                        $('#contratto').val(calEvent.contratto_id);
                        $('#progetto').val(calEvent.progetto_id).trigger("change");
                        $('#listinoContratto').val(calEvent.listino_id).trigger('change.select2');
                        $('#attivita').val(calEvent.attivita_id).trigger('change.select2');
                        $('#consulente').val(calEvent.consulente_id).trigger('change.select2');
                        $('#attivitaPianificate').html(calEvent.attivitaPianificate);
                        $('#data').val(calEvent.start.format('L'));
                        $('#ora_start').val(calEvent.start.format('HH:mm'));
                        $('#ora_end').val(calEvent.end.format('HH:mm'));


                    }
                },
                eventDrop: function (event, delta, revertFunc) {
                    if (event.id == 'new') {
                        $('#data').val(event.start.add(delta).format('L'));
                        $('#ora_start').val(event.start.format('HH:mm'));
                        $('#ora_end').val(event.end.add(delta).format('HH:mm'));

                        eventData = {
                            id: 'new',
                            title: 'Nuovo Intervento',
                            start: event.start.format(),
                            end: event.end.format(),
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true);
                        $('#calendar').fullCalendar('unselect');
                    }
                    else {
                        $('#data').val(moment(event.start).format('L'));
                        $('#ora_start').val(event.start.format('HH:mm'));
                        $('#ora_end').val(event.end.format('HH:mm'));
                        //ACL
                        if (event.consulente_id == '{{Auth::User()->consulente->id}}')updateIntervento();
                        else revertFunc();
                    }
                },
                eventClick: function (calEvent, jsEvent, view) {
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    if (calEvent.id != 'new') {
                        if (calEvent.stampa == 0) {
                            var events = $("#calendar").fullCalendar('clientEvents', calEvent.id);
                            console.log(events.length);
                            events.forEach(function (event) {
                                event.backgroundColor = '#ffdf65';
                            });
                            $('#calendar').fullCalendar('rerenderEvents');

                            $('#form_title').text('Modifica Intervento ');
                            $('#intervento_id').val(calEvent.id).trigger("change");
                            $('#cliente').val(calEvent.cliente_id).trigger('change');
                            $('#cliente').val(calEvent.cliente_id).trigger('change.select2');
                            $('#contratto').val(calEvent.contratto_id);
                            $('#progetto').val(calEvent.progetto_id).trigger("change");
                            $('#listinoContratto').val(calEvent.listino_id).trigger('change.select2');
                            $('#attivita').val(calEvent.attivita_id).trigger('change.select2');
                            $('#consulente').val(calEvent.consulente_id).trigger('change.select2');
                            $('#attivitaPianificate').html(calEvent.attivitaPianificate);
                            $('#data').val(calEvent.start.format('L'));
                            $('#ora_start').val(calEvent.start.format('HH:mm'));
                            $('#ora_end').val(calEvent.end.format('HH:mm'));
                            //ACL
                            if (calEvent.consulente_id == '{{Auth::User()->consulente->id}}')
                                $('.btnModifica').removeClass('disabled');
                            else
                                $('.btnModifica').addClass('disabled');
                        }
                    }
                },
                eventRender: function (event, element) {
                    if (event.id != 'new') {
                        event.backgroundColor = event.color;
                        element.find('.fc-title').append("<br/>" + event.description);
                        element.find('.fc-title').append('<div onclick="openIntervento(' + event.id + ')" class="openIntervento btn-xs btn-flat btn-default" style="width:92%"><i class="fa fa-edit"></i> Dettagli</div>');
                    }
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
            postData.attivitaPianificate = $('#attivitaPianificate').html();
            postData.stampaIntervento = $('#stampaIntervento').val();
            postData.creatore_id = {{Auth::User()->consulente->id}};
            console.log(postData);
            $.ajax({
                url: "/ajax/interventi/createIntervento",
                type: "POST",
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
                alert("Request failed: " + data);
            });
        }
        function updateIntervento() {
            var postData = {};
            postData.id = $('#intervento_id').val();
            postData.contratto = $('#contratto').val();
            postData.listinoContratto = $('#listinoContratto').val();
            postData.attivita = $('#attivita').val();
            postData.consulente = $('#consulente').val();
            postData.data = $('#data').val();
            postData.ora_start = $('#ora_start').val();
            postData.ora_end = $('#ora_end').val();
            postData.attivitaPianificate = $('#attivitaPianificate').html();
            postData._method = 'PATCH';
            $.ajax({
                url: "/ajax/interventi/updateIntervento",
                type: "POST",
                data: postData,
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    //$('#calendar').fullCalendar('refetchEvents');
                    $('#calendar').fullCalendar('removeEvents', 'new');
                    var events = $("#calendar").fullCalendar('clientEvents', $('#intervento_id').val());
                    console.log(events.length);
                    events.forEach(function (event) {
                        event.backgroundColor = '#ffdf65';
                    });
                    $('#calendar').fullCalendar('rerenderEvents');
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
        function updateProgettoSource(cliente_id, bgcolor) {
            $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?id=' + cliente_id);
            $('#calendar').fullCalendar('addEventSource',
                    {
                        id: cliente_id,
                        url: '/ajax/interventi/getCalendar?id=' + cliente_id,
                        type: 'GET',
                        data: {
                            cliente_id: parseInt(cliente_id) - 2000,
                        },
                        error: function () {
                            alert('there was an error while fetching events!');
                        },
                        color: bgcolor,   // a non-ajax option
                        textColor: 'black' // a non-ajax option
                    }
            )
        }
        function updateConsulenteSource(consulente_id, bgcolor) {
            $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?id=' + consulente_id);
            $('#calendar').fullCalendar('addEventSource',
                    {
                        id: consulente_id,
                        url: '/ajax/interventi/getCalendar?id=' + consulente_id,
                        type: 'GET',
                        data: {
                            consulente_id: parseInt(consulente_id) - 1000
                        },
                        error: function () {
                            alert('there was an error while fetching events!');
                        },
                        color: bgcolor,   // a non-ajax option
                        textColor: 'black' // a non-ajax option
                    }
            )
        }
        function updateConsuntivoSource() {
            $('#calendar').fullCalendar('removeEventSource', '/ajax/interventi/getCalendar?id=' + parseInt(cliente_id) - 2000 + 9000);
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
