<?php 
require_once "../modelos/Pedido.php";

$atencion=new Pedido();



switch ($_GET["op"]){
	/* case 'listarTriaje':
		$num=1;
		$rspta=$atencion->listarEscritorioTriaje();
		echo '<thead>
                <tr>
                    <th style="font-size: 30px">#</th>
                    <th style="font-size: 30px">Triaje</th>
                </tr>
              </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr ><td style="font-size: 30px"><span class="label bg-green">'.$num.'</span></td>
						<td style="font-size: 30px">'.$reg->paciente.'</td></tr>';
					$num=$num+1;
				}
	break; */
	case "selectFamilias":
		require_once "../modelos/Pedido.php";
		$pedido = new Pedido();
		$rspta = $pedido->select_familias();
		echo'<option value="0">Seleccione</option>';
		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->product_code . '>' . $reg->product_alias. '</option>';
				}
	break;

	case "selectProductos":
		require_once "../modelos/Pedido.php";
		$pedido = new Pedido();
		$code_product=$_POST['id_producto'];

		$rspta = $pedido->select_productos($code_product);

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_product . '>' . $reg->description. '</option>';
				}
	break;
	case "selectClientes":
		require_once "../modelos/Pedido.php";
		$pedido = new Pedido();

		$rspta = $pedido->select_clientes();
		echo'<option value="0">Seleccione el código</option>';
		while($reg=$rspta->fetch_object())
		{
			echo'<option value='.$reg->id_cliente.'>'.$reg->codigo_interno.'</option>';
		}
	break;

	case "selectNombreCliente":
		require_once "../modelos/Pedido.php";
		$pedido = new Pedido();
		$code_customer=$_POST["codigo_cliente"];
		$rspta = $pedido->select_nombre_cliente($code_customer);
		while($reg=$rspta->fetch_object()){
			echo $reg->nombre;
		}
	break;
	case "selectDireccionCliente":
		require_once "../modelos/Pedido.php";
		$pedido = new Pedido();
		$code_customer=$_POST["codigo_cliente"];
		$rspta = $pedido->select_direccion_cliente($code_customer);
		while($reg=$rspta->fetch_object()){
			echo $reg->direccion;
		}
	break;


	
}
?>