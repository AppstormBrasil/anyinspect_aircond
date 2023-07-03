<div class="modal fade" id="novo-ativo" tabindex="-1" role="dialog"  aria-labelledby="novo-ativo" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
			<h5 class="modal-title" >Cadastro de Ativo </h5>
			
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-pet" action="javascript:cadastraAtivo();" method="post" style="width:100%;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="text-label">Descrição <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="descricao_ativo" name="descricao_ativo" placeholder="" required>
                       
                    </div>
                </div>
            </div>
			<div class="col-lg-12">
				<div class="form-group">
					<label class="text-label">Categoria </label>
					<div class="input-group">
						<div class="input-group">
						<select style="width: 100%;height:45px;border: 1px solid #dddfe1;" id="category_ativo" name="category_ativo" ></select>
						</div>
					</div>
				</div>
			</div>
            
			
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                
            </div>
            </form>
        </div>
       
    </div>
</div>
</div>