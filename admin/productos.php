<?php
require_once "../config/conexion.php";

if (isset($_POST)) {
    if (!empty($_POST)) {
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $p_normal = $_POST['p_normal'];
        $p_rebajado = $_POST['p_rebajado'];
        $categoria = $_POST['categoria'];
        $img = $_FILES['foto'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        $destino = "../assets/img/" . $foto;
        $query = mysqli_query($conexion, "INSERT INTO productos(nombre, descripcion, precio_normal, precio_rebajado, cantidad, imagen, id_categoria) VALUES ('$nombre', '$descripcion', '$p_normal', '$p_rebajado', $cantidad, '$foto', $categoria)");

        if ($query) {
            if (move_uploaded_file($tmpname, $destino)) {

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>";
                echo "document.addEventListener('DOMContentLoaded', function () {";
                echo "Swal.fire({";
                echo "icon: 'success',";
                echo "title: 'Éxito',";
                echo "html: 'Producto agregado correctamente',";
                echo "showConfirmButton: false,";
                echo "timer: 2000";
                echo "}).then(() => {";

                echo "header('Location: productos.php');";
                echo "});";
                echo "});";
                echo "</script>";
            }
        }
    }
}
include("includes/header.php"); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Productos</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="abrirProducto"><i class="fas fa-plus fa-sm text-white-50"></i> Nuevo</a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio Normal</th>
                        <th>Precio Rebajado</th>
                        <th>Cantidad</th>
                        <th>Categoria</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria ORDER BY p.id DESC");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><img class="img-thumbnail" src="../assets/img/<?php echo $data['imagen']; ?>" width="50"></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['descripcion']; ?></td>
                            <td><?php echo $data['precio_normal']; ?></td>
                            <td><?php echo $data['precio_rebajado']; ?></td>
                            <td><?php echo $data['cantidad']; ?></td>
                            <td><?php echo $data['categoria']; ?></td>
                            <td>

                                <form method="post" action="eliminar.php?accion=pro&id=<?php echo $data['id']; ?>" class="d-inline eliminar">
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Boton para descargar el archivo excel -->
<!-- <a href="./excel.php" class="btn  btn-primary">Descargar archivo excel</a> -->
<a href="./excel.php" type="button" class="btn btn-success" >Descargar archivo Excel</a>

<a href="./tcpdf/pdf.php" type="button" class="btn btn-danger">Descargar archivo PDF</a> 




<!-- AQUI EMPIEZA LA PARTE DE AGREGAR PRODUCTOS-->
<div id="productos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="title">Nuevo Producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre del producto</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Ingresa el nombre del producto" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad">Existencia del producto</label>
                                <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="00.00" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción del producto</label>
                                <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Producto nuevo de alta gama con luces RGB..." rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="p_normal">Precio normal del producto</label>
                                <input id="p_normal" class="form-control" type="number" name="p_normal" placeholder="$00.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="p_rebajado">Precio en rebaja del producto</label>
                                <input id="p_rebajado" class="form-control" type="number" name="p_rebajado" placeholder="-$00.00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">¿A qué categoría pertenece el producto?</label>
                                <select id="categoria" class="form-control" name="categoria" required>
                                    <?php
                                    $categorias = mysqli_query($conexion, "SELECT * FROM categorias");
                                    foreach ($categorias as $cat) { ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoria']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imagen">Foto del producto</label>
                                <input type="file" class="form-control" name="foto" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Agregar producto</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de la parte de agregar productos -->


<?php include("includes/footer.php"); ?>