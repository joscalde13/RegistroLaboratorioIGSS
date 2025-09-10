<x-layouts.app :title="__('Agenda de Citas')">
   


<div class="container">
<!-- Modal -->
<div id="modal-bg" class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-sm hidden">
    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-xl p-6 w-full max-w-sm relative border border-blue-100 dark:border-zinc-700">
        <h3 class="text-lg font-semibold mb-3 text-blue-800 dark:text-blue-200">Detalle de la Cita</h3>
        <div class="mb-2 text-zinc-700 dark:text-zinc-200 text-base"><span class="font-medium">Nombre:</span> <span id="modal-nombre"></span></div>
        <div class="mb-2 text-zinc-700 dark:text-zinc-200 text-base"><span class="font-medium">Afiliación:</span> <span id="modal-afiliacion"></span></div>
        <div class="mb-2 text-zinc-700 dark:text-zinc-200 text-lg"><span class="font-medium">Estado:</span> <span id="modal-estado" class="inline-flex items-center px-2 py-1 text-base rounded font-medium"></span></div>
        <div class="mb-2 text-zinc-700 dark:text-zinc-200 text-base"><span class="font-medium">Fecha de cita:</span> <span id="modal-fecha"></span></div>
    <button onclick="document.getElementById('modal-bg').classList.add('hidden')" class="absolute top-2 right-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Cerrar</button>
    <button id="modal-cambiar-estado" class="mt-6 w-full px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition font-semibold">Cambiar estado</button>
    </div>
</div>

    @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">
            {{ session('success') }}
        </div>
    @endif


    <h1>Agenda de Citas</h1>
    <div id="calendar"></div>
    <hr>
    <h2 class="text-2xl font-bold mb-4">Listado de Citas</h2>
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-blue-100 dark:border-zinc-700 shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left font-sans dark:text-zinc-200">
            <thead class="bg-blue-50 dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 text-xs uppercase tracking-wider border-b border-blue-200 dark:border-zinc-700">
                <tr>
                    <th class="px-3 py-3 font-semibold whitespace-nowrap">Nombre</th>
                    <th class="px-3 py-3 font-semibold whitespace-nowrap">N° Afiliación</th>
                    <th class="px-3 py-3 font-semibold whitespace-nowrap">Fecha de Cita</th>
                    <th class="px-3 py-3 font-semibold whitespace-nowrap">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-50 dark:divide-zinc-700">
                @forelse($citas as $cita)
                <tr class="odd:bg-white even:bg-blue-50/50 dark:odd:bg-zinc-900 dark:even:bg-zinc-800 hover:bg-blue-100/60 dark:hover:bg-zinc-700 transition-colors">
                    <td class="px-3 py-3">{{ $cita->nombre }}</td>
                    <td class="px-3 py-3">{{ $cita->numero_afiliacion }}</td>
                    <td class="px-3 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d-m-Y') }}</td>
                    <td class="px-3 py-3">
                        <form method="POST" action="{{ route('agenda.updateEstado', $cita->id) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <select name="estado" class="px-2 py-1 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 text-xs">
                                <option value="pendiente" @selected($cita->estado==='pendiente')>Pendiente</option>
                                <option value="toma de muestras" @selected($cita->estado==='toma de muestras')>Toma de muestras</option>
                                <option value="proceso" @selected($cita->estado==='proceso')>Proceso</option>
                                <option value="finalizado" @selected($cita->estado==='finalizado')>Finalizado</option>
                            </select>
                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-700 transition">Aceptar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-3 py-3 text-center text-gray-500">No hay citas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
</div>


<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
<style>
    /* Hover para los días del calendario */
    .fc-daygrid-day:hover {
        background: #dbeafe !important;
        cursor: pointer;
        transition: background 0.2s;
    }
    /* Hover para eventos */
    .fc-daygrid-event:hover {
        background: #38bdf8 !important;
        color: #fff !important;
        box-shadow: 0 2px 8px rgba(56,189,248,0.2);
        transition: background 0.2s, color 0.2s;
    }
</style>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            @foreach($citas as $cita)
            {
                title: '{{ $cita->nombre }}',
                start: '{{ $cita->fecha_cita }}',
                afiliacion: '{{ $cita->numero_afiliacion }}',
                estado: '{{ $cita->estado }}',
                fecha: '{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d-m-Y') }}'
            },
            @endforeach
        ],
        eventClick: function(info) {
            document.getElementById('modal-nombre').textContent = info.event.title;
            document.getElementById('modal-afiliacion').textContent = info.event.extendedProps.afiliacion;
            document.getElementById('modal-estado').textContent = info.event.extendedProps.estado;
            document.getElementById('modal-fecha').textContent = info.event.extendedProps.fecha;
            document.getElementById('modal-bg').classList.remove('hidden');
           
            window._modalAfiliacion = info.event.extendedProps.afiliacion;
        },
        dateClick: function(info) {
            window.location.href = "{{ route('examens.create') }}?fecha_cita=" + info.dateStr;
        }
       
    });
    calendar.render();

    // Botón para cambiar estado desde el modal (solo una función)
    document.getElementById('modal-cambiar-estado').onclick = function() {
        document.getElementById('modal-bg').classList.add('hidden');
        var afiliacion = window._modalAfiliacion;
        if (!afiliacion) return;
        // Buscar la fila en la tabla
        var filas = document.querySelectorAll('table tbody tr');
        var encontrada = false;
        filas.forEach(function(fila) {
            var celdaAfiliacion = fila.querySelector('td:nth-child(2)');
            var celdaEstado = fila.querySelector('td:nth-child(4)');
            if (celdaAfiliacion && celdaAfiliacion.textContent.trim() === afiliacion && celdaEstado) {
                fila.scrollIntoView({behavior: 'smooth', block: 'center'});
                celdaEstado.classList.add('z-10');
                celdaEstado.style.transition = 'box-shadow 0.3s, transform 0.3s';
                celdaEstado.style.boxShadow = '0 8px 32px 0 rgba(34,197,94,0.7), 0 1.5px 6px 0 rgba(0,0,0,0.15)';
                celdaEstado.style.transform = 'scale(1.12) translateY(-4px)';
                encontrada = true;
                setTimeout(function() {
                    celdaEstado.style.boxShadow = '';
                    celdaEstado.style.transform = '';
                }, 2000);
            }
        });
        if (!encontrada) {
            alert('No se encontró la cita en la tabla.');
        }
    };
});
</script>

</x-layouts.app>
