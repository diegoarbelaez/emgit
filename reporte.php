<pre>
<?php
include("conexion.php");

$sentencia = "SELECT * from actividades where fk_id_contrato = 38";
$resultado = mysqli_query($conexion, $sentencia);
while ($fila = mysqli_fetch_object($resultado)) {
    //print_r($fila);
    echo "<p><strong>".$fila->descripcion."</strong>";
    $id_actividad = $fila->id_actividad;
    $sentencia2 = "SELECT * from log WHERE fk_id_actividad=$id_actividad";
    $resultado2 = mysqli_query($conexion, $sentencia2);
    while ($fila2 = mysqli_fetch_object($resultado2)) {
        //print_r($fila2);
        $id_log=$fila2->id_log;
        $sentencia3 = "select * from soportes where fk_id_log=$id_log";
        $resultado3=mysqli_query($conexion,$sentencia3);
        $ruta = "No hay soportes";
        if($fila3=mysqli_fetch_object($resultado3)){
            $ruta=$fila3->ruta;
        }
        echo "<br>".$fila2->hecho." soporte ->".$ruta;
    }
    echo "<br></p>";
}
?>
</pre>