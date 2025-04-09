<script>
const jugadores = <?= json_encode(array_map(function($j) {
    return [
        'nombre' => $j->getNombre(),
        'equipo' => implode(', ', $j->getEquipo()), // convierte array a string
        'posicion' => $j->getPosicion()
    ];
}, $jugadores)) ?>;

let clubActual = "<?= $_SESSION['club_actual'] ?>";
</script>
