<?php
session_start();
require "../conection/conexion.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

/* CONTADORES */
$hoy = date("Y-m-d");

$citasHoy = $conn->query("SELECT COUNT(*) total FROM citas WHERE fecha='$hoy'")->fetch_assoc()['total'];
$pendientes = $conn->query("SELECT COUNT(*) total FROM citas WHERE estado='Pendiente'")->fetch_assoc()['total'];
$confirmadas = $conn->query("SELECT COUNT(*) total FROM citas WHERE estado='Confirmada'")->fetch_assoc()['total'];
$canceladas = $conn->query("SELECT COUNT(*) total FROM citas WHERE estado='Cancelada'")->fetch_assoc()['total'];

$citas = $conn->query("SELECT * FROM citas ORDER BY fecha DESC, hora DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Administrador</title>

<style>

/* ===== GENERAL ===== */
body{
    margin:0;
    font-family:'Segoe UI';
    display:flex;
    background:#f1f5f9;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:230px;
    background:#0f172a;
    height:100vh;
    color:white;
    padding:20px;
}

.sidebar h2{text-align:center;}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
    transition:.3s;
}

.sidebar a:hover{background:#2563eb;}

/* ===== CONTENIDO ===== */
.main{flex:1;padding:30px;}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.card{
    background:white;
    padding:20px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.card h3{margin:0;font-size:32px;color:#2563eb;}

/* ===== TABLA ===== */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

th,td{padding:14px;text-align:left;}
th{background:#0f172a;color:white;}

.estado{
    padding:6px 12px;
    border-radius:20px;
    color:white;
    font-size:12px;
}
.pendiente{background:#f59e0b;}
.confirmada{background:#22c55e;}
.cancelada{background:#ef4444;}

.btn{
    padding:6px 10px;
    border:none;
    border-radius:6px;
    color:white;
    cursor:pointer;
    margin:2px;
}
.accept{background:#22c55e;}
.cancel{background:#f97316;}
.delete{background:#ef4444;}

/* ===== MODAL PREMIUM ===== */
.modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(15,23,42,.7);
    backdrop-filter:blur(6px);
    justify-content:center;
    align-items:center;
}

.modal-content{
    background:white;
    border-radius:18px;
    padding:35px;
    width:90%;
    max-width:420px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,.25);
}

.modal-icon{font-size:50px;margin-bottom:15px;}

.modal-actions{
    display:flex;
    gap:15px;
    margin-top:20px;
}

.modal-actions button{
    flex:1;
    padding:12px;
    border:none;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
}

.btn-primary{background:#2563eb;color:white;}
.btn-secondary{background:#e2e8f0;color:#334155;}

/* BUSCADOR PROFESIONAL */

/* BUSCADOR PROFESIONAL IZQUIERDA */

.search-box{
    margin-bottom:20px;
    display:flex;
    justify-content:flex-start; /* 👈 CAMBIO CLAVE */
}

.search-box input{
    width:350px;
    max-width:100%;
    padding:12px 15px;
    border-radius:10px;
    border:1px solid #cbd5e1;
    font-size:15px;
    transition:.3s;
    background:#fff;
}
.search-box{
    margin:20px 0;
}

.search-box input{
    width:100%;
    max-width:400px;
}



.search-box input:focus{
    outline:none;
    border-color:#2563eb;
    box-shadow:0 0 8px rgba(37,99,235,.25);
}

/* CONTENEDOR BUSCADOR + BOTON */

.search-container{
    display:flex;
    align-items:center;
    gap:15px;
    margin:20px 0;
}

/* BOTON NUEVA CITA PREMIUM */

.btn-new{
    background:linear-gradient(135deg,#2563eb,#1e40af);
    color:white;
    border:none;
    padding:12px 22px;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
    font-size:15px;
    box-shadow:0 5px 15px rgba(37,99,235,.3);
    transition:.3s;
}

.btn-new:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(37,99,235,.4);
}


/* ===== MODAL BIENVENIDA ===== */

.modal-bienvenida{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(15,23,42,.7);
    backdrop-filter:blur(6px);
    justify-content:center;
    align-items:center;
    z-index:999;
}

.bienvenida-box{
    background:white;
    border-radius:18px;
    padding:40px;
    width:90%;
    max-width:500px;
    text-align:center;
    box-shadow:0 20px 50px rgba(0,0,0,.25);
    animation:aparecer .4s ease;
}

.bienvenida-box h2{
    margin:0 0 15px;
    color:#2563eb;
}

.bienvenida-info{
    display:flex;
    gap:20px;
    margin-top:25px;
}

.bienvenida-card{
    flex:1;
    background:#f1f5f9;
    padding:20px;
    border-radius:12px;
}

.bienvenida-card h3{
    margin:0;
    font-size:28px;
    color:#2563eb;
}

@keyframes aparecer{
    from{transform:scale(.8);opacity:0}
    to{transform:scale(1);opacity:1}
}

</style>
</head>

<body>

<div class="sidebar">
<h2>Biocenter</h2>
<a href="panel.php">📊 Dashboard</a>
<a href="#">📅 Citas</a>
<a href="logout.php">🚪 Cerrar sesión</a>
</div>

<div class="main">

<h1>Panel Administrador</h1>

<div class="cards">
<div class="card"><p>Citas Hoy</p><h3><?=$citasHoy?></h3></div>
<div class="card"><p>Pendientes</p><h3><?=$pendientes?></h3></div>
<div class="card"><p>Confirmadas</p><h3><?=$confirmadas?></h3></div>
<div class="card"><p>Canceladas</p><h3><?=$canceladas?></h3></div>
</div>

<h2>Citas agendadas</h2>

<div class="search-container">

    <div class="search-box">
        <input type="text" id="buscarCita" placeholder="🔎 Buscar por nombre, servicio, fecha o estado...">
    </div>

    <button class="btn-new" onclick="nuevaCita()">
        + Nueva Cita
    </button>

</div>


<table>
<tr>
<th>Nombre</th>
<th>Servicio</th>
<th>Fecha</th>
<th>Hora</th>
<th>Estado</th>
<th>Acciones</th>
</tr>

<?php while($row=$citas->fetch_assoc()): ?>

<tr>
<td><?=$row['nombre_completo']?></td>
<td><?=$row['tipo_servicio']?></td>
<td><?=$row['fecha']?></td>
<td><?=$row['hora']?></td>

<td>
<span class="estado 
<?= $row['estado']=="Pendiente"?"pendiente":($row['estado']=="Confirmada"?"confirmada":"cancelada") ?>">
<?=$row['estado']?>
</span>
</td>

<td>
<button class="btn accept" onclick="confirmar(<?=$row['id']?>,'confirmar')">Aceptar</button>
<button class="btn cancel" onclick="confirmar(<?=$row['id']?>,'cancelar')">Cancelar</button>
<button class="btn delete" onclick="confirmar(<?=$row['id']?>,'eliminar')">Eliminar</button>
</td>
</tr>

<?php endwhile; ?>
</table>

</div>

<!-- MODAL CONFIRM -->
<div id="modalConfirm" class="modal">
<div class="modal-content">
<div class="modal-icon" id="icono">⚠️</div>
<h2 id="titulo"></h2>
<p id="texto"></p>
<div class="modal-actions">
<button class="btn-primary" onclick="ejecutar()">Confirmar</button>
<button class="btn-secondary" onclick="cerrar()">Cancelar</button>
</div>
</div>
</div>

<form id="formAccion" method="POST" action="accion_cita.php">
<input type="hidden" name="id" id="idCita">
<input type="hidden" name="accion" id="accionCita">
</form>

<script>

let idActual="";
let accionActual="";

function confirmar(id,accion){

idActual=id;
accionActual=accion;

document.getElementById("modalConfirm").style.display="flex";

if(accion=="confirmar"){
icono.innerHTML="🟢";
titulo.innerText="Confirmar Cita";
texto.innerText="¿Deseas confirmar esta cita médica?";
}

if(accion=="cancelar"){
icono.innerHTML="🟠";
titulo.innerText="Cancelar Cita";
texto.innerText="¿Deseas cancelar esta cita?";
}

if(accion=="eliminar"){
icono.innerHTML="🔴";
titulo.innerText="Eliminar Cita";
texto.innerText="Esta acción no se puede deshacer.";
}
}

function cerrar(){
document.getElementById("modalConfirm").style.display="none";
}

function ejecutar(){
document.getElementById("idCita").value=idActual;
document.getElementById("accionCita").value=accionActual;
document.getElementById("formAccion").submit();
}

</script>

<script>

const buscador = document.getElementById("buscarCita");

buscador.addEventListener("keyup", function(){

    let filtro = buscador.value.toLowerCase();
    let filas = document.querySelectorAll("table tr");

    filas.forEach((fila, index) => {

        if(index === 0) return; // saltar encabezado

        let texto = fila.textContent.toLowerCase();

        if(texto.includes(filtro)){
            fila.style.display = "";
        }else{
            fila.style.display = "none";
        }

    });

});

</script>
<script>

function nuevaCita(){
    window.location.href = "../formulario.php";
}

</script>


</body>
</html>
