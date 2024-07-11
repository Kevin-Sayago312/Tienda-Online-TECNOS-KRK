<?php
if (isset($_GET)) {
    if (!empty($_GET['accion']) && !empty($_GET['id'])) {
        require_once "../config/conexion.php";
        $id = $_GET['id'];
        if ($_GET['accion'] == 'pro') {
            $query = mysqli_query($conexion, "DELETE FROM productos WHERE id = $id");

            if ($query) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            echo "<script>";
                echo "document.addEventListener('DOMContentLoaded', function () {";
                  echo "Swal.fire({";
            echo "icon: 'success',";
            echo "title: 'Éxito',";
            echo "html: '¡Producto eliminado!',";
            echo "showConfirmButton: false,";
            echo "timer: 2000";
        echo "}).then(() => {";
            
            echo "window.location.href = 'productos.php';";
        echo "});";
    echo "});";
echo "</script>";


            }
        }
        if ($_GET['accion'] == 'cli') {
            $query = mysqli_query($conexion, "DELETE FROM categorias WHERE id = $id");
            if ($query) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            echo "<script>";
                echo "document.addEventListener('DOMContentLoaded', function () {";
                  echo "Swal.fire({";
            echo "icon: 'success',";
            echo "title: 'Éxito',";
            echo "html: '¡Categoría eliminada!',";
            echo "showConfirmButton: false,";
            echo "timer: 2000";
        echo "}).then(() => {";
            
            echo "window.location.href = 'categorias.php';";
        echo "});";
    echo "});";
echo "</script>";
                
            }
        }
    }
}
?>