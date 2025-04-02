<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="../assets/img/Logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .Logo {
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3 class="text-center">Iniciar Sesión</h3>
        <img src="../assets/img/Logo.png" alt="Logo" class="Logo img img-fluid d-block mx-auto">
        <hr>
        <form action="procesar_login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="show-password">
                <label class="form-check-label" for="show-password">Mostrar contraseña</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
        <p class="text-center mt-3">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>

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
