<?php session_start();

 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['user'])!="" ) {
	  header("Location: index.php");
	  exit;
 }
 


 //require_once 'dbconfig.php';
 require_once 'conexion.php';

 $error = false;
 


 if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-login']) ) {
  
  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['usuario']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $password = trim($_POST['password']);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);
  // prevent sql injections / clear user invalid inputs
  
  if(empty($email)){
	   $error = true;
	   $emailError = "Please enter your email.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
	   $error = true;
	   $emailError = "Please enter a valid email.";
  }
  
  if(empty($password)){
	   $error = true;
	   $passError = "Please enter your password.";
  }
  
  // if there's no error, continue to login
  if (!$error) {
   
       //$password = hash('sha256', $pass); // password hashing using SHA256
       $sentencia = "SELECT id, usuario, password,fk_id_dependencia FROM super_administradores WHERE usuario='$email'";
	  
       $res=mysqli_query($conexion,$sentencia);
       //echo $sentencia."<br>";
	   $row=mysqli_fetch_array($res);
       $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
       //var_dump($row);
       //echo "<br>Password: ".$row['password'];
   
   if($row['password']==$password ) {
		$_SESSION["user"] = $row["usuario"];
        $_SESSION["loggedin"] = true;
        $_SESSION["id_dependencia"] = $row["fk_id_dependencia"];
        //var_dump($_SESSION);
        //echo "login correcto";
		header("Location: index.php");
   } else {
		$errMSG = "Incorrect Credentials, Try again...";
   }
    
  }
  
 }
 ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ingreso a MegaReporte - Bienvenidos
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Sistema de Gestión de reportes de los contratistas">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="./main.css" rel="stylesheet">
</head>

<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-sm-6 col-md-6 col-lg-4">
            <center><img src="images/logo_encabezado.png"></center><br><br>
                <div class="main-card card bg-warning text-white">
                    <div class="card-body">
                    <img src="assets/images/logo-inverse.png"> (Sistema de Administración)
                    <br>
                    <br>
                        <div>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                           
                            <div class="form-group">
                                <label class="form-label" for="title">Usuario</label>
                                <input id="usuario" name="usuario" type="text" class="form-control" placeholder="usuario" />
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="title">Contraseña</label>
                                <input id="pass" type="password" name="password" class="form-control" placeholder="contraseña" />
                            </div>
                            <div class="float-right">
                                <button type="submit" id="btn-login" name="btn-login" class="btn btn-success" id="showtoast">Ingresar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container h-100"> -->
        
</body>

</html>