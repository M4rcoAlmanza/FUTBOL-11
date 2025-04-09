<script>
const jugadores = <?= json_encode(array_map(function($j) {
    $equipos = is_array($j->getEquipo()) ? implode(', ', $j->getEquipo()) : $j->getEquipo();
    return [
        'label' => $j->getNombre(),
        'equipo' => $j->getEquipo(),
        'posicion' => $j->getPosicion()

    ];
}, $jugadores)) ?>;

$(function() {
    $("#input-jugador").autocomplete({
        source: jugadores,
        minLength: 1
    }).autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li>")
            // .append("<div>" + item.label + " <small class='text-muted'>(" + item.equipo + ")</small></div>")
            .append("<div>" + item.label + " <small class='text-muted'>(" + item.equipo + " - " + item.posicion + ")</small></div>")
            .appendTo(ul);
    };
});
</script>
