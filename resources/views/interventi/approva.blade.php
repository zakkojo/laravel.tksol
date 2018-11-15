@extends('layouts.app')


@section('htmlheader_title')
    Approvazione Fatturazione
@endsection
@section('contentheader_title')
    Approvazione Fatturazione
@endsection
@section('contentheader_breadcrumb')
@endsection
@section('main-content')
    <style>
        * {
            font-family: Calibri;
        }

        table#tRDAlist {
            border-collapse: collapse;
            border: 0pt solid grey;
        }

        table#tRDAlist th {
            font-size: 10pt;
            color: white;
            background-color: #4f8fb5;
            padding: 3pt;
            border: 1pt solid grey;
        }

        table#tRDAlist td {
            font-size: 10pt;
            border: 1pt solid grey;
            padding: 5pt;
        }

        table#tRDAlist tr:nth-child(even) {
            background-color: #f0f0f0;
        }

        table#tRDAlist tr:nth-child(odd) {
            background-color: white;
        }

        .importo, .numero {
            text-align: right;
        }

        input[type=checkbox] {
            width: 22px;
            height: 22px;
            cursor: hand;
        }

        div.rdaHEAD {
        }

        .rdaHEAD div {
            display: inline;
        }

        #selezione {
            text-align: left;
            border: 0pt;
            font-size: 12pt;
            width: 50px;
            background: transparent;
        }

        #tRDAlist tr:hover {
            background-color: rgb(204, 230, 255);
        }

        #tRDAlist tr.sel {
            color: blue;
        }

        #dRDAlist {
            height: 90%;
            overflow-Y: auto;
        }

        td.textarea {
            padding: 3px 1px 0 1px !important;
        }

        textarea.textarea {
            height: 100%;
            width: 200px;
            font-size: 12px;
            line-height: 12px;
        }
    </style>

    <div class='rdaHEAD'>
        <div>Filtro: <input size='30' type='text' id='filtro'></div>
        <div>Da: <input size='10' type='text' id='di' class="datepicker"></div>
        <div>A: <input size='10' type='text' id='df' class="datepicker"></div>
        <div>Righe selezionate: <input id="selezione" readonly value=''/></div>
        <div>Valutazione:
            <input type='button' class="btn btn-success" onclick='autorizza();' value='Si autorizza'/>
            <!--input type='button' class="btn btn-danger" onclick='rifiuta();' value='Si rifiuta'/-->
        </div>
    </div>

    <div id='dRDAlist'>
        @if($daApprovare)
            <table id='tRDAlist'>
                <thead>
                <tr>
                    <th style='padding:1pt'><input id='selezionaTutti' type='checkbox'></th>
                    <th>Data Intervento</th>
                    <th>Consulente</th>
                    <th>Cliente</th>
                    <th>Link</th>
                    <th>Progetto</th>
                    <th>Attività</th>
                    <th>Listino</th>
                    <th>Ore Lavorate</th>
                    <th>Fatturabile</th>
                    <th style="width:70px">Approvate</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tobody>
                    <?php $tabindex = 10 ?>
                    @foreach($daApprovare as $intervento)
                        <?php $tabindex++ ?>
                        <tr class='intervento' data-id_intervento='{{$intervento->id}}'>
                            <td style='padding:1pt'><input name='selettoreRDA' type='checkbox'></td>
                            <td class="date">{{$intervento->data}}</td>
                            <td>{{$intervento->user->consulente->nominativo}}</td>
                            <td>{{$intervento->contratto->cliente->ragione_sociale}}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                    <button type="button" class="btn btn-default"
                                            onClick="location.href='{{ action('InterventoController@show',$intervento->id) }}'"
                                            title="Visualizza Intervento">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                    <button type="button" class="btn btn-default"
                                            onClick="window.open('{{action('InterventoController@stampa',$intervento->id)}}','_blank', 'height=800,width=600')"
                                            title="Apri Rapportino">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </button>
                                </div>
                            </td>
                            <td>{{$intervento->contratto->progetto->nome}}</td>
                            <td>{{$intervento->attivita->descrizione}}</td>
                            <td>{{$intervento->listinoInterventi_wt->descrizione}}</td>
                            <td class="ore_lavorate">{{$intervento->ore_lavorate}}</td>
                            <td class="fatturabile">
                                @if($intervento->fatturabile == 1)
                                    <span class="fa fa-check fa-lg" data-id_intervento='{{$intervento->id}}'
                                          style="color: green; text-align:center; width:100%;"></span>
                                @else
                                    <span class="fa fa-times fa-lg" data-id_intervento='{{$intervento->id}}'
                                          style="color: darkred;text-align:center; width:100%;"></span>
                                @endif
                            </td>
                            <td>
                                <input name='valoreRDA' type='text' tabindex="{{$tabindex}}" style="width:55px"
                                       {{--value='@if($intervento->approvato == 1){{$intervento->ore_fatturate}}@endif @if($intervento->fatturabile == 0) 0 @endif'--}}value="{{$intervento->ore_fatturate}}"
                                       data-id_intervento='{{$intervento->id}}'>
                                <span class="invioOK label label-success" style="display:none"><i
                                            class="fa fa-check"></i> </span>
                                <span class="invioKO label label-danger" style="display:none"><i
                                            class="fa fa-remove"></i> </span>
                            </td>
                            <td class="textarea">
                                <textarea class="noteFattura textarea" name='noteFattura' tabindex="{{$tabindex+10000}}"
                                          data-id_intervento='{{$intervento->id}}'>{{$intervento->note_fattura}}</textarea>
                            </td>
                        </tr>
                    @endforeach
                </tobody>
            </table>
        @else
            <a>Nessun Intervento da approvare.</a>
        @endif
    </div>
