<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 4px; text-align: left; }
        th { background: #e3e3e3; }
    </style>
</head>
<body>
    <h2>Listado de Exámenes de Laboratorio IGSS</h2>
    <table>
        <thead>
            <tr>
                
                <th>Correlativo</th>
                <th>Fecha</th>
                <th>N° Afiliación</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Sexo</th>
                <th>Calidad</th>
                <th>Edad</th>
                <th>Unidad</th>
                <th>Área</th>
                <th>Programa</th>
                <th>Sección</th>
                <th>Perfil</th>
                <th>Pruebas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($examens as $examen)
            <tr>
             
                <td>{{ $examen->correlativo }}</td>
                <td>{{ \Carbon\Carbon::parse($examen->fecha)->format('d-m-Y') }}</td>
                <td>{{ $examen->numero_afiliacion }}</td>
                <td>{{ $examen->nombre }}</td>
                <td>{{ $examen->apellido }}</td>
                <td>{{ $examen->sexo }}</td>
                <td>{{ $examen->calidad }}</td>
                <td>{{ $examen->edad }}</td>
                <td>{{ $examen->unidad }}</td>
                <td>{{ $examen->area }}</td>
                <td>{{ $examen->programa }}</td>
                <td>{{ $examen->seccion }}</td>
                <td>{{ $examen->perfil }}</td>
                <td>
                    @foreach(json_decode($examen->pruebas, true) ?? [] as $prueba)
                        <span>{{ $prueba }}</span>@if(!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>