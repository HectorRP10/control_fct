<?php

    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }


  $nombre = $_POST["nombre"] ?? null; 
  $cif = $_POST["cif"] ?? null; 
  $nombre_fiscal = $_POST["nombre_fiscal"] ?? null; 
  $email = $_POST["email"] ?? null; 
  $direccion = $_POST["direccion"] ?? null; 
  $localidad = $_POST["localidad"] ?? null; 
  $provincia = $_POST["provincia"] ?? null; 
  $numero_plazas = $_POST["numero_plazas"] ?? null; 
  $telefono = $_POST["telefono"] ?? null; 
  $persona_contacto = $_POST["persona_contacto"] ?? null; 

  $pag_actual=$_POST['pag_actual'] ?? 1;
  $pag_siguiente = $pag_actual+1;
  $pag_anterior= $pag_actual-1;
  $pag_ultima;
  $pag_primera=1;

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
                <li><a href="#alumnos" >Alumnos</a></li>
                <li><a href="#empresas" onclick="window.location.href = 'tutor_empresa.php';">Empresas</a></li>
                <li><a href="#instructores">Instructores</a></li>
                <li><a href="login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <h1>Listado de Empresas</h1>
    <button onclick="window.location.href = 'NuevaEmpresa.php';">Nueva Empresa</button>
   

    <form action="tutor_empresa.php" method='post'>
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


            $sql="SELECT * FROM empresa where true ";

            $params= array();
            if($nombre){
            $sql.="AND nombre LIKE :nombre";
            $params[':nombre'] = "%$nombre%";
            }

            if($cif){
                $sql.="AND cif LIKE :cif";
                $params[':nombre'] = "%$cif%";
            }
  
            if($nombre_fiscal){
                $sql.="AND nombre_fiscal LIKE :nombre_fiscal";
                $params[':nombre_fiscal'] = "%$nombre_fiscal%";
            }

            if($email){
                $sql.="AND email LIKE :email";
                $params[':email'] = "%$email%";
            }

            if($direccion){
                $sql.="AND direccion LIKE :direccion";
                $params[':direccion'] = "%$direccion%";
            }

            if($localidad){
                $sql.="AND localidad LIKE :localidad";
                $params[':localidad'] = "%$localidad%";
            }

            if($provincia){
                $sql.="AND provincia LIKE :provincia";
                $params[':provincia'] = "%$provincia%";
            }

            if($numero_plazas){
                $sql.="AND numero_plazas LIKE :numero_plazas";
                $params[':numero_plazas'] = "%$numero_plazas%";
            }

            if($telefono){
                $sql.="AND telefono LIKE :telefono";
                $params[':telefono'] = "%$telefono%";
            }

            if($persona_contacto){
                $sql.="AND persona_contacto LIKE :persona_contacto";
                $params[':persona_contacto'] = "%$persona_contacto%";
            }

            $sql .= " LIMIT 8";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

  
            echo "<table border='2'>";
            echo "<tr><th>Nombre</th><th>Cif</th><th>Nombre Fiscal</th><th>Email</th><th>Dirección</th><th>Localidad</th><th>Provincia</th><th>Número Plazas</th><th>Teléfono</th><th>Persona Contacto</th><th>Eliminar</th><th>Editar</th></tr>";

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                echo "<tr>";
                echo "<td>".$row['nombre']."</td>";
                echo "<td>".$row['cif']."</td>";
                echo "<td>".$row['nombre_fiscal']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['direccion']."</td>";
                echo "<td>".$row['localidad']."</td>";
                echo "<td>".$row['provincia']."</td>";
                echo "<td>".$row['numero_plazas']."</td>";
                echo "<td>".$row['telefono']."</td>";
                echo "<td>".$row['persona_contacto']."</td>";

                //Estos dos formularios aqui, tienen como finalidad que todas las filas tengan un boton de eliminar y editar
                echo "<td>
                    <form action='BorrarEmpresa.php' method='POST'>
                        <input type='hidden' name='nombre' value='".$row['nombre']."'>
                        <input type='hidden' name='cif' value='".$row['cif']."'>
                        <input type='submit' name='eliminar' value='Eliminar'>
                    </form>
                </td>";

                echo "<td>
                    <form action='ModificarEmpresa.php' method='POST'>
                        <input type='hidden' name='nombre' value='".$row['nombre']."'>
                        <input type='hidden' name='cif' value='".$row['cif']."'>
                        <input type='hidden' name='nombre_fiscal' value='".$row['nombre_fiscal']."'>
                        <input type='hidden' name='email' value='".$row['email']."'>
                        <input type='hidden' name='direccion' value='".$row['direccion']."'>
                        <input type='hidden' name='localidad' value='".$row['localidad']."'>
                        <input type='hidden' name='provincia' value='".$row['provincia']."'>
                        <input type='hidden' name='numero_plazas' value='".$row['numero_plazas']."'>
                        <input type='hidden' name='telefono' value='".$row['telefono']."'>
                        <input type='hidden' name='persona_contacto' value='".$row['persona_contacto']."'>                        
                        <input type='submit' name='editar' value='Editar'>
                    </form>
                </td>";

                echo "</tr>";
            }
            echo "</table>";







            
            echo "<form action='tutor_empresa.php' method='POST'>";
            echo "<input type='hidden' name='page' value='$pag_actual'>";
            echo "<input type='submit' name='prev' value='<<'>";
            echo "<input type='submit' name='prev' value='<'>";
            echo "<input type='submit' name='next' value='>'>";
            echo "<input type='submit' name='next' value='>>'>";
            echo "</form>";
  
  
        }
        catch(PDOException $e) {
            echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
        }
    ?>


    

    
</body>
</html>