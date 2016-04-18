<div class="box box-primary">
    <div id="calendar"></div>
</div>
@section('page_scripts')
    <script>
    function drawCalendar() {
        var $progetto = $('#progetto').val();
        $('#calendar').fullCalendar({
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
            eventSources: [
                {
                    url: '/ajax/interventi/getCalendar',
                    type: 'GET',
                    data: {
                        consulente_id: $('#consulente').val()
                    },
                    error: function(data) {
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
                    error: function(){
                        //alert('there was an error while fetching events!');
                    },
                    color: 'red',   // a non-ajax option
                    textColor: 'black' // a non-ajax option
                }
            ],
            dayClick: function(date, jsEvent, view) {
                $('#form_title').text('Nuovo in data:'+date);
                $('#calendar').fullCalendar( 'refetchEvents' );
            }
        });
    }
    </script>
@append
