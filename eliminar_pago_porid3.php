<?php
    include("conexion.php");
    $id_pago = $_POST["id_pago"];
    $sentencia = "delete from pagos where id_pago=$id_pago";
    $resultado = mysqli_query($conexion, $sentencia);
    //echo $sentencia;
    header("Location: confirmacion_eliminacion_pago.php");

