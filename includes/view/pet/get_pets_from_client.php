<?php 
 
include('../../common/util.php'); 
$created_at = date('Y-m-d  H:i:s'); 

if(isset($_GET['id'])){ $id = $_GET['id'];} else { $id  = '';}
$id_cliente = $id;

$db = new db(); 

$db->query('SELECT * from pet_clients_pet where id_client = "'.$id_cliente.'"'); 
$db->execute();

$result = $db->resultset(); 
$modal_pet = "";
if($result){
	 $i = 0; 
	 foreach($result as $row) {
		$id_pet = $row["id"];
		$name = $row["name"];
		
		$breed = $row["breed"];
		$db->query('SELECT * from pet_breeds where id = "'.$breed.'"'); 
		$db->execute();

		$result2 = $db->resultset(); 
		if($result2){
			foreach($result2 as $row2) {
				$id_breed = $row2["id"];
				$breed = $row2["description"];
				$breed_comparar = $row2["description"];
			}
		}
		$raca = "";
		$raca .= '<option selected value="'.$id_breed.'">'.$breed.'</option>';
		
		$db->query('SELECT * from pet_breeds'); 
		$db->execute();
		$result_breeds = $db->resultset();
		if($result_breeds){
			foreach($result_breeds as $row_breed) {
				$id_breed_modal = $row_breed["id"];
				$breed_modal = $row_breed["description"];
				
				if($breed_comparar == $breed_modal){
					
				}
				else{
					$raca .= '<option value="'.$id_breed_modal.'">'.$breed_modal.'</option>';
				}
			}
		}
			
		
		$mood = $row["mood"];
		if($mood == "c"){
			$mood = "Calmo";
			$selected_mood_c = "selected";
			$selected_mood_a = "";
		}else if($mood == "a"){
			$mood = "Agressivo";
			$selected_mood_c = "";
			$selected_mood_a = "selected";
		}
		else{
			$mood = "";
			$selected_mood_c = "";
			$selected_mood_a = "";
		}

		
		$size = $row["size"];
		
		$hair = $row["hair"];
		
		if($hair == "c"){
			$hair = "Curto";
			$selected_hair_c = "selected";
			$selected_hair_m = "";
			$selected_hair_l = "";
		}else if($hair == "m"){
			$hair = "Médio";
			$selected_hair_c = "";
			$selected_hair_m = "selected";
			$selected_hair_l = "";
		}
		else if($hair == "l"){
			$hair = "Longo";
			$selected_hair_c = "";
			$selected_hair_m = "";
			$selected_hair_l = "selected";
		}
		else{
			$hair = "";
			$selected_hair_c = "";
			$selected_hair_m = "";
			$selected_hair_l = "";
		}
		
		$dt_nasc = $row["dt_nasc"];
		
		$obs = $row["obs"];
		
		$gender = $row["gender"];
		if($gender == "m"){
			$gender = "Macho";
		}else{
			$gender = "Fêmea";
		}
		
		if ( $row['gender'] == "m") {
			$m = 'selected'; 
			$f = '';
		}
		else if ( $row['gender'] == "f") {
			$f = 'selected'; 
			$m = '';
		}
		
		if($size == "p"){
			$size = "Pequeno";
			$p = "selected";
			$m = "";
			$g = "";
		}else if($size == "m"){
			$size = "Médio";
			$p = "";
			$m = "selected";
			$g = "";
		}else{
			$size = "Grande";
			$p = "";
			$m = "";
			$g = "selected";
		}
		
		$data_nascimento = usa_to_br($row['dt_nasc']);
		
		$response['data'][] = array(
			"id_pet"=>$row['id'],
			"name"=>$row['name'],
			"breed"=>$breed,
			"gender"=>$gender,
			"mood"=>$mood,
			"size"=>$size,
			"hair"=>$hair,
			"obs"=>$obs,
			"dt_nasc"=>$data_nascimento,
			"botao"=>'<button data-toggle="modal" data-target="#pet_'.$row["id"].'" class="btn btn-primary btn-xs" id="'.$row['id'].'" type="button"><i class="icon-pencil f-s-16"></i></button>&nbsp<button class="btn btn-danger btn-xs" onclick="deletePet('.$row['id'].')" type="button"><i class="icon-trash f-s-16"></i></button>'
		);
		
		$modal_pet .= '<div class="modal fade" id="pet_'.$row["id"].'" tabindex="-1" role="dialog"  aria-labelledby="novo-pet" aria-hidden="true">
		
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" >Editar Pet</h5>
									
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
												<input type="text" class="form-control" id="nome_pet_'.$row['id'].'" name="nome_pet_'.$row['id'].'" placeholder="Nome do Pet" value="'.$row['name'].'" required>
											   
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
												<label class="text-label">Gênero</label>
												<select id="sexo_pet_'.$row['id'].'" name="sexo_pet_'.$row['id'].'" class="form-control">
													<option value="m" '.$m.'>Macho</option>
													<option value="f" '.$f.'>Fêmea</option>
												</select>
											</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label class="text-label">Raça</label>
											<div class="input-group">
												<select id="raca_pet_'.$row['id'].'" name="raca_pet_'.$row['id'].'" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required >
													'.$raca.'
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
												<label class="text-label">Porte</label>
												<select id="porte_pet_'.$row['id'].'" name="porte_pet_'.$row['id'].'" class="form-control">
													<option value="p" '.$p.'>Pequeno</option>
													<option value="m" '.$m.'>Médio</option>
													<option value="g" '.$g.'>Grande</option>
												</select>
											</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label class="text-label">Comprimento do Corte</label>
											<div class="input-group">
												<select id="hair_pet_'.$row['id'].'" name="hair_pet_'.$row['id'].'" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required >
													<option value="c" '.$selected_hair_c.'>Curto</option>
													<option value="m" '.$selected_hair_m.'>Médio</option>
													<option value="l" '.$selected_hair_l.'>Longo</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
												<label class="text-label">Comportamento</label>
												<select id="mood_pet_'.$row['id'].'" name="mood_pet_'.$row['id'].'" class="form-control">
													<option value="c" '.$selected_mood_c.'>Calmo</option>
													<option value="a" '.$selected_mood_a.'>Agressivo</option>
												</select>
											</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label class="text-label">Data de Nascimento</label>
											<div class="input-group">
												<input type="text" class="data form-control" id="dt_nasc_pet_'.$row['id'].'" name="dt_nasc_pet_'.$row['id'].'" value="'.trim($data_nascimento).'">
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label class="text-label">Nome</label>
											<div class="input-group">
												<input type="text" class="form-control" id="obs_pet_'.$row['id'].'" name="obs_pet_'.$row['id'].'" placeholder="Observação" value="'.$row['obs'].'">
											   
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success">Salvar</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										
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
		$response['modal_pet'] = $modal_pet;
		echo json_encode($response);
	 	exit(0);
} else { 
 	 	 $arr['status'] = 'ERROR'; 
	 	 $arr['status_txt'] = 'Nenhuma informacao disponivel'; 
	 	 echo json_encode($arr);
	 	 } 

 ?>