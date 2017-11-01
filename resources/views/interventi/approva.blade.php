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

        table {
            border-collapse: collapse;
            border: 1pt solid grey;
        }

        table th {
            font-size: 10pt;
            color: white;
            background-color: #4f8fb5;
            padding: 3pt;
            border: 1pt solid grey;
        }

        table td {
            font-size: 10pt;
            border: 1pt solid grey;
            padding: 5pt;
        }

        table tr:nth-child(even) {
            background-color: #f0f0f0;
        }

        table tr:nth-child(odd) {
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
            padding: 5pt;
        }

        .rdaHEAD div {
            display: inline;
        }

        #vTotale, #vRighe {
            text-align: left;
            border: 0pt;
            font-size: 12pt;
            width: 150px;
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
            border-bottom: 0.1pt solid grey;
            border-top: 0.1pt solid grey;
            border-right: 0.1pt solid grey;
        }
    </style>

    <div class='rdaHEAD'>
        <div>Filtro: <input size='40' type='text' id='filtro'></div>

        <div>Righe selezionate: <input id='vRighe' size='10' readonly value='0'/></div>

        <div>Valutazione:
            <input type='button' class="btn btn-success" onclick='autorizza();' value='Si autorizza'/>
            <input type='button' class="btn btn-danger" onclick='rifiuta();' value='Si rifiuta'/>
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
                    <th>Progetto</th>
                    <th>Ore Lavorate</th>
                    <th style="width:180px">Approvate</th>
                </tr>
                </thead>
                <tobody>
                    @foreach($daApprovare as $intervento)
                        <tr class='intervento' data-id_intervento='{{$intervento->id}}'>
                            <td style='padding:1pt'><input name='selettoreRDA' type='checkbox'></td>
                            <td>{{$intervento->data}}</td>
                            <td>{{$intervento->user->consulente->nominativo}}</td>
                            <td>{{$intervento->contratto->cliente->ragione_sociale}}</td>
                            <td>{{$intervento->contratto->progetto->nome}}</td>
                            <td class="ore_lavorate">{{$intervento->ore_lavorate}}</td>
                            <td>
                                <input name='valoreRDA' type='text'
                                       value='@if($intervento->approvato == 1){{$intervento->ore_fatturate}}@endif'
                                       data-id_intervento='{{$intervento->id}}'>
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


        $("#filtro").keyup(function () {
            var i = 0;
            $("table").find('tr').each(function () {
                i++;
                var x = false;
                if ($(this).children('th').length == 0) {
                    //se checkato mantieni visibile
                    if ($(this).find("input[name='selettoreRDA']").iCheck('update')[0].checked) x = true;
                    //altrimenti verifica testo
                    else {
                        $(this).find('td').each(function () {
                            var str = $(this).text();
                            str = str.toLowerCase();
                            var n = str.indexOf($("#filtro").val().toLowerCase());
                            if (n != -1) x = x || true;
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
                approvaRiga($(this).closest('.intervento').attr('data-id_intervento'));
            });
        }

        function rifiuta() {
            $("input[name='selettoreRDA']:checkbox:checked").each(function () {
                $(this).closest('.intervento').find("input[name='valoreRDA']").val('');
                approvaRiga($(this).closest('.intervento').attr('data-id_intervento'), 1);
            });
        }
    </script>
@endsection

