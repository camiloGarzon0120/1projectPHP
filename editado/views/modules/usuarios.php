<?php 

session_start();

if(!$_SESSION["validar"]) {

	header("location:index.php?action=ingresar");

	exit();

}

?>


<h1>USUARIOS</h1>

<table class="table table-hover table-bordered border-2">
	
	<thead class="table-dark">
		
		<tr class="text-center">
			<th>Usuario</th>
			<th>Contraseña</th>
			<th>Email</th>
			<th></th>
			<th></th>

		</tr>

	</thead>

	<tbody>
		
		<?php 

		$vistaUsuario = new MvcController();
		$vistaUsuario -> vistaUsuarioController();
		$vistaUsuario -> borrarUsuarioController();

		?>
		
	</tbody>

</table>

<?php 

if (isset($_GET["action"])) {

	if ($_GET["action"] == 'cambio') {
		
		echo "Cambio exitoso!";

	}

}

 ?>