$(document).ready(function(){
	//llamado a funciones iniciales
	cargarProductos();
	cargarFamilias();
	cargarCliente();
	
	
	//metodos para hacer dinamicos los datos
	$("#familias").change(function(){
		cargarProductos();		
	})
	$("#cantidad").change(function(){
		sumaProductos();
	})
	$("#codigo_cliente").change(function(){
		 cargarNombreCliente();		 	
	})


})

function cargarCliente(){
	$.post("../../ajax/escritorio.php?op=selectClientes",function(r){

		$("#codigo_cliente").html("<option value=''>Seleccione</option>")
		$("#codigo_cliente").html(r)
		
	})
}

function cargarNombreCliente(){
	$.ajax({
		type:"POST",
		url:"../../ajax/escritorio.php?op=selectNombreCliente",
		data:"codigo_cliente="+$("#codigo_cliente").val(),
		success:function(r){
			$("#nombre_cliente").val(r);
			

		}
	})
	$.ajax({
		type:"POST",
		url:"../../ajax/escritorio.php?op=selectDireccionCliente",
		data:"codigo_cliente="+$("#codigo_cliente").val(),
		success:function(r){
			$("#direccion_cliente").val(r);
		}
	})

}

function sumaProductos(){	
	suma_productos = 0;
	suma_productos =parseFloat(suma_productos) +parseFloat($("#cantidad").val())
	//console.log(suma_productos)
	$("#order_quantity").val(suma_productos)

}

function cargarFamilias(){		
	$.post("../ajax/escritorio.php?op=selectFamilias", function(r){
		$("#familias").html(r);
		//$('#familias').selectpicker('refresh');	
	});
}
function cargarProductos(){
		$.ajax({
			type:"POST",
			url:"../ajax/escritorio.php?op=selectProductos",
			data: "id_producto="+$("#familias").val(),
			success:function(r){
				$("#productos").html(r);
				$('#productos').selectpicker('refresh');
			}
		})
}

function mostrarModal(){
  $("#miModal").modal("show");
}
contr=2;
	function agregarLinea(){
		var fila='<tr class="filasr" id="filar'+contr+'">'+
		'<td scope="row" id="numRow">'+contr+'</td>'+
		'<td> <div class="mb-3 form-group">'+
		'<select name="familias[]" id="familias" class="form-control"></select></div></td>'+
		'<td> <div class="mb-3 form-group">'+
		'<select name="productos[]" id="productos" class="form-control"></select></div></td>'+
		'<td> <div class="mb-3 form-group">'+
		'<input type="number" class="form-control" id="cantidad" name="cantidad[]"></div></td>'+
		'<td> '+
		'<button type="button" class="btn btn-sm btn-danger"  onClick="eliminarLinea('+contr+')"><i class="fa fa-trash"></i></button></td>'+
		'</tr> ';
		contr++;
		$('#lineas').append(fila);
		
				
	}
	

	function eliminarLinea(indice){
		$("#filar" + indice).remove();
   }



