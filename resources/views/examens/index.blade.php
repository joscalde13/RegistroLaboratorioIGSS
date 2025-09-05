
<x-layouts.app :title="'Listado de Exámenes'">
<div class="max-w-5xl mx-auto p-4">
    <h2 class="text-2xl md:text-3xl font-semibold text-center mb-6 text-blue-900 tracking-tight">
        Exámenes de Laboratorio
    </h2>
 
    <form method="GET" action="{{ route('examens.index') }}" id="form-busqueda"
          class="mb-5 flex flex-col gap-3 md:flex-row md:items-center md:justify-between print:hidden">

        <div class="flex items-center gap-3 w-full md:max-w-xl">
         
            <div class="relative flex-1">
                <input
                    type="text"
                    name="search"
                    id="input-busqueda"
                    placeholder="Buscar por nombre…"
                    value="{{ request('search') }}"
                    class="w-full pl-3 pr-3 py-2 rounded-xl border border-blue-200 bg-white text-blue-900
                           placeholder-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300 "
                    oninput="if(this.value===''){document.getElementById('form-busqueda').submit();}"
                >
            </div>
            <button type="submit"
                class="px-4 py-2 rounded-xl border border-blue-200 bg-blue-50 text-blue-900 font-semibold hover:bg-blue-100 hover:text-blue-800 transition">
                Buscar
            </button>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('examens.create') }}"
               class="px-4 py-2 rounded-xl border border-blue-200 bg-blue-50 text-blue-900 font-semibold hover:bg-blue-100 hover:text-blue-800 transition">
                Nuevo examen
            </a>
        </div>
    </form>
    <div class="overflow-auto bg-white rounded-xl border border-blue-100 shadow-sm" style="max-height: 70vh;">
        
        <table class="min-w-full text-sm text-left font-sans">
            <thead class="sticky top-0 bg-blue-50 text-blue-900 text-xs uppercase tracking-wider border-b border-blue-200 z-10">
                <tr>
                    <th class="px-4 py-3 font-semibold">Correlativo</th>
                    <th class="px-4 py-3 font-semibold">Fecha</th>
                    <th class="px-4 py-3 font-semibold">N° Afiliación</th>
                    <th class="px-4 py-3 font-semibold">Nombre</th>
                    <th class="px-4 py-3 font-semibold">Apellido</th>
                    <th class="px-4 py-3 font-semibold">Sexo</th>
                    <th class="px-4 py-3 font-semibold">Calidad</th>
                    <th class="px-4 py-3 font-semibold">Edad</th>
                    <th class="px-4 py-3 font-semibold">Unidad</th>
                    <th class="px-4 py-3 font-semibold">Área</th>
                    <th class="px-4 py-3 font-semibold">Programa</th>
                    <th class="px-4 py-3 font-semibold">Sección</th>
                    <th class="px-4 py-3 font-semibold">Perfil</th>
                    <th class="px-4 py-3 font-semibold">Pruebas</th>
                    <th class="px-4 py-3 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-50">
                @forelse($examens as $examen)
                <tr class="odd:bg-white even:bg-blue-50 hover:bg-blue-100/60 transition">
                    <td class="px-3 py-2 text-blue-900 font-semibold">{{ $examen->correlativo }}</td>
                    <td class="px-3 py-2">{{ \Carbon\Carbon::parse($examen->fecha)->format('d-m-Y') }}</td>
                    <td class="px-3 py-2">{{ $examen->numero_afiliacion }}</td>
                    <td class="px-3 py-2">{{ $examen->nombre }}</td>
                    <td class="px-3 py-2">{{ $examen->apellido }}</td>
                    <td class="px-3 py-2">{{ $examen->sexo }}</td>
                    <td class="px-3 py-2">{{ $examen->calidad }}</td>
                    <td class="px-3 py-2">{{ $examen->edad }}</td>
                    <td class="px-3 py-2">{{ $examen->unidad }}</td>
                    <td class="px-3 py-2">{{ $examen->area }}</td>
                    <td class="px-3 py-2">{{ $examen->programa }}</td>
                    <td class="px-3 py-2">{{ $examen->seccion }}</td>
                    <td class="px-3 py-2">{{ $examen->perfil }}</td>
                    <td class="px-3 py-2">
                        <div class="flex flex-wrap gap-1">
                            @foreach(json_decode($examen->pruebas, true) ?? [] as $prueba)
                                <span class="inline-flex items-center px-2 py-0.5 text-[11px] rounded-full border border-blue-200 text-blue-900 bg-blue-50">
                                    {{ $prueba }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-3 py-2">
                        <div class="flex gap-2">
                            <a href="{{ route('examens.edit', $examen->id) }}" class="px-3 py-1 rounded bg-yellow-400 text-white text-xs font-semibold hover:bg-yellow-500 transition">Editar</a>
                            <form method="POST" action="{{ route('examens.destroy', $examen->id) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este examen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 rounded bg-red-500 text-white text-xs font-semibold hover:bg-red-600 transition">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="14" class="px-4 py-10 text-center text-gray-500">
                        No hay exámenes para mostrar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
    </div>


    <div class="mb-4 mt-4 flex justify-end gap-2">
            <a href="{{ route('examens.exportPdf') }}" class="px-4 py-2 rounded bg-red-600 text-white font-semibold text-sm hover:bg-red-700 transition">Descargar PDF</a>
     </div>
</div>

</x-layouts.app>