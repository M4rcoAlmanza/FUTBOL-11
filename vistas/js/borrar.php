<script>
    // Este se ejecuta justo cuando se hace submit al form de reinicio
    document.querySelector('form[action="reiniciar.php"]').addEventListener('submit', function () {
        localStorage.removeItem("alineacion");
    });

</script>