<?php
include("conexion.php");
echo "<html><body>";
echo "Fecha del Servidor -> ". date("Y-m-d H:i:s")."<br>";

$sentencia_hora = "SELECT now() as hora";
$resultado_hora = mysqli_query($conexion,$sentencia_hora);
$fila_hora = mysqli_fetch_assoc($resultado_hora);
echo "Fecha de la BD -> ". $fila_hora["hora"]."<br>";


$sentencia_log = "select * from log where id_log = 63300";
$resultado_log = mysqli_query($conexion,$sentencia_log);
$fila_log = mysqli_fetch_assoc($resultado_log);
echo "Fecha del log en la BD ". $fila_log["fecha"]."<br>";


//Restamos 5 horas... para hacer la prueva
$fecha_inicial_reporte_tmp = strtotime ('-5 hour',strtotime($fila_log["fecha"]));
$fecha_inicial_reporte = date ('Y-m-d H:i:s',$fecha_inicial_reporte_tmp);  

echo "Hora Log Modificada: ".$fecha_inicial_reporte."<br>";

echo "<br> aqui una prueba <br>";

    $fecha_inicial = "2021-07-01 00:00:00";
    $fecha_final = "2021-07-31 23:59:59";

    $fecha_inicial_reporte_tmp = strtotime ('-5 hour',strtotime($fecha_inicial));
    $fecha_inicial_reporte = date ('Y-m-d H:i:s',$fecha_inicial_reporte_tmp);   
        
    $fecha_final_reporte_tmp = strtotime ('-5 hour',strtotime($fecha_final));
    $fecha_final_reporte = date ('Y-m-d H:i:s',$fecha_final_reporte_tmp); 

    echo "Fecha Inicial ".$fecha_inicial_reporte."<br>";
    echo "Fecha Final ".$fecha_final_reporte."<br>";



    echo "<br><br>prueba resta fechas";
    $fecha_fin_contrato = '2021-07-01';
    $fecha_fin = '2021-06-15';
    echo "<br>Fecha Fin Contrato ->".$fecha_fin_contrato;
    echo "<br>Fecha Inicio Otrosi".$fecha_fin;
    if($fecha_fin_contrato > $fecha_fin){
        echo "No se puede";
    }

echo "</body></html>";

?>