<x-layouts.app :title="'Registro de Examen'">

<div class="w-full flex justify-center h-screen">
    <div class="w-full max-w-5xl p-4 overflow-y-auto" style="max-height: 90vh;">
    <h2 class="text-2xl md:text-3xl font-semibold text-center mb-6 text-blue-900 tracking-tight">
        Registro de Examen de Laboratorio IGSS
    </h2>

    <form method="POST" action="{{ route('examens.store') }}" class="bg-white rounded-xl border border-blue-100 shadow-sm p-6">
        @csrf
        
        <input type="hidden" name="fecha" value="{{ now()->toDateString() }}">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        
            <!-- Fecha (solo visual) -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Fecha</label>
                <input type="text" value="{{ date('d-m-Y') }}" disabled
                       class="w-full px-4 py-2 rounded-xl border border-blue-200 bg-blue-50 text-blue-900 focus:outline-none">
            </div>

            <!-- Correlativo (solo visual) -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Correlativo</label>
                <input type="text" value="{{ $nextCorrelativo ?? 1 }}" readonly
                       class="w-full px-4 py-2 rounded-xl border border-blue-200 bg-blue-50 text-blue-900 focus:outline-none">
            </div>

            <!-- Número de afiliación -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Número de afiliación</label>
                <input type="text" name="numero_afiliacion" value="{{ old('numero_afiliacion') }}" required
                       class="w-full px-4 py-2 rounded-xl border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required
                       class="w-full px-4 py-2 rounded-xl border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <!-- Apellido -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Apellido</label>
                <input type="text" name="apellido" value="{{ old('apellido') }}" required
                       class="w-full px-4 py-2 rounded-xl border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <!-- Sexo -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Sexo</label>
                <select name="sexo" required
                        class="w-full px-4 py-2 rounded-xl border border-blue-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option value="Masculino" @selected(old('sexo')==='Masculino')>Masculino</option>
                    <option value="Femenino" @selected(old('sexo')==='Femenino')>Femenino</option>
                </select>
            </div>

            <!-- Calidad -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Calidad</label>
                <select name="calidad" required
                        class="w-full px-4 py-2 rounded-xl border border-blue-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                    @foreach(['AF','BH','Pen','BE','NA'] as $c)
                        <option value="{{ $c }}" @selected(old('calidad')===$c)>{{ $c }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Edad -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Edad</label>
                <input type="number" name="edad" value="{{ old('edad') }}" required min="0"
                       class="w-full px-4 py-2 rounded-xl border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <!-- Unidad -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Unidad</label>
                <select name="unidad" required
                        class="w-full px-4 py-2 rounded-xl border border-blue-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                    @foreach(['Patulul','Pochuta','Santa Barbara','San Lucas Tolimán','Licores de Guatemala','Guatemala','Mazatenango'] as $u)
                        <option value="{{ $u }}" @selected(old('unidad')===$u)>{{ $u }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Área -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Área</label>
                <select name="area" required
                        class="w-full px-4 py-2 rounded-xl border border-blue-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                    @foreach(['Consulta Externa','Encamamiento','Emergencia','Clínica de Personal'] as $a)
                        <option value="{{ $a }}" @selected(old('area')===$a)>{{ $a }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Programa -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Programa</label>
                <select name="programa" required
                        class="w-full px-4 py-2 rounded-xl border border-blue-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                    @foreach(['Enfermedad Común','Gineco-Obstetricia','Pediatría','Traumatología y Ortopedia','Maternidad'] as $p)
                        <option value="{{ $p }}" @selected(old('programa')===$p)>{{ $p }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sección -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Sección</label>
                <select name="seccion" required
                        class="w-full px-4 py-2 rounded-xl border border-blue-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                    @foreach(['Hematología','Coprología','Urología','Bioquímica','Inmunología','Serología','Microbiología','Especiales','Coagulación'] as $s)
                        <option value="{{ $s }}" @selected(old('seccion')===$s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Perfil -->
            <div>
                <label class="block text-sm font-medium text-blue-900 mb-1">Perfil</label>
                <select name="perfil" id="perfil" required onchange="llenarPruebas()"
                        class="w-full px-4 py-2 rounded-xl border border-blue-200 bg-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                    @foreach(['Pediatrico','Diabetes','Renal','Lipidos','Tiroide','Electrolitos','Reumatoideo','Coagulación','Ginecologico'] as $pr)
                        <option value="{{ $pr }}" @selected(old('perfil')===$pr)>{{ $pr }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pruebas -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-blue-900 mb-2">Pruebas</label>
                <div id="pruebas-container" class="space-y-2">
                    <!-- Se rellena por JS -->
                </div>
                <div class="mt-3">
                    <button type="button" id="btn-add-prueba"
                            class="px-4 py-2 rounded-xl border border-blue-200 text-blue-900 bg-blue-50 hover:bg-blue-100 transition">
                        + Añadir prueba
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('examens.index') }}" id="btn-cancelar"
               class="ml-2 px-6 py-3 rounded-xl text-gray-800 font-semibold border border-gray-300 hover:bg-gray-50 transition">
                Cancelar
            </a>
            <span class="inline-block w-4"></span>
            <button type="submit"
                    class="px-6 py-3 rounded-xl text-white font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 shadow hover:scale-105 transition">
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
                   class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            <button type="button" class="btn-remove-prueba px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">✕</button>
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
