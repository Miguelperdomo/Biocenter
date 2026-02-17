<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Agendar Cita | Biocenter</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* ===== RESET ===== */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI';
}

/* ===== BODY ===== */
body{
    height:100vh;
    display:flex;
}

/* ===== LADO IZQUIERDO ===== */
.left-panel{
    width:40%;
    background:linear-gradient(135deg,#071d33,#2c7be5);
    color:white;
    padding:50px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.left-panel h1{
    font-size:40px;
    margin-bottom:20px;
}

.left-panel p{
    line-height:1.6;
    margin-bottom:25px;
}

.benefits{
    margin-top:20px;
}

.benefits div{
    margin-bottom:15px;
}

/* ===== FORMULARIO ===== */
.right-panel{
    width:60%;
    background:#f4f7fb;
    display:flex;
    justify-content:center;
    align-items:center;
}

.form-card{
    background:white;
    padding:40px;
    border-radius:15px;
    width:100%;
    max-width:600px;
    box-shadow:0 15px 40px rgba(0,0,0,.15);
}

.form-card h2{
    text-align:center;
    margin-bottom:25px;
    color:#071d33;
}

.input-group{
    margin-bottom:18px;
}

.input-group input,
.input-group select,
.input-group textarea{
    width:100%;
    padding:14px;
    border-radius:8px;
    border:1px solid #ddd;
    font-size:15px;
}

.input-group input:focus,
.input-group select:focus{
    border-color:#2c7be5;
    outline:none;
}

/* ===== BOTÓN ===== */
.btn{
    width:100%;
    padding:15px;
    background:linear-gradient(45deg,#ff6600,#ff9a00);
    border:none;
    color:white;
    font-size:16px;
    font-weight:bold;
    border-radius:8px;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}

/* ===== RESPONSIVE ===== */
@media(max-width:900px){
    .left-panel{ display:none; }
    .right-panel{ width:100%; }
}

</style>
</head>

<body>

<!-- PANEL IZQUIERDO -->
<div class="left-panel">

<h1>Agenda tu cita médica</h1>

<p>
En Biocenter Salud Ocupacional te ofrecemos atención profesional,
rápida y segura para cuidar tu bienestar.
</p>

<div class="benefits">
<div><i class="fa fa-check"></i> Atención inmediata</div>
<div><i class="fa fa-check"></i> Especialistas certificados</div>
<div><i class="fa fa-check"></i> Resultados confiables</div>
<div><i class="fa fa-check"></i> Tecnología avanzada</div>
</div>

</div>

<!-- FORMULARIO -->
<div class="right-panel">

<div class="form-card">

<h2>Agendar Cita</h2>

<form>

<div class="input-group">
<input type="text" placeholder="Nombre completo" required>
</div>

<div class="input-group">
<input type="email" placeholder="Correo electrónico" required>
</div>

<div class="input-group">
<input type="text" placeholder="Teléfono" required>
</div>

<div class="input-group">
<select required>
<option>Tipo de cliente</option>
<option>Persona natural</option>
<option>Empresa</option>
</select>
</div>

<div class="input-group">
<select required>
<option>Tipo de servicio</option>
<option>Médico ocupacional</option>
<option>Optometría</option>
<option>Audiometría</option>
<option>Laboratorios</option>
</select>
</div>

<div class="input-group">
<input type="date" required>
</div>

<div class="input-group">
<input type="time" required>
</div>

<div class="input-group">
<textarea placeholder="Observaciones"></textarea>
</div>

<button class="btn">Agendar Cita</button>

</form>

</div>

</div>

</body>
</html>
