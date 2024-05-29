<?php
    $alumno_id = $_POST["alumno_id"] ?? null; 
    $empresa_id = $_POST["empresa_id"] ?? null; 
    $instructor_id = $_POST["instructor_id"] ?? null; 

?>

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
                <li><a href="login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <h1>Prácticas en curso</h1>
    <button onclick="window.location.href = 'NuevaPractica.php';">Asignar Práctica</button>

    <form action="dashboard_tutor.php" method='post'>
        <label for ="alumno_id">Alumno: </label>
        <input type="text" name="alumno_id" value="<?php echo isset ($_POST['alumno_id']) ? $_POST['alumno_id'] : $alumno_id?>">
        <label for ="empresa_id">Empresa: </label>
        <input type="text" name="empresa_id" value="<?php echo isset ($_POST['empresa_id']) ? $_POST['empresa_id'] : $empresa_id?>">
        <input type="submit" value="Filtrar">
        <input type="reset" value="Reset" >
    </form>

    <?php
        # Conectamos a la base de datos
        $host='localhost';
        $dbname='control_fct';
        $user='root';
        $pass=''; 

        try{
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass); //creamos el objeto pdo
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql="SELECT p.*, eh.estado_id, eh.comentario FROM practica p LEFT JOIN estados_historico eh ON p.id = eh.practica_id AND eh.fecha = ( SELECT MAX(fecha) FROM estados_historico WHERE practica_id = p.id) WHERE TRUE";

            $params= array();

            if($alumno_id){
                $sql.="AND alumno_id LIKE :alumno_id";
                $params[':alumno_id'] = "%$alumno_id%";
                }
    
            if($empresa_id){
                $sql.="AND empresa_id LIKE :empresa_id";
                $params[':empresa_id'] = "%$empresa_id%";
            }
      
            if($instructor_id){
                $sql.="AND instructor_id LIKE :instructor_id";
                $params[':instructor_id'] = "%$instructor_id%";
            }

            $sql .= " LIMIT 8";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            echo "<table border='2'>";
            echo "<tr><th>Alumno</th><th>Empresa</th><th>Instructor</th><th>Último comentario</th><th>Estado práctica</th></tr>";

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                echo "<tr>";
                echo "<td>".$row['alumno_id']."</td>";
                echo "<td>".$row['empresa_id']."</td>";
                echo "<td>".$row['instructor_id']."</td>";

                //Estos dos formularios aqui, tienen como finalidad que todas las filas tengan un boton de historico de contactos y modificar estado

                echo "<td>
                    ".$row['comentario']."

                    <form action='' method='POST'>

                        <input type='submit' name='Historial' value='Historial'>
                    </form>
                </td>";

                echo "<td>
                    ".$row['estado_id']."

                    <form action='' method='POST'>

                        <input type='submit' name='Modificar' value='Modificar'>

                    </form>
                </td>";

                echo "</tr>";
            }    


        }catch(PDOException $e) {
            echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
        }



    ?>
</body> 
</html>