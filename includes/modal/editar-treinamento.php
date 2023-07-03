<div class="modal fade" id="editar-treinamento" tabindex="-1" role="dialog"  aria-labelledby="editar-treinamento" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
			<h5 class="modal-title" >Editar Treinamento </h5>
			
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-pet" action="javascript:updatequal();" method="post" style="width:100%;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="text-label">Descrição<span style="color:red;">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="desc_qual_edit" name="desc_qual_edit" placeholder="" required>
                       
                    </div>
                </div>
            </div>
			<div style="float:left;" class="col-lg-6">
				<div class="form-group">
					<label class="text-label">Tipo</label>
					<div class="input-group">
						<div class="input-group">
                        <input type="text" class="form-control" id="tipo_qual_edit" name="tipo_qual_edit" placeholder="" >
						</div>
					</div>
				</div>
			</div>
            <div style="float:left;"  class="col-lg-6">
                <div class="form-group">
                    <label class="text-label">Numero </label>
					<div class="input-group">
						<input type="text" class="form-control" id="numero_qual_edit" name="numero_qual_edit" placeholder="" >
					</div>
                </div>
            </div>
            <div style="float:left;" class="col-lg-6">
                <div class="form-group">
					<label class="text-label">Validade </label>
					<div class="input-group">
						<input type="text" class="datetimepicker_inicio  form-control" id="validade_qual_edit" name="validade_qual_edit" placeholder="" >	
					</div>
				</div>
            </div>
            <div style="float:left;" class="col-lg-6">
                <div class="form-group">
					<label class="text-label">Carga Horária </label>
					<div class="input-group">
						<input type="text" class="form-control" id="horaria_qual_edit" name="horaria_qual_edit" placeholder="" >	
					</div>
				</div>
            </div>
            <div style="float:left;" class="col-lg-12">
                <div class="form-group">
					<label class="text-label">Local </label>
					<div class="input-group">
						<input type="text" class="form-control" id="local_qual_edit" name="local_qual_edit" placeholder="" >	
					</div>
				</div>
            </div>
            <div style="float:left;" class="col-lg-6">
                <div class="form-group">
					<label class="text-label">Data Inicial </label>
					<div class="input-group">
						<input type="text" class="datetimepicker_inicio  form-control data" id="dataini_qual_edit" name="dataini_qual_edit" placeholder="" >	
					</div>
				</div>
            </div>
            <div style="float:left;" class="col-lg-6">
                <div class="form-group">
					<label class="text-label">Data Final </label>
					<div class="input-group">
						<input type="text" class="datetimepicker_inicio  form-control data" id="datafim_qual_edit" name="datafim_qual_edit" placeholder="" >	
					</div>
				</div>
            </div>
			<input type="hidden" id="id_qual_edit" name="id_qual_edit" placeholder="" >	
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-xs">Cadastrar</button>
                <button type="button" class="btn btn-light btn-xs" data-dismiss="modal">Cancelar</button>
                
            </div>
            </form>
        </div>
       
    </div>
</div>
</div>