
<!DOCTYPE html>
<html>
<head>
<title>Inicio de Sesión</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="estilologin.css">
</head>
<body>
    <form method="post">
    <img src="logo__.svg" alt="Logo mal">
    <h1>Inicio de Sesión</h1>
    <input type="text" name="usuario" placeholder="Nombre">
    <input type="password" name="password" placeholder="Contraseña">
    <input type="submit" name="enviar" value="Iniciar Sesion">
       
    <?php
    $conexion=new mysqli("localhost","root","","pruebalogin");
    $conexion->set_charset("utf8");
    if(!empty($_POST["enviar"])){
        if(empty($_POST["usuario"]) && empty($_POST["password"])){
             echo'<div class="bad">Los campos están vacíos</div>';
        }else{
            $usuario=$_POST["usuario"];
            $password=$_POST["password"];
            $sql_alumno=$conexion->query("select * from alumno where nombre='$usuario' and password='$password' ");
            $sql_tutor=$conexion->query("select * from tutor where nombre='$usuario' and password='$password' ");
            if($datos_alumno=$sql_alumno->fetch_object()){
                header("location:dashboard_alumno.php");
            }
            if($datos_tutor=$sql_tutor->fetch_object()){
                 header("location:tutor_empresa.php");
            }else{
                  echo '<div class="bad"> El usuario o la contraseña no son correctos</div>';
         }
     }   
    }
    ?>
    </form>

</body> 
</html>