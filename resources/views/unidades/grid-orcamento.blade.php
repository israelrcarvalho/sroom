<table class="table table-striped grid-orcamento-unidade">
    <thead>
    <tr>
        <th></th>
        <th>RECURSO</th>
        <th class="text-center">QUANT</th>
        <th>SALDO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orcamento as $orc)
        <tr>
            <td class="text-center">
                    <b>CR:</b> {{ $orc->centros->nome }} - ({{ $orc->centros->codigo }})
            </td>
            <td>
                {{ $orc->recursos->nome }} <br />
                {{ $orc->recursos->conta_contabil }}
            </td>
            <td class="text-center">{{ $orc->quantidade }}</td>
            <td class="text-center">{{ $orc->saldo }}</td>
        </tr>
    @endforeach
    </tbody>
</table>