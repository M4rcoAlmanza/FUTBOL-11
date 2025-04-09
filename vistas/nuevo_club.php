<?php
session_start();
require_once '../negocio/nJugadores.php';

// Obtener temporada desde sesión o usar valor por defecto
$temporada = $_SESSION['temporada'] ?? 2024;

// Obtener jugadores de esa temporada
$nJugadores = new NJugadores();
$jugadores = $nJugadores->obtenerJugadoresPorTemporada($temporada);

// ---------------- FUNCIONES ----------------

// Devuelve un club aleatorio de la lista de jugadores
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

    // Elimina duplicados y vacíos
    $equipos = array_unique(array_filter($equipos));

    // Devuelve un club aleatorio, o null si no hay disponibles
    return empty($equipos) ? null : $equipos[array_rand($equipos)];
}

// ---------------- VALIDACIONES ----------------

// Si no hay jugadores, devolver error JSON
if (empty($jugadores)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No hay jugadores en la temporada seleccionada']);
    exit;
}

// Evitar repetir el mismo club consecutivamente
$clubViejo  = $_SESSION['club_actual'] ?? '';
$nuevoClub = asignarClub($jugadores);

// Reintentar hasta 10 veces si sale el mismo club que el anterior
$intentos = 0;
while ($nuevoClub === $clubViejo && $intentos < 10) {
    $nuevoClub = asignarClub($jugadores);
    $intentos++;
}

// Si no se pudo asignar un nuevo club distinto
if (!$nuevoClub) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No se pudo asignar un nuevo club']);
    exit;
}

// Guardar en sesión y responder
$_SESSION['club_actual'] = $nuevoClub;

header('Content-Type: application/json');
echo json_encode(['club' => $nuevoClub]);
?>
