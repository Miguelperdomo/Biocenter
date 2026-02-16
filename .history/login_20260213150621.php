<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Biocenter</title>
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<div class="login-container">

    <div class="login-card">

        <div class="login-header">
            <img src="imagenes/logo-biocenter.png" alt="Biocenter">
            <h2>Panel Administrativo</h2>
            <p>Ingresa tus credenciales</p>
        </div>

        <form>

            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" placeholder="Usuario" required>
            </div>

            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" placeholder="Contraseña" required>
            </div>

            <div class="login-options">
                <label>
                    <input type="checkbox"> Recordarme
                </label>

                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>

            <button class="btn-login">
                <i class="fa fa-sign-in-alt"></i> Iniciar Sesión
            </button>

        </form>

    </div>

</div>

</body>
</html>


