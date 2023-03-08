$(document).ready(function(){
	cargarProductos();
		
	$.post("../ajax/escritorio.php?op=selectFamilias", function(r){
		$("#familias").html(r);
		$('#familias').selectpicker('refresh');	
	});
	
	$("#familias").change(function(){
		cargarProductos();
		
	})


})

/* function init(){	
	
}
 */
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

		'<td> <div class="form-group col-md-12 col-sm-3">'+
		'<input type="number" class="form-control" id="inputCant" name="cant[]" placeholder="0"> </div> </td>'+

		'<td> <div class="form-group col-md-12 col-sm-3">'+
		'<input type="text" class="form-control" id="inputDesc" name="produc[]" placeholder="Producto"></div></td>'+

		'<td> <div class="form-group col-md-12 col-sm-3">'+
		'<input type="text" class="form-control" id="inputPres" name="presen[]" placeholder="Presentacion"></div></td>'+

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