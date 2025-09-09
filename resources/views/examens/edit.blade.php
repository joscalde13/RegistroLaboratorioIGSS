
<x-layouts.app :title="'Editar Examen'">

<div class="w-full flex justify-center h-screen">
    <div class="w-full max-w-5xl p-4 dark:bg-zinc-900 rounded-xl overflow-y-auto" style="max-height: 90vh;">
    <h2 class="text-2xl md:text-3xl font-semibold text-center mb-6 text-blue-900 dark:text-white tracking-tight">
        Editar Examen de Laboratorio IGSS
    </h2>

    <form method="POST" action="{{ route('examens.update', $examen->id) }}" class="bg-white dark:bg-zinc-800 rounded-xl border border-blue-100 dark:border-zinc-700 shadow-sm p-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="fecha" value="{{ $examen->fecha }}">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Fecha (solo visual) -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Fecha</label>
         <input type="text" value="{{ \Carbon\Carbon::parse($examen->fecha)->format('d-m-Y') }}" disabled
             class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-blue-50 dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none">
        </div>
        <!-- Correlativo (solo visual) -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Correlativo</label>
         <input type="text" value="{{ $examen->correlativo }}" readonly
             class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-blue-50 dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none">
        </div>
        <!-- Número de afiliación -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Número de afiliación</label>
         <input type="text" name="numero_afiliacion" value="{{ old('numero_afiliacion', $examen->numero_afiliacion) }}" required
             class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>
        <!-- Nombre -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Nombre</label>
         <input type="text" name="nombre" value="{{ old('nombre', $examen->nombre) }}" required
             class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>
        <!-- Apellido -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Apellido</label>
         <input type="text" name="apellido" value="{{ old('apellido', $examen->apellido) }}" required
             class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>
        <!-- Sexo -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Sexo</label>
        <select name="sexo" required
            class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="Masculino" @selected(old('sexo', $examen->sexo)==='Masculino')>Masculino</option>
                <option value="Femenino" @selected(old('sexo', $examen->sexo)==='Femenino')>Femenino</option>
            </select>
        </div>
        <!-- Calidad -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Calidad</label>
        <select name="calidad" required
            class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                @foreach(['AF','BH','Pen','BE','NA'] as $c)
                    <option value="{{ $c }}" @selected(old('calidad', $examen->calidad)===$c)>{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <!-- Edad -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Edad</label>
         <input type="number" name="edad" value="{{ old('edad', $examen->edad) }}" required min="0"
             class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>
        <!-- Unidad -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Unidad</label>
        <select name="unidad" required
            class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                @foreach(['Patulul','Pochuta','Santa Barbara','San Lucas Tolimán','Licores de Guatemala','Guatemala','Mazatenango'] as $u)
                    <option value="{{ $u }}" @selected(old('unidad', $examen->unidad)===$u)>{{ $u }}</option>
                @endforeach
            </select>
        </div>
        <!-- Área -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Área</label>
        <select name="area" required
            class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                @foreach(['Consulta Externa','Encamamiento','Emergencia','Clínica de Personal'] as $a)
                    <option value="{{ $a }}" @selected(old('area', $examen->area)===$a)>{{ $a }}</option>
                @endforeach
            </select>
        </div>
        <!-- Programa -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Programa</label>
        <select name="programa" required
            class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                @foreach(['Enfermedad Común','Gineco-Obstetricia','Pediatría','Traumatología y Ortopedia','Maternidad'] as $p)
                    <option value="{{ $p }}" @selected(old('programa', $examen->programa)===$p)>{{ $p }}</option>
                @endforeach
            </select>
        </div>
        <!-- Sección -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Sección</label>
        <select name="seccion" required
            class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                @foreach(['Hematología','Coprología','Urología','Bioquímica','Inmunología','Serología','Microbiología','Especiales','Coagulación'] as $s)
                    <option value="{{ $s }}" @selected(old('seccion', $examen->seccion)===$s)>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <!-- Perfil -->
        <div>
            <label class="block text-sm font-medium text-blue-900 dark:text-zinc-200 mb-1">Perfil</label>
        <select name="perfil" id="perfil" required onchange="llenarPruebas()"
            class="w-full px-4 py-2 rounded-xl border border-blue-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-blue-900 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                @foreach(['Pediatrico','Diabetes','Renal','Lipidos','Tiroide','Electrolitos','Reumatoideo','Coagulación','Ginecologico'] as $pr)
                    <option value="{{ $pr }}" @selected(old('perfil', $examen->perfil)===$pr)>{{ $pr }}</option>
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
        <a href="{{ route('examens.index') }}"
           class="ml-2 px-6 py-3 rounded-xl text-white-800 font-semibold border border-gray-300 hover:bg-gray-50 transition inline-block">
            Cancelar
        </a>
        <span class="inline-block w-4"></span>
        <button type="submit"
                class="px-6 py-3 rounded-xl text-white font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 shadow hover:scale-105 transition">
            Actualizar
        </button>
    </div>
    </form>
    </div>
</div>

<!-- JS para pruebas -->
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

    let pruebasIniciales = null;
    function llenarPruebas(usandoPerfil = false) {
        const perfil = document.getElementById('perfil').value;
        const container = document.getElementById('pruebas-container');
        container.innerHTML = '';

        // Al cargar la vista, usar las pruebas guardadas del examen
        if (!usandoPerfil) {
            if (pruebasIniciales === null) {
                @php
                    $oldPruebas = old('pruebas', json_decode($examen->pruebas, true));
                @endphp
                @if(is_array($oldPruebas))
                    pruebasIniciales = @json($oldPruebas);
                @else
                    pruebasIniciales = [];
                @endif
            }
            if (pruebasIniciales.length) {
                pruebasIniciales.forEach(p => container.insertAdjacentHTML('beforeend', inputPruebaTemplate(p)));
                return;
            }
        }

        // Si el usuario selecciona otro perfil, cargar las pruebas por defecto
        const pruebas = perfiles[perfil] || [];
        if (pruebas.length) {
            pruebas.forEach(p => container.insertAdjacentHTML('beforeend', inputPruebaTemplate(p)));
        } else {
            container.insertAdjacentHTML('beforeend', inputPruebaTemplate(''));
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        llenarPruebas(false);

        // Cambiar pruebas solo si el usuario selecciona otro perfil
        document.getElementById('perfil').addEventListener('change', () => {
            llenarPruebas(true);
        });

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