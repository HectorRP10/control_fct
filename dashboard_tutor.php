<!DOCTYPE html>
<html>
<head>
<title>Nueva Práctica</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="tutorempresa.css">
</head>
<body>
    <header>
        <img class="logo" src="https://aulavirtual.elcampico.org/pluginfile.php/1/core_admin/logocompact/300x300/1711458408/logo__.png" alt="El Campico Logo">
        
        <nav class="nav_header" id="nav_header">
            <ul class="ul_header">
                <li><a href="#alumnos" >Alumnos</a></li>
                <li><a href="#empresas" onclick="window.location.href = 'tutor_empresa.php';">Empresas</a></li>
                <li><a href="#instructores">Instructores</a></li>
                <li><a href="#principal">Principal</a></li>            
                <li><a href="login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <button onclick="window.location.href = 'NuevaPractica.php';">Asignar Práctica</button>


    <?php
        # Conectamos a la base de datos
        $host='localhost';
        $dbname='control_fct';
        $user='root';
        $pass=''; 

 


    ?>
</body> 
</html>