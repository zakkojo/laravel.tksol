<table id="clienti" class="table table-striped table-bordered dataTables_wrapper form-inline dt-bootstrap" cellspacing="0" width="100%">
    <thead>
    <tr>
        <td>Codice Fiscale<br/>Partita IVA</td>
        <td>Ragione Sociale</td>
        <td>Settore</td>
        <td>Fatturato</td>
        <td>Città</td>
        <td>Rating</td>
        <td>Opzioni</td>
    </tr>
    </thead>
    <tbody>
    @foreach($interventi as $intervento)
        <tr>
            <td>{{ $intervento->codice_fiscale }}<br/>{{ $intervento->partita_iva }}</td>
            <td><a href="{{ action('ClienteController@show',$intervento->id) }}">{{ $intervento->ragione_sociale }}</a></td>
            <td>{{ $intervento->settore }}</td>
            <td class="pull-right"><i class="glyphicon glyphicon-euro"></i> {{ number_format($intervento->fatturato,0,',','.') }} mln</td>
            <td><a href="http://maps.google.com/?q={{ $intervento->indirizzo . ', ' . $intervento->citta . ', ' . $intervento->ragione_sociale}}" target="crm.tksol.map">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    {{ $intervento->citta }}
                </a>
            </td>
            <td>{{ $intervento->rating }}</td>
            <td>
                <a href="{{ action('ClienteController@edit',$intervento->id) }}" data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>