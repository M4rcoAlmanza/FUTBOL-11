<!-- Modal fin de juego -->
<div class="modal fade" id="finModal" tabindex="-1" aria-labelledby="finModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-success text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="finModalLabel">¡Alineación completa! ✅</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                Has completado los 11 jugadores de tu equipo. ¡Buen trabajo!
            </div>
            <img src="img/campeon.jpg" alt="Chivas campeón">
            <div class="modal-footer justify-content-center">
                <form action="reiniciar.php" method="POST" class="text-center mt-3">
                    <button type="submit" class="btn btn-success">🔄 Volver a empezar</button>
                </form>
            </div>
        </div>
    </div>
</div>
