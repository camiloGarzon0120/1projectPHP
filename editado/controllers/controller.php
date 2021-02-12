<?php


class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])) {
			
			$enlaces = $_GET['action'];
		
		} else {

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}

	#REGISTRO DE USUARIOS
	#-------------------------------------

	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"])) {

			$datosController = array("usuario" => $_POST["usuarioRegistro"], 
							   	 	 "password" => $_POST["passwordRegistro"], 
							   	 	 "email" => $_POST["emailRegistro"]);

			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

			if($respuesta == 'success') {

				header("location:index.php?action=ok");

			} else {

				header("location:index.php");

			}
		}
	}

	#INGRESO DE USUARIOS
	#-------------------------------------

	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])) {

			$datosController = array("usuario" => $_POST["usuarioIngreso"], 
							   	 	 "password" => $_POST["passwordIngreso"]);

			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

			if ($respuesta["usuario"] == $_POST["usuarioIngreso"] && 
				$respuesta["password"] == $_POST["passwordIngreso"]) {

				session_start();
				$_SESSION["validar"] = true;

				header("location:index.php?action=usuarios");

			} else {

				header("location:index.php?action=fallo");

			}
		}
	}

	#VISTA DE USUARIOS
	#-------------------------------------

	public function vistaUsuarioController(){

		$respuesta = Datos::vistaUsuarioModel("usuarios");

		foreach ($respuesta as $key => $value) {
			
			echo'<tr>
					<td>'.$value["usuario"].'</td>
					<td>'.$value["password"].'</td>
					<td>'.$value["email"].'</td>
					<td>
						<a href="index.php?action=editar&id='.$value["id"].'">
							<button class="btn btn-sm btn-secondary">Editar</button>
						</a>
					</td>
					<td>
						<a href="index.php?action=usuarios&idBorrar='.$value["id"].'">
							<button class="btn btn-sm btn-danger ml-2">Borrar</button>
						</a>
					</td>
				</tr>';
		}
	}

	#EDITAR USUARIO
	#-------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["id"];

		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

		echo '<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

			  <input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>

			  <input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required>

			  <input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

			  <input type="submit" value="Actualizar" class="btn btn-block btn-warning">';

	}
	
	#ACTUALIZAR USUARIO
	#-------------------------------------

	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])) {

			$datosController = array("id" => $_POST["idEditar"],
									 "usuario" => $_POST["usuarioEditar"], 
							   	 	 "password" => $_POST["passwordEditar"], 
							   	 	 "email" => $_POST["emailEditar"]);

			$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == 'success') {

				header("location:index.php?action=cambio");

			} else {

				header("location:index.php");

			}
		}
	}

	#BORRAR USUARIO
	#-------------------------------------

	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])) {

			$datosController = $_GET["idBorrar"];

			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success") {

				header("location:index.php?action=usuarios");

			} 
		}
	}


}

?>