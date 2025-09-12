<table>
    <tr>
        <th>Categoría</th>
        <th>Valor</th>
        <th>Total</th>
    </tr>
    @foreach(['sexo','calidad','edad','unidad','area','programa','seccion'] as $cat)
        @foreach($totales[$cat] ?? [] as $item)
            <tr>
                <td>{{ ucfirst($cat) }}</td>
                <td>{{ $item->$cat }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach
    @endforeach
    @foreach($totales['prueba'] ?? [] as $prueba => $total)
        <tr>
            <td>Prueba</td>
            <td>{{ $prueba }}</td>
            <td>{{ $total }}</td>
        </tr>
    @endforeach
</table>
