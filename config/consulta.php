<?php 
    require_once("../cn.php");
    $SQL = "select * from productos";
    $stmt = $conexion->prepare($SQL);
    $result = $stmt->execute();
    $rows = $stmt-> fetchAll (\PDO::FETCH_ASSOC);
    foreach($rows as $row){
        print $row["id"].";".$row["nombre"].";".$row["descripcion"].";".$row["precio_normal"] .";".$row["cantidad"]."\n";
    }
?>