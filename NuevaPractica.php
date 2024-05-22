<?php
  $id = $_POST["id"] ?? null; 
  $alumno_id = $_POST["alumno_id"] ?? null; 
  $empresa_id = $_POST["empresa_id"] ?? null; 
  $tutor_id = $_POST["tutor_id"] ?? null; 
  $instructor_id = $_POST["instructor_id"] ?? null; 
  $fecha_inicio = $_POST["fecha_inicio"] ?? null; 
  $fecha_fin = $_POST["fecha_fin"] ?? null; 
  $fecha_confirmacion = $_POST["fecha_confirmacion"] ?? null; 
  $curso_nombre = $_POST["curso_nombre"] ?? null; 
  $curso = $_POST["curso"] ?? null; 

  if($_POST){
    $host = 'localhost';
    $dbname = 'control_fct';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO practica VALUES (:id, :alumno_id, :empresa_id, :tutor_id, :instructor_id, :fecha_inicio, :fecha_fin, :fecha_confirmacion, :curso_nombre, :curso)";
        $datos = [":id" => $id, ":alumno_id" => $alumno_id, ":empresa_id" => $empresa_id, ":tutor_id" => $tutor_id, ":instructor_id" => $instructor_id, ":fecha_inicio" => $fecha_inicio, ":fecha_fin" => $fecha_fin, ":fecha_confirmacion" => $fecha_confirmacion, ":curso_nombre" => $curso_nombre, ":curso" => $curso];
        $stmt = $pdo->prepare($sql);
        $row = $stmt->execute($datos);


    } catch (PDOException $e) {
        echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
    }

  }

?>


<!DOCTYPE html>
<html>
<head>
<title>Nueva Práctica</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="NuevaPractica.css">
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


    <h1>Asignar Prácticas</h1>
    <h3>Crear una nueva práctica</h3>
    <form action="NuevaPractica.php" method="post">

        <label for="id">Id:</label>
        <input type="text" name="id" id="id" >

        <label for="alumno_id">Email del alumno:</label>
        <input type="text" name="alumno_id" id="alumno_id" >

        <label for="empresa_id">Nombre de Empresa:</label>
        <input type="text" name="empresa_id" id="empresa_id" >

        <label for="tutor_id">Email del Tutor:</label>
        <input type="text" name="tutor_id" id="tutor_id" >

        <label for="instructor_id">Nombre del Instructor:</label>
        <input type="text" name="instructor_id" id="instructor_id" >

        <label for="fecha_inicio">Fecha inicio Práctica:</label>
        <input type="text" name="fecha_inicio" id="fecha_inicio" >

        <label for="fecha_fin">Fecha fin Práctica:</label>
        <input type="text" name="fecha_fin" id="fecha_fin" >

        <label for="fecha_confirmacion">Fecha confirmación Práctica:</label>
        <input type="text" name="fecha_confirmacion" id="fecha_confirmacion" >

        <label for="curso_nombre">Nombre del Curso:</label>
        <input type="text" name="curso_nombre" id="curso_nombre" >

        <label for="curso">Curso:</label>
        <input type="text" name="curso" id="curso" >


        <input type="submit" value="Asignar" >
        <input type="reset" value="Reset">
    </form>
    

</body> 
</html>