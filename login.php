<?php
$usuario=$_POST["usuario"];
$password=$_POST["password"];
?>



<!DOCTYPE html>
<html>
<head>
<title>Inicio de Sesión</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="estilologin.css">
</head>
<body>
    <?php
    $conexion=new mysqli("localhost","root","","pruebalogin");
    $conexion->set_charset("utf8");
    ?>
    <form method="post">
    <img src="logo__.svg" alt="Logo mal">
    <h1>Inicio de Sesión</h1>
    <input type="text" name="usuario" placeholder="Nombre">
    <input type="password" name="password" placeholder="Contraseña">
    <input type="submit" name="enviar" value="Iniciar Sesion">
    </form>

</body> 
</html>