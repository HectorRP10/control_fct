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


if ($_POST) {
    $host = 'localhost';
    $dbname = 'control_fct';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO empresa VALUES (:nombre, :cif, :nombre_fiscal, :email, :direccion, :localidad, :provincia, :numero_plazas, :telefono, :persona_contacto)";
        $datos = [":nombre" => $nombre, ":cif" => $cif, ":nombre_fiscal" => $nombre_fiscal, ":email" => $email, ":direccion" => $direccion, ":localidad" => $localidad, ":provincia" => $provincia, ":numero_plazas" => $numero_plazas, ":telefono" => $telefono, ":persona_contacto" => $persona_contacto];
        $stmt = $pdo->prepare($sql);
        $row = $stmt->execute($datos);

        //Este bucle if sirve para mandar una alerta, tanto si se actualiza bien como si no
        if ($stmt->rowCount() == 1) {
            echo "<script>alert('La empresa [$nombre] se creó correctamente'); location.href='tutor_empresa.php';</script>";
        } else {
            echo "<script>alert('La empresa [$nombre] no se creó correctamente'); location.href='tutor_empresa.php';</script>";
        }


    } catch (PDOException $e) {
        echo "La empresa $nombre ya existe, o no se ha podido crear";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Nueva Empresa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="NuevaEmpresa.css">

</head>
<body>
    <h1>Crear Nueva Empresa</h1>

    <form action="NuevaEmpresa.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" >

        <label for="cif">CIF:</label>
        <input type="text" name="cif" id="cif" 
        >
        <label for="nombre_fiscal">Nombre Fiscal:</label>
        <input type="text" name="nombre_fiscal" id="nombre_fiscal">

        <label for="email"> Email:</label>
        <input type="text" name="email" id="email">

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion">

        <label for="localidad">Localidad:</label>
        <input type="text" name="localidad" id="localidad" >

        <label for="provincia">Provincia:</label>
        <input type="text" name="provincia" id="provincia" >

        <label for="numero_plazas">Número Plazas:</label>
        <input type="text" name="numero_plazas" id="numero_plazas" >

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" >

        <label for="persona_contacto">Persona Contacto :</label>
        <input type="text" name="persona_contacto" id="persona_contacto" >

        <input type="submit" value="Insertar" >
        <input type="reset" value="Reset">
    </form>
</body>
</html>

