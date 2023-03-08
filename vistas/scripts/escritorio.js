$(document).ready(function(){
	cargarProductos();
	
	
		
	$.post("../ajax/escritorio.php?op=selectFamilias", function(r){
		$("#familias").html(r);
		$('#familias').selectpicker('refresh');	
	});
	
	$("#familias").change(function(){
		cargarProductos();
		
	})

	$("#cantidad").change(function(){
		sumaProductos();
	})


})

/* function init(){	
	
}
 */

function sumaProductos(){	
	suma_productos = 0;
	suma_productos =parseFloat( suma_productos) +parseFloat( $("#cantidad").val())
	//console.log(suma_productos)
	$("#order_quantity").val(suma_productos)

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
		'<select name="familias" id="familias" class="form-control"></select></div></td>'+
		'<td> <div class="mb-3 form-group">'+
		'<select name="productos" id="productos" class="form-control"></select></div></td>'+
		'<td> <div class="mb-3 form-group">'+
		'<input type="number" class="form-control" id="cantidad" name="cantidad"></div></td>'+
		'<td> '+
		'<button type="button" class="btn btn-sm btn-danger"  onClick="eliminarLinea('+contr+')"><i class="fa fa-trash"></i></button></td>'+
		'</tr> ';
		contr++;
		$('#lineas').append(fila);
	}
	
	/* function evaluar(){
		if (detalles>0)
	  {
		$("#btnGuardarP").show();
	  }
	  else
	  {
		$("#btnGuardarP").show(); 
		cont=0;
	  }
	} */
  
	function eliminarDetalle(indice){
		$("#fila" + indice).remove();
		detalles=detalles-1;
		evaluar();
	}

	function eliminarLinea(indice){
		$("#filar" + indice).remove();
   }



//init();