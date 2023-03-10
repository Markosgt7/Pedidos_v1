<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Pedido
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}	
	//Implementar un método para listar las familias
	public function select_familias()
	{
		$sql="SELECT * FROM familias where estado=1";
		return ejecutarConsulta($sql);		
	}

	public function select_clientes()
	{
		$sql="SELECT * FROM clientes";
		return ejecutarConsulta($sql);
	}
	public function select_productos($code_product)
	{
		$sql="select p.id_product, p.product_code, p.description 
		from prueba.productos p 
		inner join prueba.familias f 
			on f.product_code = p.product_code 
		and p.product_code='$code_product'";
		return ejecutarConsulta($sql);		
	}

	public function select_datos_cliente($code_customer){
		$sql="select 
		c.nombre ,
		c.direccion 
		from prueba.clientes c
		where c.id_cliente ='$code_customer'";
		return ejecutarConsulta($sql);
	}

	

	//Implementar un método para listar los registros
	/*public function listar()
	{
		$sql="SELECT a.idatencion,a.idpersona,p.num_documento,CONCAT((YEAR( CURDATE( ) ) - YEAR( fecha_nacimiento ) - IF( MONTH( CURDATE( ) ) < MONTH( fecha_nacimiento), 1, 
IF ( MONTH(CURDATE( )) = MONTH(fecha_nacimiento),IF (DAY( CURDATE( ) ) < DAY( fecha_nacimiento ),1,0 ),0))),' años, ',(MONTH(CURDATE()) - MONTH( fecha_nacimiento) + 12 * IF( MONTH(CURDATE())<MONTH(fecha_nacimiento), 1,IF(MONTH(CURDATE())=MONTH(fecha_nacimiento),IF (DAY(CURDATE())<DAY(fecha_nacimiento),1,0),0)) - IF(MONTH(CURDATE())<>MONTH(fecha_nacimiento),(DAY(CURDATE())<DAY(fecha_nacimiento)), IF (DAY(CURDATE())<DAY(fecha_nacimiento),1,0 ))),' meses, ',(DAY( CURDATE( ) ) - DAY( fecha_nacimiento ) +30 * ( DAY(CURDATE( )) < DAY(fecha_nacimiento) )),' días') as edad,concat(p.apaterno,' ',p.amaterno,' ',p.nombre) as paciente,a.fecha,a.hora,(select concat(apaterno,' ',amaterno,' ',nombre) from persona where idpersona=a.idusuario) as registrador,(select concat(apaterno,' ',amaterno,' ',nombre) from persona where idpersona=a.idempleado) as especialista,s.nombre as servicio,a.costo,a.estado FROM atencion a INNER JOIN persona p ON a.idpersona=p.idpersona inner join servicio s on a.idservicio=s.idservicio WHERE a.estado<>'Anulado' order by a.idatencion desc limit 0,100";
		return ejecutarConsulta($sql);		
	}*/

	


	

}

?>