<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['pedidos']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="sistema">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">PEDIDOS</h1>                     
                    </div>
                    
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body">
                          <div class="row">
                           
                               
                          
                        

                      
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-primary">
                                 <div class="panel-body">
                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-4">
                                    <h3>Detalle del pedido</h3>
                                    <div class="row">
                                      <div class="col-md-2 col-sm-12">
                                        <label for="cliente">Cliente</label>
                                        <select name="cliente" id="">
                                          <option value="uno">Seleccione</option>
                                          <option value="uno">Cliente Uno</option>
                                          <option value="uno">cliente Dos</option>
                                          
                                        </select>  
                                      </div>
                                      <div class="col-md-8">
                                        <label for="cliente">Codigo Cliente</label>
                                          <input type="text" value="12345678">
                                      </div>
                                    </div>
                                    <label>Línea <button type="button" class="btn btn-sm btn-success" onclick="agregarLinea()"><i class="fa fa-plus"></i></button></label>
                                    <table id="lineas" class="table table-responsive">
                                        <thead style="background-color: #A9D0F5;">
                                          <tr>
                                            <th>Borrar</th>
                                            <th>Cantidad</th>
                                            <th>Descripción</th>
                                            <th>Producto</th>
                                            
                                          </tr>
                                          <tbody id="tablabodyrecetas">
                                            <tr class="filasr" id="filar0">
                                              <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarLinea(1)"><i class="fa fa-trash"></i></button></td>
                                              <td><input type="text" class="control" name="cantidad[]" required=""></td>
                                              <td><input type="text" class="control" name="descripcion[]"></td>
                                              <td><input type="text" class="control" name="producto[]"></td>
                                              
                                            </tr>     
                                          </tbody>
                                        </thead>
                                      </table>
                                      <div class="form-group col-lg-4  col-md-4 col-sm-12 col-xs-12" id="guardar">
                                        <button class="btn btn-primary" type="submit" id="btnGuardarP"><i class="fa fa-save"></i> Guardar</button>
                                        <button class="btn btn-danger" id="btnCancelarP" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>                            
                                      </div>
                                  </div>   
                                 </div>
                               </div>
                          </div>
                          

                          
                        </div>
                    </div>                    
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/escritorio.js"></script>
<!--<script>setTimeout('document.location.reload()',10000); </script>-->
<?php 
}
ob_end_flush();
?>


