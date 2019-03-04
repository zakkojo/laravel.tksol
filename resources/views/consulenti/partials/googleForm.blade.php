<div class="box-body">
    <img src="{{$consulente->user->googleAvatarOriginal ?: '/img/user-placeholder.png'}}" height="200" width="200"
         class="img-responsive center-block img-thumbnail img-circle" alt="Immagine Accout">
</div><!-- /.box-body -->
<div class="row">
    @if($consulente->user->googleAccount)
        <div class="col-md-12">
            <div class="login-logo" style="font-size:30px; color:#808080">
                {{$consulente->user->googleAccount}}
            </div>
        </div>
    @endif
    <div class="col-md-offset-3 col-md-6">
        @if($consulente->user->googleAccount)
            <div class="social-auth-links text-center">
                <a href="{{ url('/unlinkGoogle') }}" class="btn btn-block btn-social btn-primary btn-flat"
                   style="background-color: #4285F4"><i class="fab fa-google"></i> Scollega il tuo account
                    Google</a>
            </div>
        @else
            <div class="social-auth-links text-center">
                <a href="{{ url('/linkGoogle') }}" class="btn btn-block btn-social btn-primary btn-flat"
                   style="background-color: #4285F4"><i class="fab fa-google"></i> Accedi con il tuo account Google</a>
            </div>
        @endif
    </div>
</div>
@if($consulente->user->googleAccount == 'x')
    <div class="row">
        <div class="col-md-12">
            @if($consulente->user->googleCalendarAppuntamenti == null)
                <button onclick="shareCalendar({{$consulente->user->id}})" class="btn btn-primary">
                    Condividi Calendario
                </button>
            @else
                <button class="btn btn-primary">
                    Rimuovi Condivisione Calendario Appuntamenti
                </button>
            @endif
        </div>
    </div>
@endif

@section('page_scripts')
    <script>
        function shareCalendar(id) {
            var request = $.ajax({
                url: "/ajax/toggleUser",
                type: "post",
                data: {'tipo_utente': 1, 'id': id},
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                    else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                    console.log(data['msg']);
                }
                else if (data['status'] == 'warning') {

                    if ($('#consulente_' + id).hasClass('btn-primary')) $('#consulente_' + id).removeClass('btn-primary').addClass('btn-default');
                    else $('#consulente_' + id).removeClass('btn-default').addClass('btn-primary');
                    alert(data.msg.replace(/(?:\\r\\n|\\r|\\n)/g, '\n'));
                    console.log(['Warning!', data]);
                }
                else console.log(['Errore!!', data]);
            }).fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        }
    </script>
@endsection