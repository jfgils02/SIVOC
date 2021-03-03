<!-- Modal REGISTRO DE ACCIONES CORRECTIVAS -->
<div class="modal fade" id="ModalRegisterCorrectiveAction" tabindex="-1" aria-labelledby="ModalRegisterCorrectiveAction" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Acción Correctiva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formRegisterCorrectiveAction">
              @csrf
                <div class="row">
                  <h4>Datos Acción Correctiva</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputIssiueCorrectiveAction">Problematica</label>
                        <textarea class="form-control" name="inputIssiueCorrectiveAction" id="inputIssiueCorrectiveAction" cols="7" rows="5"></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputActionCorrectiveAction">Acción Inmediata</label>
                        <textarea class="form-control" name="inputActionCorrectiveAction" id="inputActionCorrectiveAction" cols="7" rows="5"></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputNameAutor">Autor</label>
                          <input type="text" class="form-control" id="inputNameAutor" name="inputNameAutor" required value="{{ Auth::user()->name}} {{Auth::user()->last_name}} {{Auth::user()->mother_last_name }}" readonly>
                          <input type="hidden" name="inputIdAutor" id="inputIdAutor" value="{{ Auth::user()->id }}" >
                        </div>
                      </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="sltParticipantesInternos">Participantes internos</label>
                          <select class="form-control" name="sltParticipantesInternos[]" id="sltParticipantesInternos" multiple aria-label="multiple select example">
                            @isset($users)
                              @foreach ($users as $user)
                                  <option value="{{$user->id}}">{{$user->name}} {{$user->last_name}} {{$user->mother_last_name}}</option>
                              @endforeach
                            @endisset
                          </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputStatusCorrectiveAction">Estatus</label>
                          <input type="text" class="form-control" id="inputStatusCorrectiveAction" name="inputStatusCorrectiveAction" value="Abierta" required readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="fileCorrectiveAction" class="form-label">Documentos</label>
                        <input class="form-control" type="file" id="fileCorrectiveAction" name="fileCorrectiveAction" multiple>
                      </div>
                    </div>
                    
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveCorrectiveAction();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>

<!-- Modal MOSTRAR ARCHIVOS ACCIONES CORRECTIVAS -->
<div class="modal fade bd-example-modal-lg" id="ModalShowCorrectiveAction" tabindex="-1" aria-labelledby="ModalShowCorrectiveAction" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ARCHIVOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <table id="tableCorrectiveActionFiles" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      
                      <th>#</th>
                      <th>Archivo</th>
                      
                  </tr>
              </thead>
              <tbody id="bodyCorrectiveActionFiles">
                  
              </tbody>
              <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Archivo</th>
                  </tr>
              </tfoot>
            </table>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 <!-- Modal EDITAR ACCION CORRECTIVA-->
 <div class="modal fade" id="ModalEditCorrectiveAcition" tabindex="-1" aria-labelledby="ModalEditCorrectiveAcition" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Acción Correctiva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="formEditCorrectiveAction">
              @csrf
                <div class="row">
                  <h4>Datos Acción Correctiva</h4>
                </div>
                  
                <div class="row" style="background-color: #17a2b8">
                  
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputEditIssiueCorrectiveAction">Problematica</label>
                        <textarea class="form-control" name="inputEditIssiueCorrectiveAction" id="inputEditIssiueCorrectiveAction" cols="7" rows="5"></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputEditActionCorrectiveAction">Acción Inmediata</label>
                        <textarea class="form-control" name="inputEditActionCorrectiveAction" id="inputEditActionCorrectiveAction" cols="7" rows="5"></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputEditNameAutor">Autor</label>
                          <input type="text" class="form-control" id="inputEditNameAutor" name="inputEditNameAutor" required value="" readonly>
                          
                        </div>
                      </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="sltEditParticipantesInternos">Participantes internos</label>
                          <textarea class="form-control" name="sltEditParticipantesInternos" id="sltEditParticipantesInternos" cols="7" rows="5" readonly></textarea>
                          
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputEditStatusCorrectiveAction">Estatus</label>
                          <select class="form-control" name="inputEditStatusCorrectiveAction" id="inputEditStatusCorrectiveAction">

                          </select>
                        </div>
                    </div>
                    
                </div>

            </form>
          </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveEditCorrectiveAction();">Guardar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>
</div>