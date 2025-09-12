<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Totales de Exámenes - PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #222; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #bbb; padding: 6px 10px; text-align: left; }
        th { background: #f2f2f2; }
        .section-title { background: #e0e7ff; font-weight: bold; padding: 8px; }
    </style>
</head>
<body>
    <h2>Estadísticas y Totales de Exámenes</h2>
    <table>
        <tr><th colspan="2" class="section-title">Sexo</th></tr>
        @forelse($totales['sexo'] ?? [] as $item)
            <tr>
                <td>{{ $item->sexo }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @empty
            <tr><td colspan="2">Sin datos</td></tr>
        @endforelse
    </table>
    <table>
        <tr><th colspan="2" class="section-title">Calidad</th></tr>
        @forelse($totales['calidad'] ?? [] as $item)
            <tr>
                <td>{{ $item->calidad }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @empty
            <tr><td colspan="2">Sin datos</td></tr>
        @endforelse
    </table>
    <table>
        <tr><th colspan="2" class="section-title">Edad</th></tr>
        @forelse($totales['edad'] ?? [] as $item)
            <tr>
                <td>{{ $item->edad }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @empty
            <tr><td colspan="2">Sin datos</td></tr>
        @endforelse
    </table>
    <table>
        <tr><th colspan="2" class="section-title">Unidad</th></tr>
        @forelse($totales['unidad'] ?? [] as $item)
            <tr>
                <td>{{ $item->unidad }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @empty
            <tr><td colspan="2">Sin datos</td></tr>
        @endforelse
    </table>
    <table>
        <tr><th colspan="2" class="section-title">Área</th></tr>
        @forelse($totales['area'] ?? [] as $item)
            <tr>
                <td>{{ $item->area }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @empty
            <tr><td colspan="2">Sin datos</td></tr>
        @endforelse
    </table>
    <table>
        <tr><th colspan="2" class="section-title">Programa</th></tr>
        @forelse($totales['programa'] ?? [] as $item)
            <tr>
                <td>{{ $item->programa }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @empty
            <tr><td colspan="2">Sin datos</td></tr>
        @endforelse
    </table>
    <table>
        <tr><th colspan="2" class="section-title">Sección</th></tr>
        @forelse($totales['seccion'] ?? [] as $item)
            <tr>
                <td>{{ $item->seccion }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @empty
            <tr><td colspan="2">Sin datos</td></tr>
        @endforelse
    </table>
    <table>
        <tr><th colspan="2" class="section-title">Prueba</th></tr>
        @forelse($totales['prueba'] ?? [] as $prueba => $total)
            <tr>
                <td>{{ $prueba }}</td>
                <td>{{ $total }}</td>
            </tr>
        @empty
            <tr><td colspan="2">Sin datos</td></tr>
        @endforelse
    </table>
</body>
</html>
