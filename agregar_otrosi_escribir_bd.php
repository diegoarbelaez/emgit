<?php

include("conexion.php");
$id_contrato = $_POST["id_contrato"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$monto_otrosi = $_POST["monto_otrosi"];
$cuotas_otrosi = $_POST["cuotas_otrosi"];
$numero_otrosi = $_POST["numero"];
//Inserta en la tabla otrosi
$sentencia = "insert into otrosi (fk_id_contrato,fecha_inicio,fecha_fin,cuotas_otrosi,monto_otrosi,numero_otrosi) values ($id_contrato,'$fecha_inicio','$fecha_fin',$cuotas_otrosi,$monto_otrosi,'$numero_otrosi')";
$resultado = mysqli_query($conexion, $sentencia);
if (!$resultado) {
    echo "Error: " . mysqli_error($conexion);
    echo "<br>".$sentencia;
}
//echo "<br>Insertó Otrosí";
$id_otrosi =  mysqli_insert_id($conexion);

//Actualia el flag de Otrosi en la tabla contratos
$sentencia_update = "update contrato set otrosi=1 where id_contrato=$id_contrato";
$resultado = mysqli_query($conexion, $sentencia_update);
if (!$resultado) {
    echo "Error: " . mysqli_error($conexion);
    echo "<br>".$sentencia_update;

}
header("Location:visualizar_contrato.php?id_contrato=".base64_encode($id_contrato));