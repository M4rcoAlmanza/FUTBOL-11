<?php
session_start();
require_once '../negocio/nJugadores.php';

$nJugadores = new NJugadores();
$temporada = $_SESSION['temporada'] ?? 2024;
$jugadores = $nJugadores->obtenerJugadoresPorTemporada($temporada);

// Función para obtener un club aleatorio
function asignarClub($jugadores) {
    $equipos = [];

    foreach ($jugadores as $j) {
        $equipo = $j->getEquipo();
        if (is_array($equipo)) {
            $equipos = array_merge($equipos, $equipo);
        } else {
            $equipos[] = $equipo;
        }
    }

    $equipos = array_unique(array_filter($equipos)); // Limpia duplicados y vacíos
    return empty($equipos) ? null : $equipos[array_rand($equipos)];
}

// Si no hay jugadores, error
if (empty($jugadores)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No hay jugadores en la temporada seleccionada']);
    exit;
}

// Evitar repetir el mismo club
$clubViejo = $_SESSION['club_actual'] ?? '';
$nuevoClub = asignarClub($jugadores);

$intentos = 0;
while ($nuevoClub === $clubViejo && $intentos < 10) {
    $nuevoClub = asignarClub($jugadores);
    $intentos++;
}

if (!$nuevoClub) {
    echo json_encode(['error' => 'No se pudo asignar un nuevo club']);
    exit;
}

$_SESSION['club_actual'] = $nuevoClub;

// Salida JSON
header('Content-Type: application/json');
echo json_encode(['club' => $nuevoClub]);
