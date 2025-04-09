<script>
// ----------------- CARGA DE JUGADORES DESDE PHP A JS -----------------
// Creamos un array JS con nombre (label), equipo(s) y posición para cada jugador
const jugadores = <?= json_encode(array_map(function($j) {
    return [
        'label'    => $j->getNombre(),         // Usado como valor mostrado en el input
        'equipo'   => $j->getEquipo(),         // Puede ser string o array (uno o varios equipos)
        'posicion' => $j->getPosicion()        // Posición principal del jugador
    ];
}, $jugadores)) ?>;

$(function() {
    // ----------------- AUTOCOMPLETE CONFIGURACIÓN -----------------
    $("#input-jugador").autocomplete({
        source: jugadores,    // Lista de sugerencias
        minLength: 1          // Activar desde el primer carácter
    })
    // Personalización de cómo se renderiza cada sugerencia en la lista
    .autocomplete("instance")._renderItem = function(ul, item) {
        // Convertir a texto plano si el equipo es array
        const equipos = Array.isArray(item.equipo) 
            ? item.equipo.join(", ") 
            : item.equipo;

        // Crear el <li> personalizado con nombre en negrita y equipo/posición en texto más pequeño
        return $("<li>").append(`
            <div>
                <strong>${item.label}</strong><br>
                <small class="text-muted">${equipos} - ${item.posicion}</small>
            </div>
        `).appendTo(ul);
    };
});
</script>
