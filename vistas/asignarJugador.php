<?php
session_start();

// Verificar que llegaron los datos por POST
if (!isset($_POST['posicion'], $_POST['jugador'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
    exit;
}

$posicion = $_POST['posicion'];
$jugador = $_POST['jugador'];

// Inicializar la alineación en la sesión si no existe
if (!isset($_SESSION['alineacion'])) {
    $_SESSION['alineacion'] = [];
}

// Validar si ya hay un jugador en esa posición
if (isset($_SESSION['alineacion'][$posicion])) {
    echo json_encode([
        'status' => 'error',
        'message' => "Ya hay un jugador en la posición '$posicion'."
    ]);
    exit;
}

// Validar si el jugador ya fue asignado en otra posición
if (in_array($jugador, $_SESSION['alineacion'])) {
    echo json_encode([
        'status' => 'error',
        'message' => "El jugador '$jugador' ya está asignado en otra posición."
    ]);
    exit;
}

// Guardar el jugador en la sesión
$_SESSION['alineacion'][$posicion] = $jugador;

echo json_encode([
    'status' => 'ok',
    'message' => "Jugador asignado a $posicion.",
    'alineacion' => $_SESSION['alineacion']
]);
?>

<script>
    
</script>