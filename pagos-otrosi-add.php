<?php

include("conexion.php");
/*
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$sentencia = "INSERT INTO tareas (nombre,descripcion) values ('$nombre', '$descripcion')";
$sentencia = "INSERT into actividades(descripcion,fk_id_contrato) values ('$actividad',$fk_id_contrato)";
$resultado = mysqli_query($con,$sentencia) or die($con);*/

/*
$actividad = $_POST["descripcion"];
$fk_id_contrato =$_POST["fk_id_contrato"];
$sentencia = "INSERT into actividades(descripcion,fk_id_contrato) values ('$actividad',$fk_id_contrato)";
$conexion->query($sentencia);
echo "Agregado correctamente a la base de datos";*/

$fk_id_contrato = $_POST["fk_id_contrato"];
$fecha_pago = $_POST["fecha_pago"];
$valor_bruto = $_POST["valor_bruto"];
$descuentos = $_POST["descuentos"];
$valor_neto = $valor_bruto - $descuentos;
$saldo = "";

//Antes de insertar el valor del saldo, consulto el valor del contrato para poder restar
$sentencia_inter = "select * from pagos_otrosi where fk_id_contrato=$fk_id_contrato order by id_pago desc limit 1";
$resultado_inter = mysqli_query($conexion, $sentencia_inter);
if (mysqli_num_rows($resultado_inter) == 0) {
    //Significa que no hay pagos en la tabla pagos_otrosi y debe buscar en la tabla otrosi para ver el valor del nuevo otrosi del contrato
    $sentencia_contrato = "select * from otrosi where fk_id_contrato=$fk_id_contrato";
    $resultado_contrato = mysqli_query($conexion, $sentencia_contrato);
    $fila_contrato = mysqli_fetch_assoc($resultado_contrato);
    $saldo = $fila_contrato["monto_otrosi"] - $valor_bruto;
} else {
    $fila_inter = mysqli_fetch_assoc($resultado_inter);
    $saldo = $fila_inter["saldo"] - $valor_bruto;
}


$sentencia = "INSERT into pagos_otrosi(fecha_pago,valor_bruto,descuentos,valor_neto,saldo,fk_id_contrato) values ('$fecha_pago',$valor_bruto,$descuentos,$valor_neto,$saldo,$fk_id_contrato)";
$resultado = mysqli_query($conexion, $sentencia);
if ($resultado) {
    //echo "Agregado correctamente a la base de datos";
    echo "Sentencia ->" . $sentencia;
} else {
    echo "Error->". $sentencia. " - " . mysqli_error($conexion);
}
