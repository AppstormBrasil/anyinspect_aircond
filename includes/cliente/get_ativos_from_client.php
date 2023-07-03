<?php 
 
include('../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$id_cliente = $id;

$db = new db(); 

$db->query('SELECT tca.* , tcat.id as id_cat , tcat.description as categoria 
			FROM tb_clients_ativo tca
			LEFT JOIN tb_category tcat ON tca.category = tcat.id
			WHERE id_client = "'.$id_cliente.'"'); 
$db->execute();

$result = $db->resultset(); 
$modal_ativo = "";
$breed_comparar = "";
$raca = "";
$f = "";
$barco = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {


		$id = $row["id"];
		$id_cat = $row["id_cat"];
		$categoria = $row["categoria"];
		$id_client = $row["id_client"];
		$descricao = $row["descricao"];
		$foto = $row["foto"];
		
		if ($foto != ""){
		   $foto = 'images/upload/ativos/'.$foto;
		}else{
		   $foto = "assets/images/noimage.png" ;
		} 
		
		$categoria = $row["categoria"];
		$model = $row["model"];
		$register = $row["register"];
		$obs = $row["obs"];


		$db->query('SELECT * from tb_category '); 
		$db->execute();
		$barco = "";
		$result2 = $db->resultset(); 
		if($result2){
			foreach($result2 as $row2) {
				$id = $row2["id"];
				if($id == $categoria){
					$barco .= '<option selected id="'.$row2["description"].'" value="'.$id.'">'.$row2["description"].'</option>';
				} else {
					$barco .= '<option id="'.$row2["description"].'" value="'.$id.'">'.$row2["description"].'</option>';
				}
			}
		
		}
		

		$response['data'][] = array(
			"id"=>$row['id'],
			"id_client"=>$id_client,
			"id_cat"=>$id_cat,
			"categoria"=>$categoria,
			"descricao"=>$descricao,
			"foto"=>$foto,
			"categoria"=>$categoria,
			"model"=>$model,
			"register"=>$register,
			"obs"=>$obs,
			"botao"=>'<button data-toggle="modal" data-target="#ativo_'.$row["id"].'" class="btn btn-primary btn-xs" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></button>&nbsp<button class="btn btn-danger btn-xs" onclick="deletePet('.$row['id'].')" type="button"><i class="icon-trash f-s-16"></i></button>'
		);
		
		$modal_ativo .= '<div class="modal fade" id="ativo_'.$row["id"].'" tabindex="-1" role="dialog"  aria-labelledby="novo-barco" aria-hidden="true">
		
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" >Editar Barco</h5>
									
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
											aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form class="form-pet" action="javascript:update_pet_id('.$row['id'].');" method="post" style="width:100%;">
									<div class="col-lg-12">
										<div class="form-group">
											<label class="text-label">Nome</label>
											<div class="input-group">
												<input type="text" class="form-control" id="name_bolt_'.$row['id'].'" name="name_bolt_'.$row['id'].'" placeholder="Nome do Barco" value="'.$row['descricao'].'" required>
											   
											</div>
										</div>
									</div>
									
									<div class="col-lg-12">
										<div class="form-group">
											<label class="text-label">Categoria</label>
											<div class="input-group">
												<select id="category_bolt_'.$row['id'].'" name="category_bolt_'.$row['id'].'" style="width: 100%;height:45px;border: 1px solid #dddfe1;"  >
													'.$barco.'
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
												<label class="text-label">Modelo</label>
												<input type="text" class="form-control" id="model_bolt_'.$row['id'].'" name="model_bolt_'.$row['id'].'" placeholder="Modelo do Barco" value="'.$row['model'].'" >
											</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label class="text-label">Registro</label>
											<div class="input-group">
												<input type="text" class="form-control" id="register_bolt_'.$row['id'].'" name="register_bolt_'.$row['id'].'" placeholder="Registro do Barco" value="'.$row['register'].'" >
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="form-group">
											<label class="text-label">Nome</label>
											<div class="input-group">
												<input type="text" class="form-control" id="obs_bolt_'.$row['id'].'" name="obs_bolt_'.$row['id'].'" placeholder="Observação" value="'.$row['obs'].'">
											   
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success btn-xs">Salvar</button>
										<button type="button" class="btn btn-light btn-xs" data-dismiss="modal">Cancelar</button>
										
									</div>
									</form>
								</div>
							   
							</div>
						</div>
						</div>';
		
		$i = $i + 1;
	 } 
	 	$response['status'] = 'SUCCESS';
		$response['numero_pets'] = $i;
		$response['modal_ativo'] = $modal_ativo;
		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>