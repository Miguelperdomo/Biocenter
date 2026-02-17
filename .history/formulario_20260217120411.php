<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agendar Cita</title>

<style>

body{
    font-family:'Segoe UI';
    background:linear-gradient(135deg,#071d33,#2c7be5);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.form-card{
    background:white;
    padding:30px;
    border-radius:15px;
    width:100%;
    max-width:600px;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
}

h2{
    text-align:center;
    margin-bottom:20px;
}

.input-group{
    margin-bottom:15px;
}

input,select,textarea{
    width:100%;
    padding:12px;
    border-radius:6px;
    border:1px solid #ddd;
}

button{
    width:100%;
    padding:15px;
    background:#ff6600;
    border:none;
    color:white;
    font-weight:bold;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#e05500;
}

</style>
</head>

<body>

<div class="form-card">

<h2>Agendar Cita</h2>

<form action="guardar_cita.php" method="POST">

<div class="input-group">
<input type="text" name="nombre" placeholder="Nombre completo" required>
</div>

<div class="input-group">
<input type="email" name="correo" placeholder="Correo electrónico" required>
</div>

<div class="input-group">
<input type="text" name="telefono" placeholder="Teléfono" required>
</div>

<div class="input-group">
<select name="tipo_cliente" required>
<option value="">Tipo de cliente</option>
<option>Persona natural</option>
<option>Empresa</option>
</select>
</div>

<div class="input-group">
<select name="servicio" required>
<option value="">Tipo de servicio</option>
<option>Médico ocupacional</option>
<option>Optometría</option>
<option>Audiometría</option>
<option>Laboratorios</option>
</select>
</div>

<div class="input-group">
<input type="date" name="fecha" required>
</div>

<div class="input-group">
<input type="time" name="hora" required>
</div>

<div class="input-group">
<textarea name="observaciones" placeholder="Observaciones"></textarea>
</div>

<button>Agendar Cita</button>

</form>

</div>

</body>
</html>
