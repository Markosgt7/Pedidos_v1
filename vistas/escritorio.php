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
                          <!--nuevo codigo marcos--> 
                          <div class="panel panel-primary">
                              <div class="panel-body">
                                <!--encabezado pedido-->
                               
                                  <div class="form-group row">
                                        <div class="col-xs-12 col-sm-4 col-lg-6">
                                          <label for="cliente">Código</label>
                                           <select name="codigo_cliente" id="codigo_cliente" class="form-control">
                                              <option value="0">Seleccione</option>
                                           </select>                                         
                                            <span>
                                              <button type="button" class="btn btn-sm" onClick="mostrarModal()"><i class="fa fa-search"></i></button>
                                          </span>
                                        </div>                                       
                                 
                                        <div class="col-xs-12 col-sm-8 col-lg-6">
                                            <label for="nombreCliente">Cliente</label> 
                                              <input type="text" name="nombre_cliente" id="nombre_cliente" placeholder="Cliente" class="form-control">                                                                                    
                                        </div>
                                  </div>
                                





                                  <div class="form-group row">                                  
                                    <div class="col-xs-12">                                        
                                          <label for="direccion">Dirección</label>
                                          <input type="text" name="Cliente" class="form-control" placeholder="Dirección">                                            
                                    </div>
                                  </div>
                                
                                <!--fin pedido-->
                                <!--boton agregar linea-->
                                <div class="col-md-5 col-sm-12" >
                                  <label for="">Nueva Línea </label>
                                  <span>
                                  
                                    <button class="btn btn-xs btn-success" onclick="agregarLinea()">
                                      <i class="fa fa-plus"></i>
                                    </button>
                                  </span>
                                </div>
                                <div class="col-md-7 col-sm-12">
                                  <label for="total">Cantidad</label>
                                  <input type="text"  value="0" name="order_quantity" id="order_quantity" readonly>
                                </div>
                               
                                <!--inicio de tabla-->

                                  <table class="table table-striped table-sm" id="lineas" >
                                    <thead>
                                      <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Familia</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Borrar</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="filasr" id="filar">
                                        <td scope="row" id="numRow">1</td>
                                        <td>
                                            <div class="mb-3 form-group">                                           
                                                <select name="familias[]" id="familias" class="form-control">                                                  
                                                </select>     
                                            </div>                                                    
                                        </td>
                                        <td>
                                            <div class="mb-3 form-group">
                                              <select name="productos[]" id="productos" class="form-control">                                                  
                                              </select>                                     
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mb-3 form-group">
                                              <input type="number" class="form-control" name="cantidad[]" id="cantidad" placeholder="cantidad"  required>                                                                                        
                                            </div>
                                        </td>
                                        <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarLinea(1)"><i class="fa fa-trash"></i></button></td>
                                      </tr>                                  
                                    </tbody>
                                  </table>

                                <!--observaciones-->
                                <div class="form-group row">                                  
                                  <div class="col-xs-12 col-md-12 col-lg-12">                                        
                                    <label for="direccion">Observaciones</label>
                                    <input type="text" name="Observaciones" class="form-control" placeholder="Observaciones">                                            
                                  </div>
                                </div>                             
                                
                                
                                <div class="form-group justify-content-end">
                                  <div class="col-auto">
                                    <button type="button" class="btn btn-primary btn-sm">Enviar</button>
                                    <button type="button" class="btn btn-danger btn-sm">Cancelar</button>
                                  </div>
                                </div>
                                  
                                  
                                
                              </div>
                            </div>
                          <!--fin codigo marcos--> 
                            
                          
                        

                     

                          
                        </div>
                    </div>                    
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
    <?php include '../vistas/buscaModal.php';?>


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


