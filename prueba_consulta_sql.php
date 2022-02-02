<?php

include("conexion.php");

$id_contrato = 10120;

 $sentencia_saldos = "select * from pagos where fk_id_contrato=$id_contrato order by id_pago desc limit 1"; //busca la última cuota pagada para ver si tiene saldo $0
        $restultado_saldos = mysqli_query($conexion, $sentencia_saldos);
        $fila_saldos = mysqli_fetch_assoc($restultado_saldos);
        $ultimo_saldo = $fila_saldos["saldo"];

        echo $sentencia_saldos;
        var_dump($fila_saldos);
        echo "Ultimo Pago ->".$ultimo_saldo;

        if(empty($ultimo_saldo)){
            echo "Si, vacío";
        }

?>