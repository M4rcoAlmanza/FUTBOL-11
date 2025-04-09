<script>
    // Muestra el modal y bloquea el resto
    document.addEventListener("DOMContentLoaded", () => {
        const modo = document.getElementById('modo');
        const temporadaSelect = document.getElementById('temporada-select');

        modo.addEventListener('change', () => {
            temporadaSelect.style.display = (modo.value === 'temporada') ? 'block' : 'none';
        });
    });
</script>