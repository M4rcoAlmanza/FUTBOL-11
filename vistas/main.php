<?php
$titulo = "FUTBOL 11 - Liga MX";
require_once 'componentes/encabezado.php';
require_once 'componentes/navbar.php';
require_once '../negocio/nJugadores.php';

require_once 'modales/modalInicio.php';

$nJugadores = new NJugadores();
$jugadores = $nJugadores->obtenerJugadoresPorTemporada($_SESSION['temporada']);

if (empty($jugadores)) {
    die("No se encontraron jugadores para la temporada ".$_SESSION['temporada'].".");
}

// Simula un club aleatorio
function asignarClub($jugadores) {
    $equipos = [];

    foreach ($jugadores as $j) {
        $equipo = $j->getEquipo();
        $equipos = array_merge($equipos, is_array($equipo) ? $equipo : [$equipo]);
    }

    $equipos = array_unique(array_filter($equipos));
    return $equipos[array_rand($equipos)];
}

// Guardar en sesión si no se ha asignado ya
if (!isset($_SESSION['club_actual'])) {
    $_SESSION['club_actual'] = asignarClub($jugadores);
}

require_once 'js/asignarJugadores.php';
?>

<div class="container mt-4 text-white">
    <h2 class="text-center mb-2 text-black">ALINEACIÓN LIGA MX</h2>
    <h4 class="text-center mb-4 text-black">Temporada <?= ($_SESSION['temporada']) ?></h4>

    <!-- Campo con posiciones -->
    <div class="bg-dark p-4 rounded border border-info" style="position: relative; height: 500px;">
        <?php require_once 'componentes/posiciones.php'?>
    </div>

    <!-- Club actual e input -->
    <div class="mt-4 text-center">
        <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
        <img src="img/300x300/<?= is_array($_SESSION['club_actual']) ? $_SESSION['club_actual'][0] : $_SESSION['club_actual'] ?>.png" id="escudo" alt="Escudo del club" class="img-fluid rounded" style="max-width: 50px;">
        <h4 class="text-black mb-0">
            <span id="club-actual" class="text-primary-emphasis">
                <?= strtoupper(is_array($_SESSION['club_actual']) ? implode(', ', $_SESSION['club_actual']) : $_SESSION['club_actual']) ?>
            </span>
        </h4>
    </div>


    <div id="form-insercion" class="d-flex justify-content-center align-items-center mt-3 gap-2">
        <input type="text" id="input-jugador" name="jugador_nombre" class="form-control w-25" placeholder="Escribe un jugador..." list="lista-jugadores" required maxlength="30">
        <datalist id="lista-jugadores"></datalist>
        
        <select id="select-posicion" class="form-select w-25" required>
            <?php
                foreach ($posiciones as $pos) {
                    $posTexto = preg_replace('/\d+$/', '', $pos); // MC1 → MC
                    echo "<option value=\"$pos\">$posTexto</option>";
                }
            ?>
        </select>
        <button onclick="confirmarJugador()" class="btn btn-success">⚽ Confirmar</button>
    </div>

    <form action="reiniciar.php" method="POST" class="text-center mt-3" onsubmit="return confirmarReinicio()">
        <button type="submit" class="btn btn-danger">🔄 Reiniciar Alineación</button>
    </form>

</div>

<?php 
require_once 'js/confirmar.php';
require_once 'js/borrar.php';
require_once 'componentes/footBar.php'; 
require_once 'modales/ganar.php';
?>
