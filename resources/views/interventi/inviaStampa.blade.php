@extends('layouts.app')


@section('htmlheader_title')
    Stampa Intervento
@endsection
@section('contentheader_title')
    Stampa Intervento
@endsection
@section('contentheader_breadcrumb')
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 id="form_title" class="box-title">Consulente</h3>
                </div>
                <div class="box-body">
                    <ul class="list-group" id="contact-list">
                        <li class="list-group-item">
                            <div class="col-xs-12 col-sm-1">
                                <div class="icheckbox_flat-green" style="margin:20px 2px 0 -10px"><input
                                            name="fatturabile" type="checkbox" class="flat-red"
                                            value="{{$intervento->listinoInterventi->contratto->cliente->email}}"
                                            style="position: absolute; opacity: 0;">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                <span><b>{{$intervento->listinoInterventi->contratto->cliente->ragione_sociale}}</b></span><br/>
                                <span class="name">{{$intervento->listinoInterventi->contratto->cliente->email}}</span><br/>
                                <span class="name">{{$intervento->listinoInterventi->contratto->cliente->indirizzo}}
                                    , {{$intervento->listinoInterventi->contratto->cliente->citta}}
                                    , {{$intervento->listinoInterventi->contratto->cliente->cap}}</span><br/>
                                <!--span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip"
                                      title="5842 Hillcrest Rd"></span>
                                <span class="visible-xs"> <span class="text-muted">5842 Hillcrest Rd</span><br/></span-->
                            </div>
                            <div class="col-xs-12 col-sm-2" style="padding-right:0">
                                <img src="/img/azienda-placeholder.png" class="img-responsive img-circle"
                                     alt="User Image" style="width:65px;height:65px;">
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        @foreach($intervento->listinoInterventi->contratto->cliente->rubrica as $contatto)
                            <li class="list-group-item">
                                <div class="col-xs-12 col-sm-1">
                                    <div class="icheckbox_flat-green" style="margin:20px 2px 0 -10px"><input
                                                name="fatturabile" type="checkbox" class="flat-red"
                                                value="{{$contatto->userEmail}}" style="position: absolute; opacity: 0;">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-9">
                                    <span><b>{{$contatto->descrizione}}</b></span><br/>
                                    <span class="name">{{$contatto->userEmail}}</span><br/>
                                    <span class="name">{{$contatto->indirizzo}}, {{$contatto->citta}}
                                        , {{$contatto->cap}}</span><br/>
                                </div>
                                <div class="col-xs-12 col-sm-2" style="padding-right:0">
                                    <img src="/img/user-placeholder.png" class="img-responsive img-circle"
                                         alt="User Image" style="width:65px;height:65px;">
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="box-footer">
                    <div id="inviaBtn" type="Modifica" onclick="inviaRapportino()" class="btn  btn-primary"><i
                                class="fa fa-envelope"></i>&nbsp; Invia Email
                    </div>
                    <span id="invioOK" style="display:none" class="label label-success"><i class="fa fa-check"></i> Inviato</span>
                    <span id="invioKO" style="display:none" class="label label-danger"><i class="fa fa-remove"></i> Errore</span>
                </div>
            </div>
        </div>
        <div class="col-md-8 embed-responsive embed-responsive-16by9" style="margin-top:-55px;padding-bottom:49%">
            <embed class="embed-responsive-item" width="100%"
                   src="{{action('InterventoController@stampa',$intervento->id)}}" name="plugin" type="application/pdf"
                   internalinstanceid="5" title="">
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        var winH = 955;
        var divH = 828;
        var NwinH;
        var NdivH;
        $(document).ready(function () {
            NwinH = $(window).height();
            NdivH = NwinH * divH / winH;
            $('.embed-responsive-16by9').css('padding-bottom', NdivH + 'px');
        });
        $(window).resize(function () {
            NwinH = $(window).height();
            NdivH = NwinH * divH / winH;
            $('.embed-responsive-16by9').css('padding-bottom', NdivH + 'px');
        });

        function inviaRapportino() {
            $('#inviaBtn').attr("disabled","disabled");
            var emails = $("input:checkbox:checked").map(function () {
                if ($(this).val() != 'on') return $(this).val();
            }).get();
            console.log(emails);
            $.ajax({
                url: "{{action('InterventoController@invia',$intervento->id)}}",
                type: "get",
                data: {recipients: emails, invia:1},
                dataType: "JSON"
            }).done(function (data) {
                if (data['status'] == 'success') {
                    $("#invioOK").fadeIn().delay(5000).fadeOut();
                }
                else {
                    console.log(['Errore!!', data]);
                    $("#invioKO").fadeIn().delay(5000).fadeOut();
                }
            }).fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
                $("#invioKO").fadeIn().delay(5000).fadeOut();
            }).always(function () {
                $('#inviaBtn').attr("disabled",false);
            });
        }


    </script>
@endsection
