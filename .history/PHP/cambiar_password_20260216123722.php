<?php
require "../conec;

$token=$_GET['token'];

$sql="SELECT * FROM admin WHERE token=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$token);
$stmt->execute();
$res=$stmt->get_result();

if(!$res->fetch_assoc()){
    die("Token inválido");
}
?>

<form action="PHP/actualizar_password.php" method="POST">
<input type="hidden" name="token" value="<?php echo $token; ?>">
<input type="password" name="password" placeholder="Nueva contraseña" required>
<button>Cambiar contraseña</button>
</form>
