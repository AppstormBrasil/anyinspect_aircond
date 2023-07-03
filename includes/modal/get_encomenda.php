<div class="modal fade" id="get-encomenda"  role="dialog"  aria-labelledby="get-encomenda" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
			<h5 class="modal-title" >Retirada de Encomenda </h5>
			
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>
           
        </div>
        <a style="color:#fff;" class="btn btn-dark pl-5 pr-5 mb-4" id="qr_ref" ></a>
        <div class="modal-body">
            <form class="form-pet" action="javascript:send_saida_encomenda();" method="post" style="width:100%;">
            <div class="col-lg-12">
            <div class="card" id="card_registro_encomenda"> </div>
            </div>
			
           
           
            <!--<div class="col-lg-12">
                <div class="form-group">
                    <label class="text-label">Responsável</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="responsavel" name="responsavel" >
                    </div>
                </div>
            </div>-->
            <input type="hidden" class="form-control" id="IdPost" name="IdPost" >
            <input type="hidden" class="form-control" id="IdResidencia" name="IdResidencia" >
            <div class="modal-footer">
                <button style="width: 100%;" type="submitt" class="btn btn-success">Registrar Retirada</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                
            </div>
            </form>
        </div>
       
    </div>
</div>
</div>