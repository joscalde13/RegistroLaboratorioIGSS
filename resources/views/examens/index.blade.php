<x-layouts.app :title="'Listado de Exámenes'">
<div class="w-full max-w-7xl mx-auto p-4 dark:bg-zinc-900 rounded-xl">
    <h2 class="text-2xl md:text-3xl font-semibold text-center mb-6 text-blue-900 dark:text-white tracking-tight">
        Exámenes de Laboratorio
    </h2>

    @if (session('success'))
        <div class="mb-4 p-4 text-green-800 bg-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Actions Bar -->
    <div class="mb-6 bg-white dark:bg-zinc-800 rounded-lg border border-blue-100 dark:border-zinc-700 shadow-sm p-4 print:hidden">
        <form method="GET" action="{{ route('examens.index') }}" id="form-busqueda"
              class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">

            <div class="flex items-center gap-3 w-full sm:max-w-lg">
                <div class="relative flex-1">
                    <input
                        type="text"
                        name="search"
                        id="input-busqueda"
                        placeholder="Buscar por nombre, apellido o número de afiliación..."
                        value="{{ request('search') }}"
                        class="w-full pl-4 pr-4 py-2.5 rounded-lg border border-blue-200 bg-white text-blue-900
                               placeholder-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300 text-sm"
                        oninput="if(this.value===''){document.getElementById('form-busqueda').submit();}"
                    >
                </div>
                <button type="submit"
                    class="px-4 py-2.5 rounded-lg border border-blue-200 bg-blue-50 text-blue-900 font-semibold hover:bg-blue-100 hover:text-blue-800 transition text-sm whitespace-nowrap">
                    Buscar
                </button>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('examens.exportPdf') }}" 
                   class="flex-1 sm:flex-none px-4 py-2.5 rounded-lg bg-red-600 text-white font-semibold text-sm hover:bg-red-700 transition text-center">
                    Descargar PDF
                </a>
                <a href="{{ route('examens.create') }}"
                   class="flex-1 sm:flex-none px-4 py-2.5 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold hover:scale-105 transition text-sm text-center">
                    + Nuevo Examen
                </a>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-blue-100 dark:border-zinc-700 shadow-sm">
    <div class="overflow-x-auto">
            <table class="w-full text-sm text-left font-sans dark:text-zinc-200">
                <thead class="bg-blue-50 dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 text-xs uppercase tracking-wider border-b border-blue-200 dark:border-zinc-700">
                    <tr>
                        <th class="px-3 py-3 font-semibold whitespace-nowrap">Correlativo</th>
                        <th class="px-3 py-3 font-semibold whitespace-nowrap">Fecha</th>
                        <th class="px-3 py-3 font-semibold whitespace-nowrap">N° Afiliación</th>
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
                        <th class="px-3 py-3 font-semibold whitespace-nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-50 dark:divide-zinc-700">
                    @forelse($examens as $examen)
                    <tr class="odd:bg-white even:bg-blue-50/50 dark:odd:bg-zinc-900 dark:even:bg-zinc-800 hover:bg-blue-100/60 dark:hover:bg-zinc-700 transition-colors">
                        <td class="px-3 py-3 text-blue-900 dark:text-zinc-200 font-semibold">{{ $examen->correlativo }}</td>
                        <td class="px-3 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($examen->fecha)->format('d-m-Y') }}</td>
                        <td class="px-3 py-3">{{ $examen->numero_afiliacion }}</td>
                        <td class="px-3 py-3">{{ $examen->nombre }}</td>
                        <td class="px-3 py-3">{{ $examen->apellido }}</td>
                        <td class="px-3 py-3">{{ $examen->sexo }}</td>
                        <td class="px-3 py-3">
                            <span class="inline-flex items-center px-2 py-1 text-xs rounded-full font-medium
                                @if($examen->calidad === 'AF') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                                @elseif($examen->calidad === 'BH') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                                @elseif($examen->calidad === 'Pen') bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200
                                @elseif($examen->calidad === 'BE') bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200
                                @else bg-gray-100 dark:bg-zinc-700 text-gray-800 dark:text-zinc-200 @endif">
                                {{ $examen->calidad }}
                            </span>
                        </td>
                        <td class="px-3 py-3">{{ $examen->edad }}</td>
                        <td class="px-3 py-3">
                            <div class="max-w-32 truncate" title="{{ $examen->unidad }}">
                                {{ $examen->unidad }}
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            <div class="max-w-24 truncate" title="{{ $examen->area }}">
                                {{ $examen->area }}
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            <div class="max-w-32 truncate" title="{{ $examen->programa }}">
                                {{ $examen->programa }}
                            </div>
                        </td>
                        <td class="px-3 py-3">{{ $examen->seccion }}</td>
                        <td class="px-3 py-3">{{ $examen->perfil }}</td>
                        <td class="px-3 py-3">
                            <div class="flex flex-wrap gap-1">
                                @foreach(json_decode($examen->pruebas, true) ?? [] as $prueba)
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs rounded-full border border-blue-200 dark:border-zinc-700 text-blue-900 dark:text-zinc-200 bg-blue-50 dark:bg-zinc-900">
                                        {{ $prueba }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            <div class="flex gap-1">
                                <a href="{{ route('examens.edit', $examen->id) }}" 
                                   class="px-2 py-1 rounded text-white text-xs font-semibold bg-amber-500 hover:bg-amber-600 transition"
                                   title="Editar examen">
                                    Editar
                                </a>
                                <form method="POST" action="{{ route('examens.destroy', $examen->id) }}" 
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este examen?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-2 py-1 rounded text-white text-xs font-semibold bg-red-500 hover:bg-red-600 transition"
                                            title="Eliminar examen">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="15" class="px-4 py-12 text-center text-gray-500 dark:text-zinc-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300 dark:text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No hay exámenes para mostrar</p>
                                <p class="text-sm">¡Crea tu primer examen para empezar!</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination if needed -->
    @if(method_exists($examens, 'links'))
        <div class="mt-6">
            {{ $examens->links() }}
        </div>
    @endif
</div>

<!-- Mobile-friendly styles -->
<style>
    @media (max-width: 768px) {
        .table-container {
            font-size: 0.8rem;
        }
        
        .table-container th,
        .table-container td {
            padding: 0.5rem 0.25rem;
        }
    }
</style>

</x-layouts.app>