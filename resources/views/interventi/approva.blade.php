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
            font-weight: bold;
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
        <div>Totale valore selezionato: <input id='vTotale' size='20' readonly value='0'/></div>

        <div>Valutazione: <input type='button' onclick='autorizza();' value='Si autorizza'/>
            <input type='button' onclick='rifiuta();' value='Si rifiuta'/>
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
                    <th>Approvate</th>
                </tr>
                </thead>
                <tobody>
                    @foreach($daApprovare as $intervento)
                        <tr>
                            <td style='padding:1pt'><input name='selettoreRDA' type='checkbox' valore='???'></td>
                            <td>{{$intervento->data}}</td>
                            <td>{{$intervento->user->consulente->nominativo}}</td>
                            <td>{{$intervento->contratto->cliente->ragione_sociale}}</td>
                            <td>{{$intervento->contratto->progetto->nome}}</td>
                            <td>{{$intervento->ore_lavorate}}</td>
                            <td><input name='valoreRDA' type='text' valore='{{$intervento->ore_fatturate}}'></td>
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

        $("input[type='button']").button();

        $("#RDAValutazione").dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 600,
            height: 400,
            modal: true,
            position: {my: "center", at: "center", of: window}
        });

        $("#filtro").keyup(function () {
            var i = 0;
            $("table").find('tr').each(function () {
                i++;
                var x = false;
                if ($(this).children('th').length == 0) {
                    $(this).find('td').each(function () {
                        var str = $(this).html() + $(this).attr('title');
                        str = str.toLowerCase();
                        var n = str.indexOf($("#filtro").val().toLowerCase());
                        if (n != -1) x = x || true;
                    })
                    //alert('riga '+i+' vis:'+x);
                    if (x) $(this).show(); else $(this).hide();
                }
            })
        });


        $('#articolo').keyup(function () {

            clearTimeout($.data(this, 'timer'));
            var wait = setTimeout(myDelay, 1500, $(this).attr('id'));
            $(this).data('timer', wait);

        });

        function myDelay(id) {

            myForm.submit();

        }

        $('#selezionaTutti').click(function () {
            $("input[name='selettoreRDA']:visible").not(this).prop('checked', this.checked);
            calcolaTotale();
        });

        $("input[name='selettoreRDA']").click(function () {
            calcolaTotale();
        });

        function calcolaTotale() {
            var v = 0;
            var r = 0;
            var rT = 0;
            $("input[name='selettoreRDA']:checkbox").each(function () {
                $(this).parent().parent().removeClass('sel');
                rT++;
            });

            $("input[name='selettoreRDA']:checkbox:checked").each(function () {
                v = v + parseFloat($(this).attr('valore'));
                r++;
                $(this).parent().parent().addClass('sel');
            });
            v = Math.round(v * 100) / 100;
            $("#vTotale").val(number_format(v, 2, ",", ".", "\u20AC"));
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
            //Verificare superamento budget
            //In caso di superamento è necessario chiedere conferma e, in caso di autorizzazione, richiedere una motivazione obbligatoria
            $("#RDAValutazione").dialog("option", "title", "Autorizzazione RDA selezionate");

            var v = 0;
            var r = 0;
            $("input[name='selettoreRDA']:checkbox:checked").each(function () {
                v = v + parseFloat($(this).attr('valore'));
                r++;
            });

            if (r == 0) {
                alert("Nessuna riga selezionata");
            } else {

                $("#RDAValutazione").dialog("option", "buttons",
                    [
                        {
                            text: "Autorizzo",
                            click: function () {
                                $(this).dialog("close");
                            }
                        },
                        {
                            text: "Annulla",
                            click: function () {
                                $(this).dialog("close");
                            }
                        }
                    ]
                );

                $("#RDAValutazione").dialog("open");
            }
        }

        function rifiuta() {
            //Specificare motivo
            $("#RDAValutazione").dialog("option", "title", "Rifiuta RDA selezionate");

            var v = 0;
            var r = 0;
            $("input[name='selettoreRDA']:checkbox:checked").each(function () {
                v = v + parseFloat($(this).attr('valore'));
                r++;
            });

            if (r == 0) {
                alert("Nessuna riga selezionata");
            } else {

                $("#RDAValutazione").dialog("option", "buttons",
                    [
                        {
                            text: "Rifiuto",
                            click: function () {
                                $(this).dialog("close");
                            }
                        },
                        {
                            text: "Annnulla",
                            click: function () {
                                $(this).dialog("close");
                            }
                        }
                    ]
                );

                $("#RDAValutazione").dialog("open");
            }

        }
    </script>
@endsection

