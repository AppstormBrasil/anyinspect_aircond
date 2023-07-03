<div class="modal fade" id="editar-doc" tabindex="-1" role="dialog"  aria-labelledby="editar-doc" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
			<h5 class="modal-title" >Editar Documentação </h5>
			
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-pet" action="javascript:updatedoc();" method="post" style="width:100%;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="text-label">Descrição<span style="color:red;">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="descricao_habilitacao_edit" name="descricao_habilitacao_edit" placeholder="" required>
                       
                    </div>
                </div>
            </div>
			<div style="float:left;" class="col-lg-6">
				<div class="form-group">
					<label class="text-label">Conteúdo</label>
					<div class="input-group">
						<div class="input-group">
                        <input type="text" class="form-control" id="conteudo_habilitacao_edit" name="conteudo_habilitacao_edit" placeholder="" >
						</div>
					</div>
				</div>
			</div>
            <div style="float:left;"  class="col-lg-6">
                <div class="form-group">
                    <label class="text-label">Data Expira </label>
					<div class="input-group">
						<input type="text" class="form-control" id="data_expira_habilitacao_edit" name="data_expira_habilitacao_edit" placeholder="" >
					</div>
                </div>
            </div>
           
			<input type="hidden" id="id_doc_edit" name="id_doc_edit" placeholder="" >	
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-xs">Cadastrar</button>
                <button type="button" class="btn btn-light btn-xs" data-dismiss="modal">Cancelar</button>
                
            </div>
            </form>
        </div>
       
    </div>
</div>
</div>