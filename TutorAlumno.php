<?php

    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }


  $nombre = $_POST["nombre"] ?? null; 
  $email = $_POST["email"] ?? null;
  $nia = $_POST["nia"] ?? null; 
  $telefono = $_POST["telefono"] ?? null; 
  $cv_file = $_POST["cv_file"] ?? null; 
  $nia = $_POST["nia"] ?? null; 

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Document</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="Tutorempresa.css">

</head>

<body>

    <header>
        <img class="logo" src="https://aulavirtual.elcampico.org/pluginfile.php/1/core_admin/logocompact/300x300/1711458408/logo__.png" alt="El Campico Logo">
        
        <nav class="nav_header" id="nav_header">
            <ul class="ul_header">
                <li><a href="#principal" onclick="window.location.href = 'dashboard_tutor.php';">Home</a></li>            
                <li><a href="#empresas" onclick="window.location.href = 'tutor_empresa.php';">Empresas</a></li>
                <li><a href="#instructores">Instructores</a></li>
                <li><a href="login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <h1>Listado de Alumnos</h1>
    <button onclick="window.location.href = 'NuevoAlumno.php';">Nuevo Alumno</button>
   

    <form action="TutorAlumno.php" method='post'>
        <label for ="nombre">Nombre: </label>
        <input type="text" name="nombre" value="<?php echo isset ($_POST['nombre']) ? $_POST['nombre'] : $nombre?>">
        <input type="submit" value="Filtrar">
        <input type="reset" value="Reset" >
    </form>


    
    <?php 

        # Conectamos a la base de datos
        $host='localhost';
        $dbname='control_fct';
        $user='root';
        $pass=''; 


        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass); //creamos el objeto pdo
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $sql="SELECT * FROM alumno where true ";

            $params= array();
            if($nombre){
            $sql.="AND nombre LIKE :nombre";
            $params[':nombre'] = "%$nombre%";
            }

            if($email){
                $sql.="AND email LIKE :email";
                $params[':email'] = "%$email%";
            }

            if($cv_file){
                $sql.="AND cv_file LIKE :cv_file";
                $params[':cv_file'] = "%$cv_file%";
            }

            if($telefono){
                $sql.="AND telefono LIKE :telefono";
                $params[':telefono'] = "%$telefono%";
            }

            if($nia){
                $sql.="AND nia LIKE :nia";
                $params[':nia'] = "%$nia%";
            }


            $sql .= " LIMIT 8";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

  
            echo "<table border='2'>";
            echo "<tr><th>Nombre</th><th>Email</th><th>NIA</th><th>Teléfono</th><th>Currículum</th></tr>";

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                echo "<tr>";
                echo "<td>".$row['nombre']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['nia']."</td>";
                echo "<td>".$row['telefono']."</td>";
                echo "<td>".$row['cv_file']."</td>";


                //Estos dos formularios aqui, tienen como finalidad que todas las filas tengan un boton de eliminar y editar
                echo "<td>
                    <form action='TutorAlumno.php' method='POST'>
                      
                        <input type='submit' name='eliminar' value='Eliminar'>
                    </form>
                </td>";

                echo "<td>
                    <form action='TutorAlumno.php' method='POST'>
                                               
                        <input type='submit' name='editar' value='Editar'>
                    </form>
                </td>";

                echo "</tr>";
            }
            echo "</table>";
  
  
        }
        catch(PDOException $e) {
            echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
        }
    ?>
    
</body>
</html>