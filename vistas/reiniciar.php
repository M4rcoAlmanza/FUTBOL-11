<?php
session_start();

// Limpiar alineación de sesión
unset($_SESSION['alineacion']);
unset($_SESSION['club_actual']);
unset($_SESSION['formacion']);
unset($_SESSION['temporada']);

// Redirigir a la página principal
header("Location: main.php");
exit;
