<!-- Creacion del archivo xls(Excel) -->
<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= prueba3.xls");
?>


<?php
require_once "../config/conexion.php";
?>
            <table class="table table-hover table-bordered" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conexion, "SELECT * FROM categorias ORDER BY id DESC");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['categoria']; ?></td>
                            <td>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>