@endsection
@section('page_scripts')
    <script>
        $(function () {
            calcolaTotale();
        });
        $("input[name='valoreRDA']").on('keyup',function (e) {
            var $prima = $(this).val();
            $(this).val($prima.replace(/[^\d.]/g, ''));
            if (e.keyCode != 9) {
                autoSave($(this).attr('data-id_intervento'));
            }
        });
        $("textarea[name='noteFattura']").on('keyup',function (e) {
            if (e.keyCode != 9) {
                autoSave($(this).attr('data-id_intervento'));
            }
        });
        function autoSave(id_intervento) {
            clearTimeout($.data(this, 'timer'));
            var wait = setTimeout(approvaRiga, 5000, id_intervento, 0);
            $(this).data('timer', wait);
        }

        function approvaRiga(id, approva, reset) {
            //SALVA RIGA
            reset = reset || 0;
            if (reset == 0) {
                var ore_approvate = $(".intervento[data-id_intervento='" + id + "']").find("input[name='valoreRDA']").val();
                var noteFattura = $(".intervento[data-id_intervento='" + id + "']").find(".noteFattura").val();
                var fatturabile;
                if ($(".intervento[data-id_intervento='" + id + "']").find('.fatturabile').find('span').hasClass('fa-check'))
                    fatturabile = 1;
                else
                    fatturabile = 0;
            }
            else
                var ore_approvate = '';

            //alert('id:' + id + ' ore:' + ore_approvate);
            $.ajax({
                url: "/ajax/interventi/approvaIntervento",
                type: "GET",
                data: {
                    id: id,
                    approva: approva,
                    ore_approvate: ore_approvate,
                    fatturabile: fatturabile,
                    noteFattura: noteFattura
                },
                dataType: "JSON",
            }).done(function (data) {
                if (data.status == 'success') {
                    console.log(data.ore + ' ore approvate per intervento id:' + data.id);
                    //$("input[data-id_intervento='" + data.id + "']").siblings(".invioOK").fadeIn().delay(5000).fadeOut();
                    $('tr[data-id_intervento="' + data.id + '"]').effect('highlight',{'color':'#7beba3'},1000);
                }
                else {
                    console.log('ERRORE: salvataggio ore approvate intervento ' + data.id);
                    //$("input[data-id_intervento='" + data.id + "']").siblings(".invioKO").fadeIn().delay(5000).fadeOut();
                    $('tr[data-id_intervento="' + data.id + '"]').effect('highlight',{'color':'#ff8080'},1000);
                }
            }).fail(function (jqXHR, textStatus, data) {
                console.log("Request failed: " + data);
            });
        }

        $('.datepicker').on('changeDate', function () {
            $("#filtro").keyup();
        });

        $('.fatturabile').on('click', 'span', function () {
            var $ore_input = $(this).parent().parent().find("td > input[name='valoreRDA']");
            var ore_lavorate = $(this).parent().parent().find("td.ore_lavorate").text();
            if ($(this).hasClass('fa-check')) {
                $(this).removeClass('fa-check').addClass('fa-times').attr('style', 'color: darkred; text-align:center; width:100%;');
                $ore_input.val(0);
            }
            else if ($(this).hasClass('fa-times')) {
                $(this).removeClass('fa-times').addClass('fa-check').attr('style', 'color: green; text-align:center; width:100%;');
                $ore_input.val(ore_lavorate);
            }
            autoSave($(this).attr('data-id_intervento'));
        });

        $("#filtro").keyup(function () {
            var i = 0;
            $("table#tRDAlist").find('tr').each(function () {
                i++;
                var x = false;
                var datechk = false;
                if ($(this).children('th').length == 0) {
                    //se checkato mantieni visibile
                    if ($(this).find("input[name='selettoreRDA']").iCheck('update')[0].checked) x = true;
                    //altrimenti verifica testo e data
                    else {
                        if ($('#di').val()) di = moment($('#di').val(), 'DD/MM/YYYY');
                        else di = moment('2000-01-01');
                        if ($('#df').val()) df = moment($('#df').val(), 'DD/MM/YYYY');
                        else df = moment('2900-01-01');
                        $(this).find('td').each(function () {
                            var el = $(this);
                            if (el.hasClass('date')) {
                                eldt = moment(el.text(), 'DD/MM/YYYY');
                                if (eldt.isSameOrAfter(di) & eldt.isSameOrBefore(df)) datechk = true;
                            }
                            if (datechk) {
                                var str = el.text();
                                str = str.toLowerCase();
                                var n = str.indexOf($("#filtro").val().toLowerCase());
                                if (n != -1) x = x || true;
                            }
                            else x = false;
                        })
                    }
                    //rendi visibile o nascondi di conseguenza
                    if (x) $(this).show(); else $(this).hide();
                }
            })
        });


        $('#selezionaTutti').on('ifChecked', function () {
            $("input[name='selettoreRDA']:visible").not(this).iCheck('check');//.prop('checked', this.checked);
            calcolaTotale();
        });
        $('#selezionaTutti').on('ifUnchecked', function () {
            $("input[name='selettoreRDA']:visible").not(this).iCheck('uncheck');//.prop('checked', this.checked);
            calcolaTotale();
        });

        $("input[name='selettoreRDA']").on('ifChanged', function () {
            calcolaTotale();
        });

        function calcolaTotale() {
            var v = 0;
            var r = 0;
            var rT = 0;

            $("input[name='selettoreRDA']").each(function () {
                //$(this).parent().parent().removeClass('sel');
                rT++;
            });

            $("input[name='selettoreRDA']:checkbox:checked").each(function () {
                //v = v + parseFloat($(this).attr('valore'));
                r++;
                //$(this).parent().parent().addClass('sel');
            });
            //v = Math.round(v * 100) / 100;
            //$("#vTotale").val(number_format(v, 2, ",", ".", "\u20AC"));
            $("#vRighe").val(number_format(r, 0, ",", ".", "") + " / " + number_format(rT, 0, ",", ".", ""));
        }


        function number_format(number, decimals, dec_point, thousands_sep, prefix) {
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                toFixedFix = function (n, prec) {
                    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                    var k = Math.pow(10, prec);
                    return Math.round(n * k) / k;
                },
                s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            if (prefix) prefix = prefix + " "; else prefix = "";
            return prefix + s.join(dec);
        }
        function autorizza() {
            $("input[name='selettoreRDA']:checkbox:checked").each(function () {
                if ($(this).closest('.intervento').find("input[name='valoreRDA']").val() == '')
                    $(this).closest('.intervento').find("input[name='valoreRDA']").val($(this).closest('.intervento').find(".ore_lavorate").text());
                approvaRiga($(this).closest('.intervento').attr('data-id_intervento'), 1);
            });
        }

        function rifiuta() {
            $("input[name='selettoreRDA']:checkbox:checked").each(function () {
                $(this).closest('.intervento').find("input[name='valoreRDA']").val('');
                approvaRiga($(this).closest('.intervento').attr('data-id_intervento'));
            });
        }
    </script>
@endsection

