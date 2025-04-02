<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="../assets/img/Logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container col-md-4">
        <h2 class="text-center">Registro Exitoso</h2>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['registro_exito']; unset($_SESSION['registro_exito']); ?>
        </div>
        <p class="text-center">Ahora puedes iniciar sesión.</p>
        <a href="login.php" class="btn btn-primary w-100">Iniciar Sesión</a>
    </div>
</body>
</html>