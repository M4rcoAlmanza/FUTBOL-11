<script>
const compatibilidadPosiciones = {
    'POR': ['PO'],
    'CB1': ['DF'], 'CB2': ['DF'], 'CB3': ['DF'],
    'LI': ['LI'],
    'LD': ['LD'],
    'MI': ['EI','MI'],
    'MD': ['ED','MD'],
    'MC1': ['MC', 'MCD'], 
    'MC2': ['MC', 'MCD'],
    'MCO': ['MCO', 'MC'],
    'MCO1': ['MCO', 'MC'], 'MCO2': ['MCO', 'MC'], 'MCO3': ['MCO', 'MC'],
    'EI': ['EI', 'MI'],
    'ED': ['ED', 'MD'],
    'DC': ['DC'],
    'DC1': ['DC'], 'DC2': ['DC']
};


function asignarJugador(posicion, jugador) {
    let alineacion = JSON.parse(localStorage.getItem("alineacion")) || {};

    // Verificar que la posición ya esté ocupada
    if (alineacion[posicion]) {
        alert("Ya hay un jugador en la posición: " + posicion);
        return;
    }

    // Verificar que el jugador no esté repetido
    for (let pos in alineacion) {
        if (alineacion[pos].toLowerCase() === jugador.toLowerCase()) {
            alert("Este jugador ya fue asignado en la posición: " + pos);
            return;
        }
    }

    alineacion[posicion] = jugador;
    localStorage.setItem("alineacion", JSON.stringify(alineacion));

    // Mostrar en el campo visual
    const div = document.getElementById("pos-" + posicion);
    if (div) div.innerText = jugador;

    // Guardar también en sesión
    fetch('asignarJugador.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({posicion, jugador})
    });
}


function confirmarJugador() {
    const inputJugador = document.querySelector('input[name="jugador_nombre"]');
    const selectPos = document.getElementById("select-posicion");

    const jugadorInput = inputJugador.value.trim();
    const posicion = selectPos.value;

    if (!jugadorInput || !posicion) {
        alert("Completa todos los campos.");
        return;
    }

    const jugadorEncontrado = jugadores.find(j => j.nombre.toLowerCase() === jugadorInput.toLowerCase());

    if (!jugadorEncontrado) {
        alert("El jugador no fue encontrado en la base de datos.");
        return;
    }

    // Validar si pertenece al club actual
    const equiposJugador = Array.isArray(jugadorEncontrado.equipo)
        ? jugadorEncontrado.equipo
        : jugadorEncontrado.equipo.split(',').map(e => e.trim());

    if (!equiposJugador.map(e => e.toLowerCase()).includes(clubActual.toLowerCase())) {
        alert(`El jugador ${jugadorEncontrado.nombre} no pertenece al club ${clubActual}.`);
        return;
    }


    const compatibles = compatibilidadPosiciones[posicion] || [];

    if (!compatibles.includes(jugadorEncontrado.posicion)) {
        alert(`El jugador ${jugadorEncontrado.nombre}, no es compatible con la posición ${posicion}.`);
        return;
    }

    // Guardar jugador
    asignarJugador(posicion, jugadorEncontrado.nombre);

    // Cambiar de club
    fetch('nuevo_club.php')
        .then(res => res.json())
        .then(data => {
            document.querySelector('#club-actual').innerText = data.club.toUpperCase();
            clubActual = data.club;
            localStorage.setItem("club_actual", clubActual);
        });

    // Limpiar input de jugador
    inputJugador.value = '';

    // Eliminar la opción usada del select
    const optionToRemove = selectPos.querySelector(`option[value="${posicion}"]`);
    if (optionToRemove) optionToRemove.remove();

    // Si ya no hay más posiciones disponibles
    if (selectPos.options.length === 0) {
        // Oculta el formulario
        document.getElementById("form-insercion").style.display = "none";

        // Mostrar el modal
        const finModal = new bootstrap.Modal(document.getElementById('finModal'));
        finModal.show();
    }
}

// Muestra a los jugadores ya puestos y almacenados en la sesión
window.onload = function() {
    const alineacion = JSON.parse(localStorage.getItem("alineacion")) || {};
    const selectPos = document.getElementById("select-posicion");

    for (let pos in alineacion) {
        const div = document.getElementById("pos-" + pos);
        if (div) {
            div.innerText = alineacion[pos];
        }

        // Eliminar del <select> si ya está asignado
        const optionToRemove = selectPos.querySelector(`option[value="${pos}"]`);
        if (optionToRemove) optionToRemove.remove();
    }

    const totalPosiciones = <?= count($posiciones) ?>;
    // Si ya se llenó la alineación, ocultar el formulario y mostrar el modal
    if (Object.keys(alineacion).length >= totalPosiciones) {
        document.getElementById("form-insercion").style.display = "none";
        const finModal = new bootstrap.Modal(document.getElementById('finModal'));
        finModal.show();
    }
};

const inputJugador = document.getElementById("input-jugador");
const datalist = document.getElementById("lista-jugadores");

// Lista completa de jugadores desde PHP en JS
const nombresJugadores = [
    <?php foreach ($jugadores as $j): ?>
        "<?= addslashes($j->getNombre()) ?>",
    <?php endforeach; ?>
];

inputJugador.addEventListener("input", () => {
    const value = inputJugador.value.trim().toLowerCase();

    // Solo sugerir si hay al menos 3 letras
    if (value.length < 3) {
        datalist.innerHTML = '';
        return;
    }

    const sugerencias = nombresJugadores.filter(nombre => nombre.toLowerCase().includes(value));
    
    datalist.innerHTML = sugerencias.map(nombre => `<option value="${nombre}">`).join('');
});

function confirmarReinicio() {
    return confirm("¿Estás seguro de que quieres reiniciar la alineación? Se perderán todos los jugadores actuales.");
}
</script>