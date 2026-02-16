<?php

// ================= CONFIGURACIÓN =================
$destinatario = "biocentersaludocupacional@gmail.com";

// ================= VALIDACIÓN =================
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../contacto.html");
    exit;
}

// ================= DATOS DEL FORM =================
$nombre   = htmlspecialchars($_POST['nombre'] ?? '');
$correo   = htmlspecialchars($_POST['correo'] ?? '');
$telefono = htmlspecialchars($_POST['telefono'] ?? '');
$tipo     = htmlspecialchars($_POST['tipo'] ?? 'No especificado');
$mensaje  = nl2br(htmlspecialchars($_POST['mensaje'] ?? ''));
$rating   = intval($_POST['rating'] ?? 0);

$rating = max(1, min(5, $rating)); // asegura 1 a 5

$asunto = "Nueva PQR recibida - Biocenter";

// ================= HEADERS =================
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= "From: Biocenter Salud Ocupacional <no-reply@biocentersaludocupacional.com>\r\n";

// ================= CONTENIDO HTML =================
$contenido = "
<!DOCTYPE html>
<html lang='es'>
<head>
<meta charset='UTF-8'>
<title>Nueva PQR</title>
</head>

<body style='margin:0; padding:0; background:#f4f6f8; font-family: Arial, Helvetica, sans-serif;'>

<table width='100%' cellpadding='0' cellspacing='0' style='padding:25px 0;'>
<tr>
<td align='center'>

<table width='100%' cellpadding='0' cellspacing='0' style='max-width:620px; background:#ffffff; border-radius:20px; overflow:hidden; box-shadow:0 12px 35px rgba(0,0,0,.15);'>

<!-- HEADER -->
<tr>
<td style='background:#071d33; padding:30px; text-align:center;'>
<img src='https://biocentersaludocupacional.com/imagenes/logo-biocenter.png' alt='Biocenter' style='width:160px; margin-bottom:10px;'>
<h2 style='color:#ffffff; margin:0;'>Nueva solicitud PQR</h2>
<p style='color:#d0d0d0; margin:5px 0 0;'>Formulario Web</p>
</td>
</tr>

<!-- BODY -->
<tr>
<td style='padding:30px;'>

<h3 style='color:#071d33; border-bottom:3px solid #ff6600; padding-bottom:8px;'>Datos del usuario</h3>

<p><strong>Nombre:</strong> {$nombre}</p>
<p><strong>Correo:</strong> {$correo}</p>
<p><strong>Teléfono:</strong> {$telefono}</p>
<p><strong>Tipo de solicitud:</strong> {$tipo}</p>

<h3 style='color:#071d33; margin-top:25px;'>Mensaje</h3>
<p style='background:#f7f7f7; padding:15px; border-radius:10px;'>
{$mensaje}
</p>

<h3 style='color:#071d33; margin-top:25px;'>Calificación del servicio</h3>

<p style='font-size:24px; color:#ff6600; margin:0;'>
" . str_repeat("★", $rating) . str_repeat("☆", 5 - $rating) . "
</p>

</td>
</tr>

<!-- FOOTER -->
<tr>
<td style='background:#f1f1f1; padding:20px; text-align:center; font-size:12px; color:#666;'>
Este mensaje fue enviado desde el formulario PQR de<br>
<strong>biocentersaludocupacional.com</strong><br><br>
© " . date("Y") . " Biocenter Salud Ocupacional
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>
";

// ================= ENVÍO =================

if (mail($destinatario, $asunto, $contenido, $headers)) {
    header("Location: ../index.html?status=ok");
    exit;
    } else {
        header("Location: ../index.html?status=error");
        exit;
    }
?>
