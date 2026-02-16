<?php session_start(); ?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="diseno/style2.css">
</head>
<body>

<div class="login-container">
<div class="login-card">

<h2>Recuperar contraseña</h2>

<form action="PHP/enviar_reset.php" method="POST">

<div class="input-group">
<input type="email" name="email" placeholder="Correo registrado" required>
</div>

<button class="btn-login">Enviar enlace</button>

</form>

</div>
</div>

</body>
</html>
