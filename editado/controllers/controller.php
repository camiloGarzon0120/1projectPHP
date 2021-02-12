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
					<td><button class="btn btn-sm btn-secondary">Editar</button></td>
					<td><button class="btn btn-sm btn-danger ml-2">Borrar</button></td>
				</tr>';
		}
	}
	



}

?>