<?php
  $nombre = $_POST["nombre"] ?? null; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Document</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>
    


   <!-- <header>
        <img class="logo" src="https://aulavirtual.elcampico.org/pluginfile.php/1/core_admin/logocompact/300x300/1711458408/logo__.png" >
        <button class="abrir_menu" id="abrir_menu">Abrir</button>
        <nav class="nav_header" id="nav_header">
            <button class="cerrar_menu" id="cerrar_menu">Cerrar</button>
            <ul class="ul_header">
                <li><a href="">Alumnos</a></li>
                <li><a href="">Empresas</a></li>
                <li><a href="">Instructores</a></li>
                <li><a href="">Cerrar sesión </a></li>
 
            </ul>
        </nav>

    </header>
    -->
    



    <h1>Lista de empresas</h1>
    <button>Crear nueva</button>

    <form action="tutor_empresa.php" method='post'>
        <label for ="nombre">Nombre: </label>
        <input type="text" name="nombre" value="<?php echo isset ($_POST['nombre']) ? $_POST['nombre'] : $nombre?>">
        <input type="submit" value="Filtrar">
        <input type="reset" value="Reset">
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
  
            $sql .= " LIMIT 10";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

  
  
            echo "<table border='1'>";
            echo "<tr><th>Nombre</th></tr>";

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                echo "<tr>";
                echo "<td>".$row['nombre']."</td>";
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