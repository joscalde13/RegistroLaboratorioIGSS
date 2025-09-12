<x-layouts.app :title="'Meses de ' . $anio">
    <div class="max-w-4xl mx-auto p-8">
        <h1 class="text-3xl font-bold mb-8 text-center text-blue-900 dark:text-white tracking-tight">Meses del año {{ $anio }}</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse($meses as $mes)
                <a href="{{ route('reportes.listado', [$anio, $mes]) }}" class="block rounded-xl shadow-lg bg-gradient-to-br from-blue-50 to-blue-200 dark:from-zinc-800 dark:to-zinc-700 p-8 text-center transition transform hover:-translate-y-1 hover:shadow-2xl group">
                    <div class="flex flex-col items-center justify-center h-full">
                        <svg class="w-10 h-10 mb-4 text-blue-500 group-hover:text-blue-700 dark:text-blue-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75v-1.5A2.25 2.25 0 0110.5 3h3a2.25 2.25 0 012.25 2.25v1.5m-7.5 0h7.5m-7.5 0A2.25 2.25 0 003 9v8.25A2.25 2.25 0 005.25 19.5h13.5A2.25 2.25 0 0021 17.25V9a2.25 2.25 0 00-2.25-2.25m-7.5 0v1.5m7.5-1.5v1.5" /></svg>
                        <span class="text-xl font-bold text-blue-900 dark:text-white group-hover:text-blue-700">
                            {{ \Carbon\Carbon::createFromDate(null, $mes, null)->locale('es')->monthName }}
                        </span>
                        <span class="mt-2 text-sm text-blue-700 dark:text-blue-300">Ver listado mensual</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-zinc-400">No hay meses con reportes para este año.</div>
            @endforelse
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('reportes.index') }}" class="inline-block px-4 py-2 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">&larr; Volver a años</a>
        </div>
    </div>
</x-layouts.app>
