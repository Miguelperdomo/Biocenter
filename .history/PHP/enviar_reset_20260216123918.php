<?php
require "../conexion.php";
session_start();

$email = $_POST['email'];

$sql="SELECT * FROM admin WHERE email=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$email);
$stmt->execute();
$res=$stmt->get_result();

if($row=$res->fetch_assoc()){

    $token = bin2hex(random_bytes(50));
    $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $update="UPDATE admin SET token=?, token_expira=? WHERE email=?";
    $stmt2=$conn->prepare($update);
    $stmt2->bind_param("sss",$token,$expira,$email);
    $stmt2->execute();

    $link="http://localhost/public_html/cambiar_password.php?token=".$token;

    // ENVÍO DE CORREO
    $mensaje="Click para cambiar contraseña: ".$link;
    mail($email,"Recuperar contraseña",$mensaje);

    $_SESSION['success']="Revisa tu correo";
    header("Location: ../login.php");

}else{
    $_SESSION['error']="Correo no registrado";
    header("Location: ../login.php");
}
?>
