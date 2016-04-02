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
    @foreach($prodotti as $prodotto)
        <tr>
            <td>{{ $prodotto->codice_fiscale }}<br/>{{ $prodotto->partita_iva }}</td>
            <td><a href="{{ action('ClienteController@show',$prodotto->id) }}">{{ $prodotto->ragione_sociale }}</a></td>
            <td>{{ $prodotto->settore }}</td>
            <td class="pull-right"><i class="glyphicon glyphicon-euro"></i> {{ number_format($prodotto->fatturato,0,',','.') }} mln</td>
            <td><a href="http://maps.google.com/?q={{ $cliente->indirizzo . ', ' . $prodotto->citta . ', ' . $prodotto->ragione_sociale}}" target="crm.tksol.map">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    {{ $prodotto->citta }}
                </a>
            </td>
            <td>{{ $prodotto->rating }}</td>
            <td>
                <a href="{{ action('ClienteController@edit',$prodotto->id) }}" data-skin="skin-blue" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>