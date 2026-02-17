<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agendar Cita | Biocenter</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>


</style>
</head>

<body>

<div class="card">

<h1>Agendar Cita</h1>
<p class="subtitle">Complete el formulario para programar su atención médica</p>

<form action="guardar_cita.php" method="POST">

<div class="input-group">
<label>Nombre completo</label>
<input type="text" name="nombre" required>
</div>

<div class="grid">

<div class="input-group">
<label>Correo electrónico</label>
<input type="email" name="correo" required>
</div>

<div class="input-group">
<label>Teléfono</label>
<input type="text" name="telefono" required>
</div>

</div>

<div class="grid">

<div class="input-group">
<label>Tipo de cliente</label>
<select name="tipo_cliente" required>
<option value="">Seleccione</option>
<option>Persona natural</option>
<option>Empresa</option>
</select>
</div>

<div class="input-group">
<label>Servicio médico</label>
<select name="servicio" required>
<option value="">Seleccione</option>
<option>Médico ocupacional</option>
<option>Optometría</option>
<option>Audiometría</option>
<option>Laboratorios</option>
</select>
</div>

</div>

<div class="grid">

<div class="input-group">
<label>Fecha</label>
<input type="date" name="fecha" required>
</div>

<div class="input-group">
<label>Hora</label>
<input type="time" name="hora" required>
</div>

</div>

<div class="input-group">
<label>Observaciones</label>
<textarea name="observaciones" rows="3"></textarea>
</div>

<button class="btn">Agendar Cita</button>

</form>

</div>

</body>
</html>
