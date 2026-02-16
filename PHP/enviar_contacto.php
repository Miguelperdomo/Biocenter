


<?php


// ============================
// 🔒 VALIDACIÓN CAPTCHA
// ============================
if (!isset($_POST['g-recaptcha-response'])) {
    header("Location: ../contacto.html?status=captcha");
    exit;
}

$secretKey = '6LeXDGcsAAAAANvJVOKV7xr4HxU6ceOAAxpOch2E';
$captcha = $_POST['g-recaptcha-response'];

$response = file_get_contents(
    "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}"
);

$result = json_decode($response, true);

if (!$result['success']) {
    header("Location: ../contacto.html?status=captcha");
    exit;
}

// ============================
// 🛑 ANTIBOT INVISIBLE (EXTRA)
// ============================
if (!empty($_POST['empresa'])) {
    exit;
}

// ============================
// 📩 ENVÍO DE CORREO (TU CÓDIGO)
// ============================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre   = htmlspecialchars($_POST['nombre']);
    $correo   = htmlspecialchars($_POST['correo']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $mensaje  = htmlspecialchars($_POST['mensaje']);

    //$destinatario = "biocentersaludocupacional@gmail.com";
    $destinatario = "perdomomiguel2004@gmail.com";
    $asunto = "Nuevo mensaje desde la página web - Biocenter";

    $contenido = "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Nuevo contacto - Biocenter</title>
    </head>
    <body style='margin:0; padding:0; background:#f4f6f8; font-family: Arial, sans-serif;'>
    
        <table width='100%' cellpadding='0' cellspacing='0' style='background:#f4f6f8; padding:20px;'>
            <tr>
                <td align='center'>
    
                    <table width='600' cellpadding='0' cellspacing='0' style='background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 5px 15px rgba(0,0,0,0.08);'>
    
                        <!-- HEADER -->
                        <tr>
                            <td style='background:#071d33; padding:20px; text-align:center;'>
                                <h1 style='color:#ffffff; margin:0; font-size:22px;'>Biocenter Salud Ocupacional</h1>
                                <p style='color:#cfd8e3; margin:5px 0 0; font-size:14px;'>Nuevo mensaje desde la página web</p>
                            </td>
                        </tr>
    
                        <!-- BODY -->
                        <tr>
                            <td style='padding:30px; color:#333;'>
    
                                <p style='font-size:15px; margin-bottom:20px;'>
                                    Se ha recibido un nuevo mensaje a través del formulario de contacto:
                                </p>
    
                                <table width='100%' cellpadding='10' cellspacing='0' style='border-collapse:collapse; font-size:14px;'>
                                    <tr style='background:#f1f5f9;'>
                                        <td width='30%'><strong>Nombre</strong></td>
                                        <td>{$nombre}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Correo</strong></td>
                                        <td>{$correo}</td>
                                    </tr>
                                    <tr style='background:#f1f5f9;'>
                                        <td><strong>Teléfono</strong></td>
                                        <td>{$telefono}</td>
                                    </tr>
                                </table>
    
                                <div style='margin-top:25px;'>
                                    <p style='margin-bottom:8px;'><strong>Mensaje:</strong></p>
                                    <div style='background:#f8fafc; padding:15px; border-left:4px solid #2c7be5; border-radius:6px; font-size:14px; line-height:1.6;'>
                                        {$mensaje}
                                    </div>
                                </div>
    
                            </td>
                        </tr>
    
                        <!-- FOOTER -->
                        <tr>
                            <td style='background:#f1f5f9; padding:15px; text-align:center; font-size:12px; color:#666;'>
                                Este mensaje fue enviado desde <strong>biocentersaludocupacional.com</strong><br>
                                © ".date('Y')." Biocenter Salud Ocupacional
                            </td>
                        </tr>
    
                    </table>
    
                </td>
            </tr>
        </table>
    
    </body>
    </html>
    ";


    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: Biocenter Web <no-reply@biocentersaludocupacional.com>\r\n";

    if (mail($destinatario, $asunto, $contenido, $headers)) {
    header("Location: ../contacto.html?status=ok");
    exit;
    } else {
        header("Location: ../contacto.html?status=error");
        exit;
    }

}
?>
