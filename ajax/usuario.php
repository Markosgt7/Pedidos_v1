<?php
if (strlen(session_id()) < 1) 
  session_start();
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
$apaterno=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$especialidad=isset($_POST["especialidad"])? limpiarCadena($_POST["especialidad"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
//$amaterno=isset($_POST["amaterno"])? limpiarCadena($_POST["amaterno"]):"";
//$fecha_nacimiento=isset($_POST["fecha_nacimiento"])? limpiarCadena($_POST["fecha_nacimiento"]):"";
//$sexo=isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]):"";
//$estado_civil=isset($_POST["estado_civil"])? limpiarCadena($_POST["estado_civil"]):"";
//$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
//$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
//$ocupacion=isset($_POST["ocupacion"])? limpiarCadena($_POST["ocupacion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		
		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);
		//paso el valor de idpersona a idusuario
		/* 
		if (empty($idusuario)){
			$rspta=$usuario->insertar($apaterno,$nombre,$num_documento,$telefono,$email,$cargo,$especialidad,$login,$clavehash,$_POST['permiso']);
			echo $rspta ? "Usuario registrado" : "No se pudo registrar el usuario";
		} */
		if(empty($idusuario)){
			$rspta=$usuario->insertar($apaterno,$nombre,$num_documento,$telefono,$email,$cargo,$especialidad,$login,$clavehash,$_POST['permiso']);
			echo $rspta ? "usuario registrado": "Nose pudo registrar el usuario";
		}
		else {
			$idpersona=$idusuario;
			$rspta=$usuario->editar($idpersona,$apaterno,$nombre,$num_documento,$telefono,$email,$cargo,$especialidad,$login,$clavehash,$_POST['permiso']);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$usuario->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuario->activar($idusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button title="Editar" class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button title="Desactivar" class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
 					'<button title="Editar" class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button title="Activar" class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>', 				
 				"1"=>$reg->nombre,
 				"2"=>$reg->apellido,
 				"3"=>$reg->num_documento,
 				"4"=>$reg->telefono,
 				"5"=>$reg->cargo,
 				"6"=>$reg->especialidad,
 				"7"=>$reg->login,
 				"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
				}
	break;

	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
			$_SESSION['apellido']=$fetch->apellido;
	        $_SESSION['login']=$fetch->login;

	        //Obtenemos los permisos del usuario
	    	$marcados = $usuario->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['pedidos']=1:$_SESSION['pedidos']=0;
			in_array(3,$valores)?$_SESSION['administracion']=1:$_SESSION['administracion']=0;
			in_array(7,$valores)?$_SESSION['consultas']=1:$_SESSION['consultas']=0;
			//in_array(2,$valores)?$_SESSION['pacientes']=1:$_SESSION['pacientes']=0;
			//in_array(4,$valores)?$_SESSION['atencion']=1:$_SESSION['atencion']=0;
			//in_array(5,$valores)?$_SESSION['triaje']=1:$_SESSION['triaje']=0;
			//in_array(6,$valores)?$_SESSION['resultado']=1:$_SESSION['resultado']=0;

	    }
	    echo json_encode($fetch);
	break;

	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;
}
?>