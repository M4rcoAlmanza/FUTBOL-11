<?php

if (!isset($_SESSION['temporada'])): ?>
    <!-- Modal de Selección de Temporada / Dificultad -->
    <div class="modal fade show d-block" id="inicioModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inicioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="inicioModalLabel">Selecciona el modo de juego</h5>
                </div>
                <div class="modal-body text-center">
                    <form method="POST" action="seleccionar_temporada.php">
                        <div class="mb-3">
                            <label for="modo" class="form-label">Modo de juego:</label>
                            <select class="form-select" name="modo" id="modo" required>
                                <option value="facil">Fácil (2021 - Actualidad)</option>
                                <option value="normal">Normal (2010 - 2020)</option>
                                <option value="dificil">Difícil (1996 - 2009)</option>
                                <option value="temporada">Temporada específica</option>
                            </select>
                        </div>
                        <div class="mb-3" id="temporada-select" style="display: none;">
                            <label for="temporada" class="form-label">Temporada:</label>
                            <select class="form-select" name="temporada" id="temporada">
                                <?php for ($anio = 2024; $anio >= 1996; $anio--): ?>
                                    <option value="<?= $anio ?>"><?= $anio ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">🎮 Comenzar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php 
require_once "js/verModal.php";
exit; 
endif; ?>
