@extends('layouts.app')


@section('htmlheader_title')
    Registrazione Fatture
@endsection
@section('contentheader_title')
    Registrazione Fatture
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
            border: 1pt solid grey;
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
            border: 0pt solid grey;
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
        <div>Righe selezionate: <input id="selezione" readonly value='0'/></div>
        <div>Valutazione:
           
        </div>
    </div>

    <div id='dRDAlist'>
        @if($daFatturare)
            <table id='tRDAlist'>
                <thead>
                <tr>
                    <th style='padding:1pt'><input id='selezionaTutti' type='checkbox'></th>
                    <th>Data Intervento</th>
                    <th>Consulente</th>
                    <th>Link</th>
                    <th>Società</th>
                    <th>Progetto</th>
                    <th>Cliente</th>
                    <th>Destinazione Fattura</th>
                    <th>Ore</th>
                    <th>Sede</th>
                    <th>n° Fattura</th>
                    <th>Data Fattura</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tobody>
                    @foreach($daFatturare as $intervento)
                        <tr class='intervento' data-id_intervento='{{$intervento->id}}'>
                            <td style='padding:1pt'><input name='selettoreRDA' type='checkbox'></td>
                            <td class="date">{{$intervento->data}}</td>
                            <td>{{$intervento->user->consulente->nominativo}}</td>
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
                            <td>{{$intervento->contratto->societa->nome}}</td>
                            <td>{{$intervento->contratto->progetto->nome}}</td>
                            <td>{{$intervento->contratto->cliente->ragione_sociale}}</td>
                            <td>@if($intervento->contratto->fatturazione) {{$intervento->contratto->fatturazione->ragione_sociale}}
                                @else {{$intervento->contratto->societa->nome}}
                                @endif
                            </td>
                            <td class="ore_lavorate">{{$intervento->ore_lavorate}}</td>
                            <td>{{$intervento->sede}}</td>
                            <td>
                                <input name='nFattura' size="12" type='text' value='{{$intervento->fatturato}}'
                                       data-id_intervento='{{$intervento->id}}'>
                            </td>
                            <td>
                                <input name='dataFattura' class="datepicker" size="8" type='text'
                                       value='{{$intervento->data_fattura}}' data-id_intervento='{{$intervento->id}}'>
                            </td>

                            <td class="textarea">
                                <textarea class="textarea" name='noteFattura' value='{{$intervento->note_fattura}}'
                                          data-id_intervento='{{$intervento->id}}'>
                                </textarea>
                                <span class="invioOK label label-success" style="display:none"><i
                                            class="fa fa-check"></i> </span>
                                <span class="invioKO label label-danger" style="display:none"><i
                                            class="fa fa-remove"></i> </span>
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
        $(function() {
            calcolaTotale();
        });

        $("input[name='valoreRDA']").keyup(function () {
            var $prima = $(this).val();
            $(this).val($prima.replace(/[^\d.]/g, ''));
            clearTimeout($.data(this, 'timer'));
            var wait = setTimeout(approvaRiga, 1500, $(this).attr('data-id_intervento'));
            $(this).data('timer', wait);
        });

        function approvaRiga(id, reset) {
            //SALVA RIGA
            reset = reset || 0;
            if (reset == 0)
                var ore_approvate = $(".intervento[data-id_intervento='" + id + "']").find("input[name='valoreRDA']").val();
            else
                var ore_approvate = '';
            //alert('id:' + id + ' ore:' + ore_approvate);
            $.ajax({
                url: "/ajax/interventi/approvaIntervento",
                type: "GET",
                data: {id: id, ore_approvate: ore_approvate},
                dataType: "JSON",
            }).done(function (data) {
                if (data.status == 'success') {
                    console.log(data.ore + ' ore approvate per intervento id:' + data.id);
                    $("input[data-id_intervento='" + data.id + "']").siblings(".invioOK").fadeIn().delay(5000).fadeOut();
                }
                else {
                    console.log('ERRORE: salvataggio ore approvate intervento ' + data.id);
                    $("input[data-id_intervento='" + data.id + "']").siblings(".invioKO").fadeIn().delay(5000).fadeOut();
                }
            }).fail(function (jqXHR, textStatus, data) {
                console.log("Request failed: " + data);
            });
        }

        $('.datepicker').on('changeDate', function () {
            $("#filtro").keyup();
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
            $("#selezione").val(number_format(r, 0, ",", ".", "") + "/" + number_format(rT, 0, ",", ".", ""));
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
//            $("input[name='selettoreRDA']:checkbox:checked").each(function () {
//                if ($(this).closest('.intervento').find("input[name='valoreRDA']").val() == '')
//                    $(this).closest('.intervento').find("input[name='valoreRDA']").val($(this).closest('.intervento').find(".ore_lavorate").text());
//                approvaRiga($(this).closest('.intervento').attr('data-id_intervento'));
//            });
        }

        function rifiuta() {
//            $("input[name='selettoreRDA']:checkbox:checked").each(function () {
//                $(this).closest('.intervento').find("input[name='valoreRDA']").val('');
//                approvaRiga($(this).closest('.intervento').attr('data-id_intervento'), 1);
//            });
        }
    </script>
@endsection

