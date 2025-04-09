<script>
    // OBTIENE LOS JUGADORES Y LOS TRANSFORMA A JS PARA USARLOS ACTIVAMENTE
    const jugadores = <?= json_encode(array_map(function($j) {
        return [
            'nombre' => $j->getNombre(),
            'equipo' => implode(', ', $j->getEquipo()),
            'posicion' => $j->getPosicion()
        ];
    }, $jugadores)) ?>;

    let clubActual = "<?= $_SESSION['club_actual'] ?>";
</script>
