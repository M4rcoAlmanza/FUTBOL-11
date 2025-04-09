<script>
// ---------------- CONFIGURACIÓN DE POSICIONES COMPATIBLES ----------------
const compatibilidadPosiciones = {
    'POR': ['PO'],
    'CB1': ['DF'], 'CB2': ['DF'], 'CB3': ['DF'],
    'LI': ['LI'], 'LD': ['LD'],
    'MI': ['EI','MI'], 'MD': ['ED','MD'],
    'MC1': ['MC', 'MCD'], 'MC2': ['MC', 'MCD'],
    'MCO': ['MCO', 'MC'], 'MCO1': ['MCO', 'MC'], 'MCO2': ['MCO', 'MC'], 'MCO3': ['MCO', 'MC'],
    'EI': ['EI', 'MI'], 'ED': ['ED', 'MD'],
    'DC': ['DC'], 'DC1': ['DC'], 'DC2': ['DC']
};

// ---------------- FUNCIONES PRINCIPALES ----------------
function asignarJugador(posicion, jugador) {
    let alineacion = JSON.parse(localStorage.getItem("alineacion")) || {};

    if (alineacion[posicion]) {
        alert(`Ya hay un jugador en la posición: ${posicion}`);
        return;
    }

    for (let pos in alineacion) {
        if (alineacion[pos].toLowerCase() === jugador.toLowerCase()) {
            alert(`Este jugador ya fue asignado en la posición: ${pos}`);
            return;
        }
    }

    alineacion[posicion] = jugador;
    localStorage.setItem("alineacion", JSON.stringify(alineacion));

    const div = document.getElementById(`pos-${posicion}`);
    if (div) div.innerText = jugador;

    fetch('asignarJugador.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({posicion, jugador})
    });
}

function confirmarJugador() {
    const input = document.querySelector('input[name="jugador_nombre"]');
    const select = document.getElementById("select-posicion");

    const nombreJugador = input.value.trim();
    const posicion = select.value;

    if (!nombreJugador || !posicion) {
        alert("Completa todos los campos.");
        return;
    }

    // const jugador = jugadores.find(j => j.nombre.toLowerCase() === nombreJugador.toLowerCase());
    // if (!jugador) {
    //     alert("El jugador no fue encontrado en la base de datos.");
    //     return;
    // }

    const coincidencias = jugadores.filter(j => j.nombre.toLowerCase() === nombreJugador.toLowerCase());

    if (coincidencias.length === 0) {
        alert("El jugador no fue encontrado en la base de datos.");
        return;
    }

    // Buscar uno que sí pertenezca al club actual
    const jugador = coincidencias.find(j => {
        const equipos = Array.isArray(j.equipo)
            ? j.equipo
            : j.equipo.split(',').map(e => e.trim().toLowerCase());
        return equipos.includes(clubActual.toLowerCase());
    });

    if (!jugador) {
        alert(`No se encontró un jugador llamado ${nombreJugador} que pertenezca al club ${clubActual}.`);
        return;
    }


    // Validar compatibilidad de posición
    const compatibles = compatibilidadPosiciones[posicion] || [];
    if (!compatibles.includes(jugador.posicion)) {
        alert(`El jugador ${jugador.nombre} no es compatible con la posición ${posicion}.`);
        return;
    }

    // Asignar jugador y avanzar
    asignarJugador(posicion, jugador.nombre);
    cambiarClub();
    limpiarCampos(input, select);
}

function cambiarClub() {
    fetch('nuevo_club.php')
        .then(res => res.json())
        .then(data => {
            clubActual = data.club;
            localStorage.setItem("club_actual", clubActual);
            document.querySelector('#club-actual').innerText = clubActual.toUpperCase();

            // Actualizar escudo del club
            const escudo = document.getElementById('escudo');
            if (escudo) {
                escudo.src = `img/300x300/${clubActual}.png`;
                escudo.alt = `Escudo de ${clubActual}`;
            }
        });
}

function limpiarCampos(input, select) {
    input.value = '';
    const option = select.querySelector(`option[value="${select.value}"]`);
    if (option) option.remove();

    if (select.options.length === 0) {
        document.getElementById("form-insercion").style.display = "none";
        new bootstrap.Modal(document.getElementById('finModal')).show();
    }
}

// ---------------- CARGAR JUGADORES YA ASIGNADOS AL INICIO ----------------
window.onload = function() {
    const alineacion = JSON.parse(localStorage.getItem("alineacion")) || {};
    const select = document.getElementById("select-posicion");

    for (let pos in alineacion) {
        const div = document.getElementById(`pos-${pos}`);
        if (div) div.innerText = alineacion[pos];

        const option = select.querySelector(`option[value="${pos}"]`);
        if (option) option.remove();
    }

    const total = <?= count($posiciones) ?>;
    if (Object.keys(alineacion).length >= total) {
        document.getElementById("form-insercion").style.display = "none";
        new bootstrap.Modal(document.getElementById('finModal')).show();
    }
};

// ---------------- AUTOCOMPLETADO DE INPUT DE JUGADOR ----------------
const inputJugador = document.getElementById("input-jugador");
const datalist = document.getElementById("lista-jugadores");

const nombresJugadores = [
    <?php foreach ($jugadores as $j): ?>
        "<?= addslashes($j->getNombre()) ?>",
    <?php endforeach; ?>
];

inputJugador.addEventListener("input", () => {
    const valor = inputJugador.value.trim().toLowerCase();
    datalist.innerHTML = '';

    if (valor.length < 3) return;

    const sugerencias = nombresJugadores.filter(nombre =>
        nombre.toLowerCase().includes(valor)
    );

    datalist.innerHTML = sugerencias.map(nombre => `<option value="${nombre}">`).join('');
});

// ---------------- CONFIRMAR REINICIO ----------------
function confirmarReinicio() {
    return confirm("¿Estás seguro de que quieres reiniciar la alineación? Se perderán todos los jugadores actuales.");
}
</script>
