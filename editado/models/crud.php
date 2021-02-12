<?php 

require_once "conexion.php";

class Datos extends Conexion 
{

	#REGISTRO DE USUARIOS
	#-------------------------------------
	public function registroUsuarioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, password, email) VALUES (:usuario, :password, :email)");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

		if($stmt->execute()) {

			return "success";

		} else {

			return "error";

		}
	}

	#INGRESO DE USUARIOS
	#-------------------------------------
	public function ingresoUsuarioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT usuario, password FROM $tabla WHERE usuario = :usuario");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();
	}

	#VISTA DE USUARIOS
	#-------------------------------------
	public function vistaUsuarioModel($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

	}

	#EDITAR USUARIO
	#-------------------------------------
	public function editarUsuarioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email  FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

	}

	#ACTUALIZAR DE USUARIOS
	#-------------------------------------
	public function actualizarUsuarioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email =:email WHERE id = :id");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

		if($stmt->execute()) {

			return "success";

		} else {

			return "error";

		}
	}

	#BORRAR USUARIO
	#-------------------------------------
	public function borrarUsuarioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()) {

			return "success";

		} else {

			return "error";

		}

	}


}
	

?>