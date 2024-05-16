<?php
  $nombre = $_POST["nombre"] ?? null; 
  $cif = $_POST["cif"] ?? null; 
  $nombre_fiscal = $_POST["nombre_fiscal"] ?? null; 
  $email = $_POST["email"] ?? null; 
  $direccion = $_POST["direccion"] ?? null; 
  $provincia = $_POST["provincia"] ?? null; 
  $numero_plazas = $_POST["numero_plazas"] ?? null; 
  $telefono = $_POST["telefono"] ?? null; 
  $persona_contacto = $_POST["persona_contacto"] ?? null; 

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
                <li><a href="#alumnos">Alumnos</a></li>
                <li><a href="#empresas">Empresas</a></li>
                <li><a href="#instructores">Instructores</a></li>
                <li><a href="#cerrar-sesion">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    
    


    <h1>Listado de Empresas</h1>
    <button onclick="window.location.href = 'NuevaEmpresa.php';">Nueva Empresa</button>
    <button>Modificar Empresa</button>
   


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

            $sql .= " LIMIT 10";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

  
  
            echo "<table border='2'>";
            echo "<tr><th>Nombre</th><th>Cif</th><th>Nombre Fiscal</th><th>Email</th><th>Dirección</th><th>Provincia</th><th>Número Plazas</th><th>Teléfono</th><th>Persona Contacto</th></tr>";

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                echo "<tr>";
                echo "<td>".$row['nombre']."</td>";
                echo "<td>".$row['cif']."</td>";
                echo "<td>".$row['nombre_fiscal']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['direccion']."</td>";
                echo "<td>".$row['provincia']."</td>";
                echo "<td>".$row['numero_plazas']."</td>";
                echo "<td>".$row['telefono']."</td>";
                echo "<td>".$row['persona_contacto']."</td>";

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