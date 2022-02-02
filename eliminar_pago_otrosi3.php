<?php
    include("conexion.php");
    $id_otrosi = $_POST["id_otrosi"];
    $id_contrato = $_POST["id_contrato"];
    
    //Borra los pagos del Otrosi
    $sentencia = "delete from pagos_otrosi where fk_id_contrato = $id_contrato";
    $resultado = mysqli_query($conexion, $sentencia);

    //Borra el Otrosi
    $sentencia2 = "delete from otrosi where fk_id_contrato=$id_contrato";
    $resultado = mysqli_query($conexion, $sentencia2);

    //Actualiza el contrato el flag del Otrosi
    $sentencia3 = "update contrato set otrosi = 0 where id_contrato=$id_contrato";
    $resultado = mysqli_query($conexion, $sentencia3);

    //echo $sentencia."<br>";
    //echo $sentencia2."<br>";
    //echo $sentencia3."<br>";
    header("Location: confirmacion_eliminacion_pago.php");

