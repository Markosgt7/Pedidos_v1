function init(){
	
}
contr=1;
	function agregarLinea()
	{
		  var fila='<tr class="filasr" id="filar'+contr+'">'+
		  '<td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarLinea('+contr+')"><i class="fa fa-trash"></i></button></td>'+
		  '<td><input type="text" class="control" name="medicamento[]" required=""></td>'+
		  '<td><input type="text" class="control" name="presentacion[]"></td>'+
		  '<td><input type="text" class="control" name="dosis[]"></td>'+    	
		  '</tr>';
		  contr++;
		  $('#lineas').append(fila);
	}
	function evaluar(){
		if (detalles>0)
	  {
		$("#btnGuardarP").show();
	  }
	  else
	  {
		$("#btnGuardarP").show(); 
		cont=0;
	  }
	}
  
	function eliminarDetalle(indice){
		$("#fila" + indice).remove();
		detalles=detalles-1;
		evaluar();
	}

	function eliminarLinea(indice){
		$("#filar" + indice).remove();
   }



init();