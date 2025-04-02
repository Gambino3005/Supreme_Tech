<?php 
session_start(); 
include "../includes/config.php"; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
        .logo {
            max-width: 150px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container col-md-4">
        <img src="../assets/img/Logo.png" alt="Logo" class="logo img-fluid d-block mx-auto">
        <hr>
        <h2 class="text-center">Registro de Usuario</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['registro_exito'])): ?>
            <div class="alert alert-success" role="alert">
                <?= $_SESSION['registro_exito']; unset($_SESSION['registro_exito']); ?>
            </div>
        <?php endif; ?>

        <form action="procesar_registro.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" name="telefono" class="form-control">
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion:</label>
                <input type="text" name="direccion" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad:</label>
                <input type="text" name="ciudad" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado/Provincia:</label>
                <input type="text" name="estado" class="form-control" required>
            </div>
            <!-- <div class="mb-3">
                <label for="codigo_postal" class="form-label">Código Postal:</label>
                <input type="text" name="codigo_postal" class="form-control" required>
            </div> -->
            <div class="mb-3">
                <label for="pais" class="form-label">País:</label>
                <input type="text" name="pais" class="form-control" required>
            </div>
            <!-- <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" class="form-control">
            </div> -->
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="contrasena" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="show-password">
                <label class="form-check-label" for="show-password">Mostrar contraseña</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
    </div>

    <p class="text-center mt-3">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    
    <script>
        // JavaScript para alternar la visibilidad de la contraseña
        const showPasswordCheckbox = document.getElementById('show-password');
        const passwordField = document.getElementById('password');

        showPasswordCheckbox.addEventListener('change', function () {
            if (this.checked) {
                passwordField.type = 'text'; // Muestra la contraseña
            } else {
                passwordField.type = 'password'; // Oculta la contraseña
            }
        });
    </script>

</body>
</html>