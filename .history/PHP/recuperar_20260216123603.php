<?php session_start(); ?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Recuperar contraseña</title>
<link rel="stylesheet" href="./diseno/style2.css">
</head>
<body>

<div class="login-container">
<div class="login-card">

<h2>Recuperar contraseña</h2>
<p>Ingresa tu correo</p>

<form action="PHP/enviar_reset.php" method="POST">
<input type="email" name="email" placeholder="Correo" required>
<br><br>
<button class="btn-login">Enviar enlace</button>
</form>

</div>
</div>

</body>
</html>
