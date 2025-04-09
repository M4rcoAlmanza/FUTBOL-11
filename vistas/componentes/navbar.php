<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="../index.php">
            <img src="img/logo.png" alt="Logo" height="40" class="me-3">  FUTBOL 11 - LIGA MX
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- <li class="nav-item"><a class="nav-link" href="../index.php">Inicio</a></li> -->
            </ul>
        </div>
    </div>
</nav>


<!-- NOTIFICACIONES -->
<?php if (isset($_SESSION['notification'])): ?>

    <div id="notification" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <div class="alert alert-<?= $_SESSION['notification']['type']; ?> alert-dismissible fade show shadow-lg" role="alert">
            <?= $_SESSION['notification']['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

<?php 
        unset($_SESSION['notification']);
    endif; 
    require_once 'js/notificaciones.php';
?>