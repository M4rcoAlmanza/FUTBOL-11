<?php
$titulo = "LIGA MX";
require_once 'componentes/encabezado.php';
require_once 'componentes/navbar.php';

?>

<div class="container mt-4 text-white">
    <div class="row row-cols-1 row-cols-md-3 g-4">

        <!-- Juego Normal -->
        <div class="col"><a href="main.php" class="btn btn-light mt-3 w-100">
            <div class="card h-100 text-white bg-secondary">
                <img src="img/Alineaciones.png" class="card-img-top img-fluid p-3" alt="Crear Alineación">
                <div class="card-body text-center">
                    <h5 class="card-title">⚽ Crear alineación</h5>
                    <!-- <a href="main.php" class="btn btn-light mt-3 w-100">Jugar Ahora</a> -->
                </div>
            </div></a>
        </div>

    </div>
</div>

<?php 
require_once 'componentes/footBar.php'; 
?>
