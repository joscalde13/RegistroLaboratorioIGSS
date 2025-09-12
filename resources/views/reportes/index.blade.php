<x-layouts.app :title="'Reportes por Año'">
    <div class="max-w-4xl mx-auto p-8">
        <h1 class="text-3xl font-bold mb-8 text-center text-blue-900 dark:text-white tracking-tight">Reportes por Año</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse($anios as $anio)
                <a href="{{ route('reportes.meses', $anio) }}" class="block rounded-xl shadow-lg bg-gradient-to-br from-blue-100 to-blue-300 dark:from-zinc-800 dark:to-zinc-700 p-8 text-center transition transform hover:-translate-y-1 hover:shadow-2xl group">
                    <div class="flex flex-col items-center justify-center h-full">
                        <svg class="w-12 h-12 mb-4 text-blue-600 group-hover:text-blue-800 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8.25V6.75A2.25 2.25 0 015.25 4.5h13.5A2.25 2.25 0 0121 6.75v1.5M3 8.25h18M3 8.25v8.25A2.25 2.25 0 005.25 18.75h13.5A2.25 2.25 0 0021 16.5V8.25M7.5 12h.008v.008H7.5V12zm4.5 0h.008v.008H12V12zm4.5 0h.008v.008H16.5V12z" /></svg>
                        <span class="text-2xl font-bold text-blue-900 dark:text-white group-hover:text-blue-800">{{ $anio }}</span>
                        <span class="mt-2 text-sm text-blue-700 dark:text-blue-300">Ver meses disponibles</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-zinc-400">No hay reportes disponibles.</div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
