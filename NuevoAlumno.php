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
    $nia = $_POST["nia"] ?? null; 



    if ($_POST) {   
        $host = 'localhost';
        $dbname = 'control_fct';
        $user = 'root';
        $pass = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO alumno (email, nia, telefono, nombre) VALUES (:email, :nia, :telefono, :nombre)";
            $datos = [":nombre" => $nombre, ":email" => $email, ":telefono" => $telefono, ":nia" => $nia];
            $stmt = $pdo->prepare($sql);
            $row = $stmt->execute($datos);

            //Este bucle if sirve para mandar una alerta, tanto si se actualiza bien como si no
            if ($stmt->rowCount() == 1) {
            echo "<script>alert('El alumno [$nombre] se creó correctamente'); location.href='TutorAlumno.php';</script>";
            } else {
                echo "<script>alert('El alumno [$nombre] no se creó correctamente'); location.href='TutorAlumno.php';</script>";
            }


        } catch (PDOException $e) {
            echo "El alumno $nombre ya existe, o no se ha podido crear";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Nueva Alumno</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="NuevaEmpresa.css">

</head>
<body>
    <h1>Crear nuevo Alumno</h1>

    <form action="NuevoAlumno.php" method="post">

        <label for="email"> Email:</label>
        <input type="text" name="email" id="email">

        <label for="nia">NIA:</label>
        <input type="text" name="nia" id="nia" >

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" >

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" >

        <input type="submit" value="Insertar" >
        <input type="reset" value="Reset">
    </form>
</body>
</html>

