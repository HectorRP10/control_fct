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
        <form class="col-4 p-3" method="post">
            <h3 class="text-center text-secondary">Registro de elección</h3>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Código de la Empresa</label>
                <input type="text" class="form-control" name="codigo">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Año</label>
                <input type="number" class="form-control" name="anyo">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Periodo</label>
                <input type="text" class="form-control" name="periodo">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Orden</label>
                <input type="text" class="form-control" name="orden">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>