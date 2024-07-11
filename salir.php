<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: "success",
            title: "Éxito",
            html: "Adiós &#128075;",
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            // Redireccionar a otra página (puede ser 'index.html' o cualquier otra)
            window.location.href = "index.php";

            // Destruir la sesión después de mostrar el mensaje
            <?php
            session_start();
            session_destroy();
            ?>
        });
    });
</script>