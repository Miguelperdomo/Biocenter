<?php
require "../conection/conexion.php";
session_start();
session_start();

$token=$_POST['token'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);

$sql="UPDATE admin SET password=?, token=NULL WHERE token=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("ss",$password,$token);
$stmt->execute();

$_SESSION['success']="Contraseña actualizada";
header("Location: ../login.php");
?>