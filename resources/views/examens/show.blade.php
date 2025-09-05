<x-layouts.app :title="'Datos del Paciente'">
<div class="container">
    <h2>Datos del Paciente</h2>
    <table class="table table-bordered">
        <tr><th>Correlativo</th><td>{{ $examen->id }}</td></tr>
        <tr><th>Fecha</th><td>{{ $examen->fecha }}</td></tr>
        <tr><th>Número Afiliación</th><td>{{ $examen->numero_afiliacion }}</td></tr>
        <tr><th>Nombre</th><td>{{ $examen->nombre }}</td></tr>
        <tr><th>Apellido</th><td>{{ $examen->apellido }}</td></tr>
        <tr><th>Sexo</th><td>{{ $examen->sexo }}</td></tr>
        <tr><th>Calidad</th><td>{{ $examen->calidad }}</td></tr>
        <tr><th>Edad</th><td>{{ $examen->edad }}</td></tr>
        <tr><th>Unidad</th><td>{{ $examen->unidad }}</td></tr>
        <tr><th>Área</th><td>{{ $examen->area }}</td></tr>
        <tr><th>Programa</th><td>{{ $examen->programa }}</td></tr>
        <tr><th>Sección</th><td>{{ $examen->seccion }}</td></tr>
        <tr><th>Perfil</th><td>{{ $examen->perfil }}</td></tr>
        <tr><th>Pruebas</th><td>
            @foreach(json_decode($examen->pruebas, true) ?? [] as $prueba)
                <span class="badge bg-primary">{{ $prueba }}</span>
            @endforeach
        </td></tr>
    </table>
    <button onclick="window.print()" class="btn btn-outline-dark">Imprimir Datos</button>
    <a href="{{ route('examens.index') }}" class="btn btn-secondary">Volver al listado</a>
</div>
</x-layouts.app>
