<x-layouts.app :title="'Totales de Exámenes'">
    
<div class="max-w-7xl mx-auto p-6 pb-0 ">
    <div class="mb-6 flex flex-wrap gap-2 justify-end">
        <a href="{{ route('examens.statsPdf') }}" class="px-4 py-2 rounded bg-red-600 text-white font-semibold hover:bg-red-700 transition">
            Descargar PDF
        </a>
        <a href="{{ route('examens.statsExcel') }}" class="px-4 py-2 rounded bg-green-600 text-white font-semibold hover:bg-green-700 transition">
            Descargar Excel
        </a>
    </div>
     
    
    <h2 class="text-2xl font-bold text-center mb-8 text-gray-700 dark:text-gray-200 tracking-wide  pb-4">
        Estadísticas y Totales de Exámenes
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        
        <!-- Sexo -->
        <section class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm p-3 flex flex-col items-center">
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Sexo</h4>
            <ul class="w-full">
                @forelse($totales['sexo'] ?? [] as $item)
                    <li class="flex justify-between text-xs py-1">
                        <span class="text-gray-600 dark:text-gray-300">{{ $item->sexo }}</span>
                        <span class="px-2 py-0.5 rounded bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">{{ $item->total }}</span>
                    </li>
                @empty
                    <li class="text-gray-400 dark:text-gray-500 text-xs py-1">Sin datos</li>
                @endforelse
            </ul>
        </section>

        <!-- Calidad -->
        <section class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm p-3 flex flex-col items-center">
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Calidad</h4>
            <ul class="w-full">
                @forelse($totales['calidad'] ?? [] as $item)
                    <li class="flex justify-between text-xs py-1">
                        <span class="text-gray-600 dark:text-gray-300">{{ $item->calidad }}</span>
                        <span class="px-2 py-0.5 rounded bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">{{ $item->total }}</span>
                    </li>
                @empty
                    <li class="text-gray-400 dark:text-gray-500 text-xs py-1">Sin datos</li>
                @endforelse
            </ul>
        </section>

        <!-- Edad -->
        <section class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm p-3 flex flex-col items-center">
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Edad</h4>
            <ul class="w-full">
                @forelse($totales['edad'] ?? [] as $item)
                    <li class="flex justify-between text-xs py-1">
                        <span class="text-gray-600 dark:text-gray-300">{{ $item->edad }}</span>
                        <span class="px-2 py-0.5 rounded bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">{{ $item->total }}</span>
                    </li>
                @empty
                    <li class="text-gray-400 dark:text-gray-500 text-xs py-1">Sin datos</li>
                @endforelse
            </ul>
        </section>

        <!-- Unidad -->
        <section class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm p-3 flex flex-col items-center">
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Unidad</h4>
            <ul class="w-full">
                @forelse($totales['unidad'] ?? [] as $item)
                    <li class="flex justify-between text-xs py-1">
                        <span class="text-gray-700 dark:text-gray-200">{{ $item->unidad }}</span>
                        <span class="px-2 py-0.5 rounded bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">{{ $item->total }}</span>
                    </li>
                @empty
                    <li class="text-gray-400 dark:text-gray-500 text-xs py-1">Sin datos</li>
                @endforelse
            </ul>
        </section>

        <!-- Área -->
        <section class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm p-3 flex flex-col items-center">
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Área</h4>
            <ul class="w-full">
                @forelse($totales['area'] ?? [] as $item)
                    <li class="flex justify-between text-xs py-1">
                        <span class="text-gray-700 dark:text-gray-200">{{ $item->area }}</span>
                        <span class="px-2 py-0.5 rounded bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">{{ $item->total }}</span>
                    </li>
                @empty
                    <li class="text-gray-400 dark:text-gray-500 text-xs py-1">Sin datos</li>
                @endforelse
            </ul>
        </section>

        <!-- Programa -->
        <section class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm p-3 flex flex-col items-center">
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Programa</h4>
            <ul class="w-full">
                @forelse($totales['programa'] ?? [] as $item)
                    <li class="flex justify-between text-xs py-1">
                        <span class="text-gray-600 dark:text-gray-300">{{ $item->programa }}</span>
                        <span class="px-2 py-0.5 rounded bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">{{ $item->total }}</span>
                    </li>
                @empty
                    <li class="text-gray-400 dark:text-gray-500 text-xs py-1">Sin datos</li>
                @endforelse
            </ul>
        </section>

        <!-- Sección -->
        <section class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm p-3 flex flex-col items-center">
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Sección</h4>
            <ul class="w-full">
                @forelse($totales['seccion'] ?? [] as $item)
                    <li class="flex justify-between text-xs py-1">
                        <span class="text-gray-600 dark:text-gray-300">{{ $item->seccion }}</span>
                        <span class="px-2 py-0.5 rounded bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">{{ $item->total }}</span>
                    </li>
                @empty
                    <li class="text-gray-400 dark:text-gray-500 text-xs py-1">Sin datos</li>
                @endforelse
            </ul>
        </section>

        <!-- Pruebas -->
        <section class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm p-3 flex flex-col items-center">
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">Pruebas</h4>
            <ul class="w-full">
                @foreach($totales['prueba'] ?? [] as $prueba => $total)
                    <li class="flex justify-between text-xs py-1">
                        <span class="text-gray-600 dark:text-gray-300">{{ $prueba }}</span>
                        <span class="px-2 py-0.5 rounded bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200">{{ $total }}</span>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>

</div>

</x-layouts.app>
