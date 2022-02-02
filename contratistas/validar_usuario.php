<?php
include("conexion.php");
$codigo=$_POST["codigo"];
$res = mysqli_query($conexion,"select * from contratista where cedula=$codigo");
if(mysqli_num_rows($res)>0){
    echo "true";
}else {
    echo "false";
}
