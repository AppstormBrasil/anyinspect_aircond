<div class="modal fade" id="edit-pet" tabindex="-1" role="dialog"  aria-labelledby="edit-pet" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
			<h5 class="modal-title" >Editar Pet </h5>
			
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form class="form-pet" action="javascript:update_pet();" method="post" style="width:100%;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="text-label">Nome</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nome_pet_edit" name="nome_pet_edit" placeholder="" required>
                       
                    </div>
                </div>
            </div>
			<div class="col-lg-12">
				<div class="form-group">
						<label class="text-label">Espécie</label>
						<select id="especie_edit" name="especie_edit" class="form-control">
							<option value="Ave">Ave</option>
							<option value="Cão">Cão</option>
							<option value="Gato">Gato</option>
							<option value="Réptil">Réptil</option>
							<option value="Peixe">Peixe</option>
							<option value="Roedor">Roedor</option>
							<option value="Outro">Outro</option>
						</select>
					</div>
			</div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="text-label">Gênero</label>
                    <div class="input-group">
                        <div class="col-sm-8">
							<div class="demo-checkbox">
								<div>
									<input value="femea" name="genero" type="radio" class="filled-in chk-col-primary" id="md_checkbox_25">
									<label for="md_checkbox_25">Fêmea</label>
								</div>
								<div>
									<input value="macho" name="genero" type="radio" checked=""  class="filled-in chk-col-primary" id="md_checkbox_26">
									<label for="md_checkbox_26">Macho</label>
								</div>
								
							</div>
						</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="text-label">Raça</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="raca_edit" name="raca_edit" >
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="text-label">Característica</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="caracteristica_edit" name="caracteristica_edit" >
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="text-label">Identificação</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="identificacao_edit" name="identificacao_edit" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submitt" class="btn btn-success">Salvar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
            <input id="pet_id_edit" val="" type="hidden" />
            </form>
        </div>
       
    </div>
</div>
</div>