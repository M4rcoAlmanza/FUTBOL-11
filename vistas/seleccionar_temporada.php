<?php
session_start();

$modo = $_POST['modo'] ?? 'normal';

if ($modo === 'facil') {
    $_SESSION['temporada'] = rand(2021,2024);
}elseif ($modo === 'normal') {
    $_SESSION['temporada'] = rand(2010,2020);
}elseif ($modo === 'difícil') {
    $_SESSION['temporada'] = rand(1996,2009);
}elseif ($modo === 'temporada') {
    $_SESSION['temporada'] = (int) $_POST['temporada'];
} else {
    // Selección aleatoria entre 1996-2024
    $_SESSION['temporada'] = rand(1996, 2024);
}

header('Location: main.php');
exit;
