<?php
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard_alumno</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="alumnonav.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <img class="logo"
            src="https://aulavirtual.elcampico.org/pluginfile.php/1/core_admin/logocompact/300x300/1711458408/logo__.png"
            alt="El Campico Logo">
        <nav class="nav_header">
            <ul class="ul_header">
                <li><a href="#Editar Perfil">Editar Perfil</a></li>
                <li><a href="dashboard_alumno.php">Dashboard</a></li>
                <li><a href="#historial estados">Historial Estados</a></li>
                <li><a href="login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <h1 class="text-center p-3">Elegir Prioridades</h1>
    <div class="container-fluid row">
        <form class="col-2 p-3" method="post">
            <h3 class="text-center text-secondary">Nueva Elección</h3>
            <div class="mb-3">
                <label class="form-label">Código de la Empresa</label>
                <input type="text" class="form-control" name="codigo">
            </div>
            <div class="mb-3">
                <label class="form-label">Año</label>
                <input type="number" class="form-control" name="anyo">
            </div>
            <div class="mb-3">
                <label class="form-label">Periodo</label>
                <input type="text" class="form-control" name="periodo">
            </div>
            <div class="mb-3">
                <label class="form-label">Orden</label>
                <input type="text" class="form-control" name="orden">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <div class="col-7 p-4">
        <form action="" method="get">
                <div>
                    <input type="text" name="busqueda" placeholder="Nombre">
                    <input type="submit" name="enviar" value="Buscar">
                </div>
              
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">nombre</th>
                        <th scope="col">cif</th>
                        <th scope="col">nombre_fiscal</th>
                        <th scope="col">email</th>
                        <th scope="col">direccion</th>
                        <th scope="col">localidad</th>
                        <th scope="col">provincia</th>
                        <th scope="col">numero_plazas</th>
                        <th scope="col">telefono</th>
                        <th scope="col">persona_contacto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conexion = new mysqli("localhost", "root", "", "control_fct");
                    $conexion->set_charset("utf8");
                    $sql = $conexion->query("select * from empresa LIMIT 6");
                    if (!isset($_GET["enviar"])) {
                        while ($datos = $sql->fetch_object()) { ?>
                            <tr>
                                <td><?= $datos->nombre ?></td>
                                <td><?= $datos->cif ?></td>
                                <td><?= $datos->nombre_fiscal ?></td>
                                <td><?= $datos->email ?></td>
                                <td><?= $datos->direccion ?></td>
                                <td><?= $datos->localidad ?></td>
                                <td><?= $datos->provincia ?></td>
                                <td><?= $datos->numero_plazas ?></td>
                                <td><?= $datos->telefono ?></td>
                                <td><?= $datos->persona_contacto ?></td>
                            </tr>
                        <?php }
                    } else {
                        $busqueda = $_GET["busqueda"];
                        $sql_busqueda = $conexion->query("select * from empresa where nombre LIKE '%$busqueda' LIMIT 6");
                        while ($datos_busqueda = $sql_busqueda->fetch_object()) { ?>
                            <tr>
                                <td><?= $datos_busqueda->nombre ?></td>
                                <td><?= $datos_busqueda->cif ?></td>
                                <td><?= $datos_busqueda->nombre_fiscal ?></td>
                                <td><?= $datos_busqueda->email ?></td>
                                <td><?= $datos_busqueda->direccion ?></td>
                                <td><?= $datos_busqueda->localidad ?></td>
                                <td><?= $datos_busqueda->provincia ?></td>
                                <td><?= $datos_busqueda->numero_plazas ?></td>
                                <td><?= $datos_busqueda->telefono ?></td>
                                <td><?= $datos_busqueda->persona_contacto ?></td>
                            </tr>
                        <?php }
                    }
                    ?>

                </tbody>
            </table>
           
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>