<!DOCTYPE html>
<html>
<head>
<title>Inicio de Sesión</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="estilologin.css">
</head>
<body>
    <form method="post">
    <img src="logo__.svg" alt="Logo mal">
    <h1>Inicio de Sesión</h1>
    <input type="text" name="usuario" placeholder="Nombre">
    <input type="password" name="password" placeholder="Contraseña">
    <input type="submit" name="enviar" value="Iniciar Sesion">
       
    <?php
        session_start();

        $conexion = new mysqli("localhost", "root", "", "control_fct");
        $conexion->set_charset("utf8");
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST["usuario"]) || empty($_POST["password"])) {
                echo '<div class="bad">Los campos están vacíos</div>';
            } else {
                $usuario = $conexion->real_escape_string($_POST["usuario"]);
                $password = $conexion->real_escape_string($_POST["password"]);
    
                $sql_alumno = $conexion->query("SELECT * FROM alumno WHERE nombre='$usuario' AND password='$password'");
                $sql_tutor = $conexion->query("SELECT * FROM tutor WHERE nombre='$usuario' AND password='$password'");
    
                if ($datos_alumno = $sql_alumno->fetch_object()) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['role'] = 'alumno';
                    header("Location: dashboard_alumno.php");
                    exit;
                } elseif ($datos_tutor = $sql_tutor->fetch_object()) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['role'] = 'tutor';
                    header("Location: dashboard_tutor.php");
                    exit;
                } else {
                    echo '<div class="bad">El usuario o la contraseña no son correctos</div>';
                }
            }
        }
    ?>
    </form>

</body> 
</html>