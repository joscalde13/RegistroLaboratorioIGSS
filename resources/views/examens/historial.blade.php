<x-layouts.app :title="'Historial de Pruebas'">
<div class="w-full max-w-4xl mx-auto p-4 dark:bg-zinc-900 rounded-xl">
    <h2 class="text-2xl font-semibold text-center mb-6 text-blue-900 dark:text-white tracking-tight">
        Historial de Pruebas del Paciente
    </h2>
    <div class="mb-4">
        @if($paciente)
            <span class="font-bold">Nombre:</span> {{ $paciente->nombre }}<br>
            <span class="font-bold">Apellido:</span> {{ $paciente->apellido }}<br>
            <span class="font-bold">N° Afiliación:</span> {{ $paciente->numero_afiliacion }}<br>
            <span class="font-bold">Sexo:</span> {{ $paciente->sexo }}<br>
            <span class="font-bold">Edad:</span> {{ $paciente->edad }}<br>
        @else
            <span class="font-bold text-red-600">Perfil de paciente no encontrado.</span>
        @endif
    </div>
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-blue-100 dark:border-zinc-700 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left font-sans dark:text-zinc-200">
                <thead class="bg-blue-50 dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 text-xs uppercase tracking-wider border-b border-blue-200 dark:border-zinc-700">
                    <tr>
                        <th class="px-3 py-3 font-semibold whitespace-nowrap">Fecha</th>
                        <th class="px-3 py-3 font-semibold whitespace-nowrap">Pruebas</th>
                        <th class="px-3 py-3 font-semibold whitespace-nowrap">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-50 dark:divide-zinc-700">
                    @forelse($historial as $examen)
                    <tr>
                        <td class="px-3 py-3">{{ \Carbon\Carbon::parse($examen->fecha)->format('d-m-Y') }}</td>
                        <td class="px-3 py-3">
                            <div class="flex flex-wrap gap-1">
                                @php $pruebas = json_decode($examen->pruebas, true) ?? []; @endphp
                                @foreach($pruebas as $prueba)
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs rounded-full border border-blue-200 dark:border-zinc-700 text-blue-900 dark:text-zinc-200 bg-blue-50 dark:bg-zinc-900">
                                        {{ $prueba }}
                                    </span>
                                @endforeach
                                @if(empty($pruebas))
                                    <span class="text-red-600">Sin pruebas</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-3 py-3">{{ $examen->estado }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-gray-500 dark:text-zinc-400">
                            No hay historial de pruebas para este paciente.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6 text-center">
        <a href="{{ route('examens.index') }}" class="px-4 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">Volver al listado</a>
    </div>
</div>
</x-layouts.app>
