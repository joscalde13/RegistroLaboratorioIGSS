<x-layouts.app :title="'Registro de Examen'">

<div class="w-full flex justify-center min-h-full">
    <div class="w-full max-w-6xl p-4 dark:bg-zinc-900 rounded-xl">
    <h2 class="text-2xl md:text-3xl font-semibold text-center mb-6 text-blue-900 dark:text-white tracking-tight">
            Registro de Examen de Laboratorio IGSS
        </h2>

    <form method="POST" action="{{ route('examens.store') }}" class="bg-white dark:bg-zinc-800 rounded-xl border border-blue-100 dark:border-zinc-700 shadow-sm p-6">
            @csrf
            
            <input type="hidden" name="fecha" value="{{ now()->toDateString() }}">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <!-- Fecha de cita -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Fecha de cita</label>
                    <input type="date" name="fecha_cita" value="{{ request('fecha_cita') ?? old('fecha_cita') }}" required
                        class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                </div>

                
                <!-- Fecha (solo visual) -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Fecha de creacion de registro</label>
              <input type="text" value="{{ date('d-m-Y') }}" disabled
                  class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-blue-50 dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none text-sm">
                </div>

                <!-- Correlativo (solo visual) -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Correlativo</label>
              <input type="text" value="{{ $nextCorrelativo ?? 1 }}" readonly
                  class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-blue-50 dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none text-sm">
                </div>

                <!-- Número de afiliación -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Número de afiliación</label>
              <input type="text" name="numero_afiliacion" value="{{ old('numero_afiliacion') }}" required
                  class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                </div>

                <!-- Nombre -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Nombre</label>
              <input type="text" name="nombre" value="{{ old('nombre') }}" required
                  class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                </div>

                <!-- Apellido -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Apellido</label>
              <input type="text" name="apellido" value="{{ old('apellido') }}" required
                  class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                </div>

                <!-- Sexo -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Sexo</label>
            <select name="sexo" required
                class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                        <option value="Masculino" @selected(old('sexo')==='Masculino')>Masculino</option>
                        <option value="Femenino" @selected(old('sexo')==='Femenino')>Femenino</option>
                    </select>
                </div>

                <!-- Calidad -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Calidad</label>
            <select name="calidad" required
                class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                        @foreach(['AF','BH','Pen','BE','NA'] as $c)
                            <option value="{{ $c }}" @selected(old('calidad')===$c)>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Edad -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Edad</label>
              <input type="number" name="edad" value="{{ old('edad') }}" required min="0"
                  class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                </div>

                <!-- Unidad -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Unidad</label>
            <select name="unidad" required
                class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                        @foreach(['Patulul','Pochuta','Santa Barbara','San Lucas Tolimán','Licores de Guatemala','Guatemala','Mazatenango'] as $u)
                            <option value="{{ $u }}" @selected(old('unidad')===$u)>{{ $u }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Área -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Área</label>
            <select name="area" required
                class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                        @foreach(['Consulta Externa','Encamamiento','Emergencia','Clínica de Personal'] as $a)
                            <option value="{{ $a }}" @selected(old('area')===$a)>{{ $a }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Programa -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Programa</label>
            <select name="programa" required
                class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                        @foreach(['Enfermedad Común','Gineco-Obstetricia','Pediatría','Traumatología y Ortopedia','Maternidad'] as $p)
                            <option value="{{ $p }}" @selected(old('programa')===$p)>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sección -->
                <div>
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Sección</label>
            <select name="seccion" required
                class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                        @foreach(['Hematología','Coprología','Urología','Bioquímica','Inmunología','Serología','Microbiología','Especiales','Coagulación'] as $s)
                            <option value="{{ $s }}" @selected(old('seccion')===$s)>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Perfil -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Perfil</label>
            <select name="perfil" id="perfil" required onchange="llenarPruebas()"
                class="w-full px-3 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
                        @foreach(['Pediatrico','Diabetes','Renal','Lipidos','Tiroide','Electrolitos','Reumatoideo','Coagulación','Ginecologico'] as $pr)
                            <option value="{{ $pr }}" @selected(old('perfil')===$pr)>{{ $pr }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Pruebas Section - Full width -->
            <div class="mt-6 border-t dark:border-zinc-700 pt-6">
                <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-3">Pruebas de Laboratorio</label>
                <div id="pruebas-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 mb-4">
                    <!-- Se rellena por JS -->
                </div>
                <div>
            <button type="button" id="btn-add-prueba"
                class="px-4 py-2 rounded-lg border border-blue-200 dark:border-zinc-700 text-blue-900 dark:text-zinc-200 bg-blue-50 dark:bg-zinc-900 hover:bg-blue-100 dark:hover:bg-zinc-800 transition text-sm">
                        + Añadir prueba
                    </button>
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-3">
                     <a href="{{ route('examens.index') }}" id="btn-cancelar"
                         class="px-6 py-3 rounded-lg text-gray-800 dark:text-zinc-200 font-semibold border border-gray-300 dark:border-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-800 transition text-center">
                    Cancelar
                </a>
        <button type="submit"
            class="px-6 py-3 rounded-lg text-white font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 shadow hover:scale-105 transition">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script>
    const perfiles = {
        'Pediatrico': ['Hematología', 'Heces', 'Orina'],
        'Diabetes': ['Glucosa', 'Post', 'Hemoglobina glicosilada'],
        'Renal': ['Creatinina', 'Nitrogeno de Urea'],
        'Lipidos': ['Colesterol', 'HDL', 'LDL', 'Trigliceridos'],
        'Tiroide': ['TSH', 'T3', 'T4', 'FTS', 'LH', 'FSH', 'Prolactina', 'Progesterona'],
        'Electrolitos': ['Sodio', 'Potasio', 'Cloruros'],
        'Reumatoideo': ['Proteina C Reactiva', 'Antiestreptolisina O2', 'Factor reumatoideo'],
        'Coagulación': ['TP', 'TPT'],
        'Ginecologico': ['VIH', 'Sifilis', 'TORCH']
    };

    function inputPruebaTemplate(valor = '') {
        return `
        <div class="flex items-center gap-2">
            <input type="text" name="pruebas[]" value="${valor}"
                   class="flex-1 px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" required>
            <button type="button" class="btn-remove-prueba px-2 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 text-sm">✕</button>
        </div>`;
    }

    function llenarPruebas() {
        const perfil = document.getElementById('perfil').value;
        const pruebas = perfiles[perfil] || [];
        const container = document.getElementById('pruebas-container');
        container.innerHTML = '';

        // Si hay old('pruebas') del backend, respétalas
        @if(is_array(old('pruebas')))
            const oldPruebas = @json(old('pruebas'));
            if (oldPruebas.length) {
                oldPruebas.forEach(p => container.insertAdjacentHTML('beforeend', inputPruebaTemplate(p)));
                return;
            }
        @endif

        if (pruebas.length) {
            pruebas.forEach(p => container.insertAdjacentHTML('beforeend', inputPruebaTemplate(p)));
        } else {
            container.insertAdjacentHTML('beforeend', inputPruebaTemplate(''));
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        llenarPruebas();

        // Añadir prueba manual
        document.getElementById('btn-add-prueba').addEventListener('click', () => {
            document.getElementById('pruebas-container').insertAdjacentHTML('beforeend', inputPruebaTemplate(''));
        });

        // Delegación para eliminar prueba
        document.getElementById('pruebas-container').addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-remove-prueba')) {
                const row = e.target.closest('.flex');
                if (row) row.remove();
            }
        });
    });
</script>
</x-layouts.app>