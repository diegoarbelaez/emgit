<?php
include("conexion.php");
$fk_id_contrato = $_POST["id_contrato"];
    $sentencia = "SELECT * FROM pagos_otrosi WHERE fk_id_contrato=$fk_id_contrato";
    //echo $sentencia;
    $resultado = mysqli_query($conexion,$sentencia);
    if(!$resultado){
        die("Error en Query". mysqli_error($conexion));
    }
    $json = array();
    while($row=mysqli_fetch_array($resultado)){
        $json[] = array ( // llenamos el Array con objetos de la base de datos
            'id_pago' => $row["id_pago"],
            'fecha_pago' => $row["fecha_pago"],
            'valor_bruto' => $row["valor_bruto"],
            'descuentos' => $row["descuentos"],
            'valor_neto' => $row["valor_neto"],
            'saldo' => $row["saldo"]
        );
    }
    $jsonstring=json_encode($json); // Codifica los valores en formato JSON
    echo $jsonstring;
?>