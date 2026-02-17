<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agendar Cita | Biocenter</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Inter', sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;

    /* IMAGEN DE FONDO */
    background: 
        linear-gradient(rgba(7,29,51,0.75), rgba(7,29,51,0.75)),
        url("./imagenes/imagen-nosotros1.jpeg");

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}


/* ===== TARJETA ===== */
.card{
    background:white;
    width:100%;
    max-width:600px;
    padding:50px 45px;
    border-radius:20px;
    box-shadow:0 30px 70px rgba(0,0,0,.12);
    animation:fadeIn .7s ease;
}

@keyframes fadeIn{
    from{opacity:0;transform:translateY(40px);}
    to{opacity:1;transform:translateY(0);}
}

.card h1{
    text-align:center;
    font-size:28px;
    margin-bottom:8px;
    color:#0f172a;
}

.subtitle{
    text-align:center;
    color:#64748b;
    font-size:14px;
    margin-bottom:35px;
}

/* ===== INPUTS ===== */
.input-group{
    margin-bottom:20px;
}

.input-group label{
    font-size:13px;
    color:#475569;
    display:block;
    margin-bottom:6px;
}

.input-group input,
.input-group select,
.input-group textarea{
    width:100%;
    padding:14px;
    border-radius:10px;
    border:1px solid #e2e8f0;
    background:#f8fafc;
    font-size:15px;
    transition:.3s;
}

.input-group input:focus,
.input-group select:focus{
    background:white;
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,.2);
    outline:none;
}

/* ===== GRID ===== */
.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
}

/* ===== BOTÓN ===== */
.btn{
    width:100%;
    padding:16px;
    border:none;
    border-radius:12px;
    background:#2563eb;
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    margin-top:10px;
    transition:.3s;
}

.btn:hover{
    background:#1d4ed8;
    transform:translateY(-2px);
    box-shadow:0 15px 30px rgba(0,0,0,.2);
}

/* ===== RESPONSIVE ===== */
@media(max-width:600px){
    .grid{
        grid-template-columns:1fr;
    }

    .card{
        padding:35px 25px;
    }
}

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
