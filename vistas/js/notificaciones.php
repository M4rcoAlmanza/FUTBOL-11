<script>
    document.addEventListener("DOMContentLoaded", function() {
        let notification = document.getElementById("notification");
        if (notification) {
            setTimeout(() => {
                notification.style.display = "none";
            }, 4000); // Se oculta después de 4 segundos
        }
    });
</script>
