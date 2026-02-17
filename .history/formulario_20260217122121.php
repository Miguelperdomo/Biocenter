<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agendar Cita | Biocenter</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Inter', sans-serif;
}

/* ===== BODY RESPONSIVE ===== */
body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;

    background:
        linear-gradient(rgba(7,29,51,0.75), rgba(7,29,51,0.75)),
        url("./imagenes/imagen-nosotros1.jpeg");

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
}

/* ===== TARJETA ===== */
.card{
    width:100%;
    max-width:650px;
    padding:50px;
    border-radius:18px;

    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(6px);

    box-shadow:0 30px 70px rgba(0,0,0,.3);
}

/* ===== TITULOS ===== */
.card h1{
    text-align:center;
    margin-bottom:10px;
    color:#071d33;
}

.subtitle{
    text-align:center;
    margin-bottom:35px;
    color:#64748b;
}

/* ===== INPUTS ===== */
.input-group{
    margin-bottom:20px;
}

.input-group label{
    display:block;
    font-size:13px;
    margin-bottom:6px;
    color:#334155;
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
    outline:none;
    box-shadow:0 0 0 3px rgba(37,99,235,.2);
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
    transition:.3s;
}

.btn:hover{
    background:#1d4ed8;
    transform:translateY(-2px);
}

.custom-select{
    position:relative;
    cursor:pointer;
}

.select-box{
    padding:14px;
    border-radius:10px;
    border:1px solid #e2e8f0;
    background:#f8fafc;
    font-size:15px;
}

.options{
    position:absolute;
    width:100%;
    background:white;
    border-radius:10px;
    box-shadow:0 10px 30px rgba(0,0,0,.2);
    margin-top:5px;
    display:none;
    max-height:200px;
    overflow:auto;
    z-index:999;
}

.options div{
    padding:12px;
    transition:.2s;
}

.options div:hover{
    background:#2563eb;
    color:white;
}


/* ===== RESPONSIVE ===== */
@media(max-width:768px){

    body{
        align-items:flex-start;
        padding-top:40px;
    }

    .card{
        padding:30px 20px;
    }

    .grid{
        grid-template-columns:1fr;
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

<div class="custom-select" id="clienteSelect">
    <div class="select-box">Seleccione</div>

    <div class="options">
        <div data-value="Persona natural">Persona natural</div>
        <div data-value="Empresa">Empresa</div>
    </div>

    <input type="hidden" name="tipo_cliente">
</div>
</div>


<div class="input-group">
<label>Servicio</label>

<div class="custom-select" id="servicioSelect">
    <div class="select-box">Seleccione</div>

    <div class="options">
        <div data-value="Medico ocupacional">Médico ocupacional</div>
        <div data-value="Optometria">Optometría</div>
        <div data-value="Audiometria">Audiometría</div>
        <div data-value="Laboratorios">Laboratorios</div>
    </div>

    <input type="hidden" name="servicio">
</div>
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

<script>

document.querySelectorAll(".custom-select").forEach(select=>{

    const box = select.querySelector(".select-box");
    const options = select.querySelector(".options");
    const input = select.querySelector("input");

    box.addEventListener("click",()=>{
        options.style.display = options.style.display === "block" ? "none" : "block";
    });

    options.querySelectorAll("div").forEach(opt=>{
        opt.addEventListener("click",()=>{
            box.innerText = opt.innerText;
            input.value = opt.dataset.value;
            options.style.display="none";
        });
    });

});

window.addEventListener("click",e=>{
    if(!e.target.closest(".custom-select")){
        document.querySelectorAll(".options").forEach(o=>o.style.display="none");
    }
});

</script>

</html>
