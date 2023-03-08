<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($apaterno,$nombre,$num_documento,$telefono,$email,$cargo,$especialidad,$login,$clave,$permisos)
	{
		//Insertamos primero a la persona
		/* $sql1="INSERT INTO persona (apaterno,nombre) VALUES ('$apaterno','$nombre')";
		$idpersonanew=ejecutarConsulta_retornarID($sql1); */

		$sql1="SELECT MAX(idusuario) + 1 FROM usuario";
		$idpersonanew=ejecutarConsultaSimpleFila($sql1);

		$sql2="INSERT INTO usuario (idusuario,cargo,especialidad,login,clave,condicion,nombre,apellido,num_documento,email,telefono)
		VALUES ('$idpersonanew','$cargo','$especialidad','$login','$clave','1','$nombre','$apaterno','$num_documento','$email','$telefono')";
		//return ejecutarConsulta($sql);
		ejecutarConsultaSimpleFila($sql2);

		$num_elementos=0;
		$sw=true;

		/* while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idpersonanew', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		} */

		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idpersona,$apaterno,$nombre,$num_documento,$telefono,$email,$cargo,$especialidad,$login,$clave,$permisos)
	{
		$sql1="UPDATE persona SET apaterno='$apaterno', nombre='$nombre' WHERE idpersona='$idpersona'";
		ejecutarConsulta($sql1);

		$sql2="UPDATE usuario SET cargo='$cargo',especialidad='$especialidad',login='$login', clave='$clave', apellido='$apaterno', nombre='$nombre',num_documento='$num_documento',telefono='$telefono',email='$email'  WHERE idusuario='$idpersona'";
		ejecutarConsulta($sql2);


		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idpersona'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idpersona', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario u  WHERE u.idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		//$sql="SELECT * FROM usuario u INNER JOIN persona p WHERE p.idpersona=u.idusuario";
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT u.idusuario,u.nombre, u.apellido, u.num_documento,u.telefono,u.email,u.cargo,u.login FROM usuario u  WHERE u.login='$login' AND u.clave='$clave' AND u.condicion='1'"; 
    	return ejecutarConsulta($sql);  
    }
}

?>