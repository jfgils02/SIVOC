 <!-- Modal -->
 <div class="modal fade" id="ModalRegisterRule" tabindex="-1" aria-labelledby="ModalRegisterRule" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Normas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formRegisterRule">
              @csrf
                <div class="row">
                  <h4>Datos de Normas</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputClaveRule">Clave</label>
                      <input type="text" class="form-control" id="inputClaveRule" name="inputClaveRule" placeholder="Clave" required>
                    </div>
                  </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputNameRule">Nombre</label>
                        <input type="text" class="form-control" id="inputNameRule" name="inputNameRule" placeholder="Nombre" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputUrlRule">URL</label>
                        <input type="text" class="form-control" id="inputUrlRule" name="inputUrlRule" placeholder="Codigo" required>
                      </div>
                    </div>

                </div>
               

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveRule();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="ModalEditRule" tabindex="-1" aria-labelledby="ModalEditRule" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Editar Norma</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <input type="hidden" name="hidRule" id="hidRule">
      <div class="modal-body">
        <div class="container-fluid">
          <form id="formEditRule">
            @csrf
              <div class="row">
                <h4>Datos de Normas</h4>
              </div>
                
              <div class="row" style="background-color: #17a2b8">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputEditClaveRule">Clave</label>
                    <input type="text" class="form-control" id="inputEditClaveRule" name="inputEditClaveRule" required>
                  </div>
                </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputEditNameRule">Nombre</label>
                      <input type="text" class="form-control" id="inputEditNameRule" name="inputEditNameRule" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="inputEditUrlRule">URL</label>
                      <input type="text" class="form-control" id="inputEditUrlRule" name="inputEditUrlRule" required>
                    </div>
                  </div>

              </div>
             

          </form>
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="updateRule();">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
  </div>
  </div>
</div>