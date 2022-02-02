<?php
include("conexion.php");
$codigo=$_POST["codigo"];
$res = mysqli_query($conexion,"select * from codigos where codigo=$codigo");
if(mysqli_num_rows($res)>0){
    echo "true";
}else {
    echo "false";
}
