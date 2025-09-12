                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Acciones</th>
<x-layouts.app :title="'Listado de Exámenes ' . \Carbon\Carbon::createFromDate(null, $mes, null)->locale('es')->monthName . ' ' . $anio">
    <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Listado de Exámenes - {{ \Carbon\Carbon::createFromDate(null, $mes, null)->locale('es')->monthName }} {{ $anio }}</h1>
        <div class="mb-4 flex gap-2">
            <a href="#" class="px-4 py-2 rounded bg-green-600 text-white font-semibold hover:bg-green-700 transition">Descargar Excel</a>
            <a href="#" class="px-4 py-2 rounded bg-red-600 text-white font-semibold hover:bg-red-700 transition">Descargar PDF</a>
        </div>
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-blue-100 dark:border-zinc-700 shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left font-sans dark:text-zinc-200">
                    <thead class="bg-blue-50 dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 text-xs uppercase tracking-wider border-b border-blue-200 dark:border-zinc-700">
                        <tr>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Correlativo</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Fecha</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">No. Afiliación</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Nombre</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Apellido</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Sexo</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Calidad</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Edad</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Unidad</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Área</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Programa</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Sección</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Perfil</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Pruebas</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Estado</th>
                            <th class="px-3 py-3 font-semibold whitespace-nowrap">Acciones</th>
                    </thead>
                    <tbody class="divide-y divide-blue-50 dark:divide-zinc-700">
                        @forelse($examens as $examen)
                        <tr>
                            <td class="px-3 py-3">{{ $examen->correlativo ?? '-' }}</td>
                            <td class="px-3 py-3">{{ \Carbon\Carbon::parse($examen->fecha)->format('d-m-Y') }}</td>
                            <td class="px-3 py-3">{{ $examen->numero_afiliacion ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->nombre ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->apellido ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->sexo ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->calidad ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->edad ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->unidad ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->area ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->programa ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->seccion ?? '-' }}</td>
                            <td class="px-3 py-3">{{ $examen->perfil ?? '-' }}</td>
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
                            <td class="px-3 py-3">{{ $examen->estado ?? '-' }}</td>
                            <td class="px-3 py-3">
                                <div class="flex gap-1">
                                    <a href="{{ route('examens.edit', $examen->id) }}" class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m2-2l-6 6m2-2l6-6" /></svg>
                                    </a>
                                    <form action="{{ route('examens.destroy', $examen->id) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar este examen?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </form>
                                    <a href="{{ route('examens.historial', $examen->numero_afiliacion) }}" class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700" title="Ver historial">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="14" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 mb-4 text-blue-200 dark:text-zinc-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span class="text-lg font-semibold text-blue-900 dark:text-zinc-300">No hay datos disponibles</span>
                                    <span class="text-sm text-blue-600 dark:text-zinc-400">Cuando se registren exámenes en este mes, aparecerán aquí automáticamente.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">
            <a href="{{ route('reportes.meses', $anio) }}" class="text-blue-600 hover:underline">&larr; Volver a meses</a>
        </div>
    </div>
</x-layouts.app>
