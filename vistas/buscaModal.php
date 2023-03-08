<!-- Modal -->
<div id="miModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Búsqueda Cliente</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h4 class="text-primary ">Datos Cliente</h4>
   
          <form action="">
            <div class="mb-3 form-group">
                <label for="genero" class="form-label">Código Cliente</label>
                <select name="cod_cliente" id="cod_cliente" class="form-control" required>
                    <option value="">Seleccionar...</option>
                </select>
            </div>
            <div class="mb-3 form-group">
                <label for="genero" class="form-label">Nombre Cliente</label>
                <select name="nom_cliente" id="nom_cliente" class="form-control" required>
                    <option value="">Seleccionar...</option>
                </select>
            </div>
            <div class="mb-3 form-group">
                <label for="genero" class="form-label">Código Interno</label>
                <select name="cod_interno" id="cod_interno" class="form-control" required>
                    <option value="">Seleccionar...</option>
                </select>
            </div>


              <!-- <div class="form-group col-md-12 col-sm-12">
                <label for="codigo">Código Cliente
                <input type="number" name="codigo" class="" placeholder="Codigo"></label>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label for="cliente">Nombre Cliente
                <input type="number" name="cliente" class="" placeholder="Codigo"></label>
              </div>
              <div class="form-group col-md-12 col-sm-12">
                <label for="codinterno">Codigo Interno
                <input type="number" name="codinterno" class="" placeholder="GT2000..."></label>
              </div> -->
          </form>
  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Seleccionar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  <!--fin Modal-->
  