<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Recuperar contraseña</title>

<style>

/* ===== FONDO ===== */
body{
    margin:0;
    font-family:'Segoe UI', Tahoma, sans-serif;
    background: linear-gradient(135deg,#0f172a,#1e3a8a);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* ===== TARJETA ===== */
.card{
    background:white;
    width:380px;
    max-width:90%;
    padding:40px;
    border-radius:18px;
    box-shadow:0 25px 60px rgba(0,0,0,0.3);
    text-align:center;
    animation:fadeIn .7s ease;
}

@keyframes fadeIn{
    from{opacity:0;transform:translateY(30px);}
    to{opacity:1;transform:translateY(0);}
}

h2{
    margin-bottom:10px;
    color:#0f172a;
}

p{
    color:#6b7280;
    font-size:14px;
    margin-bottom:30px;
}

/* ===== INPUT ===== */
.input-group{
    margin-bottom:20px;
}

input{
    width:100%;
    padding:14px;
    border-radius:8px;
    border:1px solid #ddd;
    font-size:15px;
    transition:.3s;
}

input:focus{
    border-color:#2563eb;
    outline:none;
    box-shadow:0 0 6px rgba(37,99,235,.3);
}

/* ===== BOTON ===== */
button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:8px;
    background:#2563eb;
    color:white;
    font-size:16px;
    cursor:pointer;
    font-weight:bold;
    transition:.3s;
}

button:hover{
    background:#1d4ed8;
}

/* ===== MENSAJES ===== */
.alert{
    padding:12px;
    border-radius:6px;
    margin-bottom:20px;
    font-size:14px;
}

.success{
    background:#d1fae5;
    color:#065f46;
}

.error{
    background:#fee2e2;
    color:#7f1d1d;
}

</style>
</head>

<body>

<div class="card">

<h2>Recuperar contraseña</h2>
<p>Ingresa tu correo registrado y te enviaremos un enlace para restablecerla.</p>

<?php if(isset($_SESSION['success'])): ?>
<div class="alert success">
<?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
</div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
<div class="alert error">
<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
</div>
<?php endif; ?>

<form action="enviar_reset.php" method="POST">

<div class="input-group">
<input type="email" name="email" placeholder="Correo electrónico" required>
</div>

<button type="submit">Enviar enlace</button>

</form>

</div>

</body>
</html>
