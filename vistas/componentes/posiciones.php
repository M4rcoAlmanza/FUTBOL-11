<?php

$formaciones = ["433", "343", "422", "4231", "352", "532"];

// Generar foMDación aleatoria si no existe aún
if (!isset($_SESSION['formacion'])) {
    $formaciones = ["433", "343", "442", "4231", "352", "532"];
    $_SESSION['formacion'] = $formaciones[array_rand($formaciones)];
}
$pos = $_SESSION['formacion'];

if($pos=="343"){
    $posiciones = ['DC', 'EI', 'ED', 'MI', 'MD', 'MC1', 'MC2', 'CB1', 'CB2', 'CB3', 'POR'];
    $posicionesCSS = [
        'DC'=> 'top: 20px; left: calc(50% - 75px);',
        'EI'=> 'top: 80px; left: 5%;',
        'ED'=> 'top: 80px; right: 5%;',
        'MI'=> 'top: 140px; left: 15%;',
        'MD'=> 'top: 140px; right: 15%;',
        'MC1'=> 'top: 200px; left: 30%;',
        'MC2'=> 'top: 200px; right: 30%;',
        'CB1'=> 'top: 300px; left: 15%;',
        'CB2'=> 'top: 300px; left: calc(50% - 75px);',
        'CB3'=> 'top: 300px; right: 15%;',
        'POR'=> 'bottom: 20px; left: calc(50% - 75px);',
    ];
}else if($pos=="433"){
    $posiciones = ['DC', 'EI', 'ED', 'MCO', 'MC1', 'MC2', 'LI', 'CB1', 'CB2', 'LD', 'POR'];
    $posicionesCSS = [
       'DC'=> 'top: 20px; left: calc(50% - 75px);',
        'EI'=> 'top: 80px; left: 5%;',
        'ED'=> 'top: 80px; right: 5%;',
        'MCO'=> 'top: 140px; left: calc(50% - 75px);',
        'MC1'=> 'top: 190px; left: 20%;',
        'MC2'=> 'top: 190px; right: 20%;',
        'LI'=> 'top: 260px; left: 5%;',
        'LD'=> 'top: 260px; right: 5%;',
        'CB1'=> 'top: 320px; left: 25%;',
        'CB2'=> 'top: 320px; right: 25%;',
        'POR'=> 'bottom: 20px; left: calc(50% - 75px);',
    ];
}else if($pos=="442"){
    $posiciones = ['DC1', 'DC2', 'MI', 'MC1', 'MC2', 'MD', 'LI', 'CB1', 'CB2', 'LD', 'POR'];
    $posicionesCSS = [
        'DC1'=> 'top: 20px; left: 35%;',
        'DC2'=> 'top: 20px; right: 35%;',
        'MI'=> 'top: 100px; left: 5%;',
        'MC1'=> 'top: 130px; left: 25%;',
        'MC2'=> 'top: 130px; right: 25%;',
        'MD'=> 'top: 100px; right: 5%;',
        'LI'=> 'top: 220px; left: 5%;',
        'LD'=> 'top: 220px; right: 5%;',
        'CB1'=> 'top: 270px; left: 25%;',
        'CB2'=> 'top: 270px; right: 25%;',
        'POR'=> 'bottom: 20px; left: calc(50% - 75px);',
    ];
}else if($pos=="4231"){
    $posiciones = ['DC', 'MCO1', 'MCO2', 'MCO3', 'MC1', 'MC2', 'LI', 'CB1', 'CB2', 'LD', 'POR'];
    $posicionesCSS = [
        'DC'=> 'top: 20px; left: calc(50% - 75px);',
        'MCO1'=> 'top: 80px; left: 20%;',
        'MCO2'=> 'top: 80px; left: calc(50% - 75px);',
        'MCO3'=> 'top: 80px; right: 20%;',
        'MC1'=> 'top: 150px; left: 25%;',
        'MC2'=> 'top: 150px; right: 25%;',
        'LI'=> 'top: 220px; left: 5%;',
        'LD'=> 'top: 220px; right: 5%;',
        'CB1'=> 'top: 270px; left: 25%;',
        'CB2'=> 'top: 270px; right: 25%;',
        'POR'=> 'bottom: 20px; left: calc(50% - 75px);',
    ];
}else if($pos=="352"){
    $posiciones = ['DC1', 'DC2', 'MCO', 'MC1', 'MC2', 'MI', 'MD', 'CB1', 'CB2', 'CB3', 'POR'];
    $posicionesCSS = [
        'DC1'=> 'top: 20px; left: 35%;',
        'DC2'=> 'top: 20px; right: 35%;',
        'MCO'=> 'top: 80px; left: calc(50% - 75px);',
        'MC1'=> 'top: 140px; left: 25%;',
        'MC2'=> 'top: 140px; right: 25%;',
        'MI'=> 'top: 140px; left: 5%;',
        'MD'=> 'top: 140px; right: 5%;',
        'CB1'=> 'top: 240px; left: 15%;',
        'CB2'=> 'top: 240px; left: calc(50% - 75px);',
        'CB3'=> 'top: 240px; right: 15%;',
        'POR'=> 'bottom: 20px; left: calc(50% - 75px);',
    ];
}else if($pos=="532"){
    $posiciones = ['DC1', 'DC2', 'MC1', 'MC2', 'MCO', 'LI', 'LD', 'CB1', 'CB2', 'CB3', 'POR'];
    $posicionesCSS = [
        'DC1'=> 'top: 20px; left: 35%;',
        'DC2'=> 'top: 20px; right: 35%;',
        'MCO'=> 'top: 80px; left: calc(50% - 75px);',
        'MC1'=> 'top: 140px; left: 25%;',
        'MC2'=> 'top: 140px; right: 25%;',
        'LI'=> 'top: 220px; left: 5%;',
        'LD'=> 'top: 220px; right: 5%;',
        'CB1'=> 'top: 270px; left: 15%;',
        'CB2'=> 'top: 270px; left: calc(50% - 75px);',
        'CB3'=> 'top: 270px; right: 15%;',
        'POR'=> 'bottom: 20px; left: calc(50% - 75px);',
    ];
}


foreach ($posiciones as $pos) {
    $posTexto = preg_replace('/\d+$/', '', $pos); // elimina número final (ej: MC1 → MC)
    echo "<div id='pos-$pos' class='position-absolute border border-primary rounded text-center p-1' style='width: 150px; {$posicionesCSS[$pos]}' data-pos='$pos'>$posTexto</div>";
}

?>