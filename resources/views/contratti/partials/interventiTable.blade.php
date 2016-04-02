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
    @foreach($listinoInterventi as $listinoIntervento)
        <tr>
            <td>{{ $listinoIntervento->codice_fiscale }}<br/>{{ $listinoIntervento->partita_iva }}</td>
            <td><a href="{{ action('ClienteController@show',$listinoIntervento->id) }}">{{ $listinoIntervento->ragione_sociale }}</a></td>
            <td>{{ $listinoIntervento->settore }}</td>
            <td class="pull-right"><i class="glyphicon glyphicon-euro"></i> {{ number_format($listinoIntervento->fatturato,0,',','.') }} mln</td>
            <td><a href="http://maps.google.com/?q={{ $listinoIntervento->indirizzo . ', ' . $listinoIntervento->citta . ', ' . $listinoIntervento->ragione_sociale}}" target="crm.tksol.map">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    {{ $listinoIntervento->citta }}
                </a>
            </td>
            <td>{{ $listinoIntervento->rating }}</td>
            <td>
                <a href="{{ action('ClienteController@edit',$listinoIntervento->id) }}" data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>