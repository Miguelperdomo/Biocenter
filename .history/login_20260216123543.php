<?php session_start(); ?>

<!-- MODAL DE CONTRASEÑA INCORRECTA -->
<?php if(isset($_SESSION['error'])): ?>
<div id="errorModal" class="modal-error">
    <div class="modal-box">
        <i class="fa fa-circle-xmark"></i>
        <p><?php echo $_SESSION['error']; ?></p>
    </div>
</div>

<script>
setTimeout(()=>{
    document.getElementById("errorModal").style.opacity="0";
    setTimeout(()=>{
        document.getElementById("errorModal").style.display="none";
    },500);
},3000);
</script>

<?php unset($_SESSION['error']); endif; ?>


<!-- MODAL DE CERRAR SESION -->

<?php if(isset($_SESSION['success'])): ?>
<div id="successModal" class="modal-success">
    <div class="modal-box-success">
        <i class="fa fa-circle-check"></i>
        <p><?php echo $_SESSION['success']; ?></p>
    </div>
</div>

<script>
setTimeout(()=>{
    document.getElementById("successModal").style.opacity="0";
    setTimeout(()=>{
        document.getElementById("successModal").style.display="none";
    },500);
},2500);
</script>

<?php unset($_SESSION['success']); endif; ?>



<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Biocenter</title>
<link rel="stylesheet" href="./diseno/style2.css">
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

        <form action="./PHP/procesar_login.php" method="POST">

            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" name="usuario" placeholder="Usuario" required>
            </div>

            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>

            <div class="login-options">
                <a href="./">¿Olvidaste tu contraseña?</a>
            </div>

            <button class="btn-login">
                <i class="fa fa-sign-in-alt"></i> Iniciar Sesión
            </button>

        </form>

    </div>

</div>

</body>
</html>


