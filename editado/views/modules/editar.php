<?php 

session_start();

if(!$_SESSION["validar"]) {

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>EDITAR USUARIO</h1>

<form method="post" action="">
	
	<?php 

	$ediarUsuario = new MvcController();
	$ediarUsuario -> editarUsuarioController();
	$ediarUsuario -> actualizarUsuarioController();

	?>

</form>

