<?php
require "../conection/conexion.php";
session_start();

$email=$_POST['email'];

$sql="SELECT * FROM admin WHERE email=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$email);
$stmt->execute();
$res=$stmt->get_result();

if($row=$res->fetch_assoc()){

    $token=bin2hex(random_bytes(50));
    $expira=date("Y-m-d H:i:s",strtotime("+1 hour"));

    $update="UPDATE admin SET token=?, token_expira=? WHERE email=?";
    $stmt2=$conn->prepare($update);
    $stmt2->bind_param("sss",$token,$expira,$email);
    $stmt2->execute();

    $link="http://localhost/public_html/cambiar_password.php?token=".$token;

    $asunto="Recuperar contraseña - Biocenter";

    $headers="MIME-Version: 1.0\r\n";
    $headers.="Content-type:text/html;charset=UTF-8\r\n";
    $headers.="From: Biocenter <no-reply@biocenter.com>\r\n";

    $mensaje="
    <h2>Recuperar contraseña</h2>
    <p>Haz clic en el botón:</p>
    <a href='$link' style='background:#2c7be5;color:white;padding:12px 20px;text-decoration:none;border-radius:5px;'>Cambiar contraseña</a>
    <p>Este enlace expira en 1 hora.</p>
    ";

    mail($email,$asunto,$mensaje,$headers);

    $_SESSION['success']="Revisa tu correo";
    header("Location: ../login.php");

}else{
    $_SESSION['error']="Correo no registrado";
    header("Location: ../login.php");
}
?>