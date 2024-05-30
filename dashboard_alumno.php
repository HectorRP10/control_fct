<?php
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard_alumno</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="alumnonav.css">
</head>
<body>
<header>
        <img class="logo" src="https://aulavirtual.elcampico.org/pluginfile.php/1/core_admin/logocompact/300x300/1711458408/logo__.png" alt="El Campico Logo"> 
        <nav class="nav_header" >
            <ul class="ul_header">
                <li><a href="#Editar Perfil">Editar Perfil</a></li>
                <li><a href="alumnoPrioridad.php">Preferencias</a></li>
                <li><a href="#historial estados">Historial Estados</a></li>
                <li><a href="login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    
    
</body>
</html>