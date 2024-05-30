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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Empresa</title>
    <link rel="stylesheet" type="text/css" href="NuevaEmpresa.css">
</head>
<body>
    <h1>Editar Empresa</h1>

    <?php
    $host = 'localhost';
    $dbname = 'control_fct';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST["update"])) {
            $sql = "UPDATE empresa SET cif = :cif, nombre_fiscal = :nombre_fiscal, email = :email, direccion = :direccion, localidad = :localidad, provincia = :provincia, numero_plazas = :numero_plazas, telefono = :telefono, persona_contacto = :persona_contacto WHERE nombre = :nombre";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':cif' => $cif,
                ':nombre_fiscal' => $nombre_fiscal,
                ':email' => $email,
                ':direccion' => $direccion,
                ':localidad' => $localidad,
                ':provincia' => $provincia,
                ':numero_plazas' => $numero_plazas,
                ':telefono' => $telefono,
                ':persona_contacto' => $persona_contacto,
                ':nombre' => $nombre
            ]);

            //Este bucle if sirve para mandar una alerta, tanto si se actualiza bien como si no
            if ($stmt->rowCount() == 1) {
                echo "<script>alert('La empresa [$nombre] se insertó correctamente'); location.href='tutor_empresa.php';</script>";
            } else {
                echo "<script>alert('La empresa [$nombre] no se modificó'); location.href='tutor_empresa.php';</script>";
            }
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <form action="ModificarEmpresa.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>">

        <label for="cif">CIF:</label>
        <input type="text" name="cif" value="<?php echo $cif; ?>">

        <label for="nombre_fiscal">Nombre Fiscal:</label>
        <input type="text" name="nombre_fiscal" value="<?php echo $nombre_fiscal; ?>">

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>">

        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" value="<?php echo $direccion; ?>">

        <label for="localidad">Localidad:</label>
        <input type="text" name="localidad" value="<?php echo $localidad; ?>">

        <label for="provincia">Provincia:</label>
        <input type="text" name="provincia" value="<?php echo $provincia; ?>">

        <label for="numero_plazas">Número Plazas:</label>
        <input type="text" name="numero_plazas" value="<?php echo $numero_plazas; ?>">

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $telefono; ?>">

        <label for="persona_contacto">Persona Contacto:</label>
        <input type="text" name="persona_contacto" value="<?php echo $persona_contacto; ?>">

        <input type="submit" name="update" value="Guardar Cambios">
    </form>
</body>
</html>