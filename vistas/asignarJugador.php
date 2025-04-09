<?php
session_start(); // Iniciar sesión para acceder a $_SESSION

// ------------------ VERIFICAR QUE LLEGARON DATOS POR POST ------------------
if (!isset($_POST['posicion'], $_POST['jugador'])) {
    http_response_code(400); // Respuesta HTTP 400: Bad Request
    echo json_encode([
        'status' => 'error',
        'message' => 'Datos incompletos.'
    ]);
    exit;
}

$posicion = $_POST['posicion'];
$jugador  = $_POST['jugador'];

// ------------------ INICIALIZAR LA ALINEACIÓN SI NO EXISTE ------------------
if (!isset($_SESSION['alineacion'])) {
    $_SESSION['alineacion'] = []; // Crear arreglo vacío
}

// ------------------ VALIDAR SI LA POSICIÓN YA ESTÁ OCUPADA ------------------
if (isset($_SESSION['alineacion'][$posicion])) {
    echo json_encode([
        'status' => 'error',
        'message' => "Ya hay un jugador en la posición '$posicion'."
    ]);
    exit;
}

// ------------------ VALIDAR SI EL JUGADOR YA FUE ASIGNADO EN OTRA POSICIÓN ------------------
if (in_array($jugador, $_SESSION['alineacion'])) {
    echo json_encode([
        'status' => 'error',
        'message' => "El jugador '$jugador' ya está asignado en otra posición."
    ]);
    exit;
}

// ------------------ ASIGNAR JUGADOR A LA POSICIÓN ------------------
$_SESSION['alineacion'][$posicion] = $jugador;

// ------------------ RESPUESTA EXITOSA ------------------
echo json_encode([
    'status'     => 'ok',
    'message'    => "Jugador asignado a $posicion.",
    'alineacion' => $_SESSION['alineacion'] // Devolver alineación completa por si se necesita
]);
?>
