<?php
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }
    $host='localhost';
    $dbname='control_fct';
    $user='root';
    $pass='';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST["eliminar"])) {
            $nombre = $_POST["nombre"] ?? null; 
            $cif = $_POST["cif"] ?? null;

            $sql = "DELETE FROM empresa WHERE nombre = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nombre]);

            if ($stmt->rowCount() == 1) {
                echo "<script>alert('La empresa [$nombre] se eliminó correctamente'); location.href='tutor_empresa.php';</script>";
            } else {
                echo "<script>alert('La empresa [$nombre] no se eliminó correctamente'); location.href='tutor_empresa.php';</script>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

?>