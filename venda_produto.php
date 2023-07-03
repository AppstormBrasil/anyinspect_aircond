<?php include('includes/common/check_permission.php'); ?>
 <?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?> 
<style>
    .select2-container .select2-selection--single {height:45px!important}
    .select2-container--default .select2-selection--single .select2-selection__rendered {line-height:35px!important}
    .select2-container--default .select2-selection--single .select2-selection__arrow b {margin-top: 4px!important}
    .select2-container--default .select2-results__option--highlighted[aria-selected] {background-color: #ddd!important;color: #020202!important;height: 42px!important;line-height: 34px!important;}
</style>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
								<div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a id="pic_btn" href="#foto" data-toggle="tab" class="nav-link active show">Foto</a></li>
                                            <li class="nav-item"><a id="web_btn" href="#webcam" data-toggle="tab" class="nav-link">Webcam</a></li>
	                                    </ul>
                                        <div class="tab-content" style="margin-top: 40px;">
											<div id="foto" class="tab-pane fade active show">
												<div class="profile-interest profile-blog pt-3 border-bottom-1 pb-1 profile-interest">
													<div class="row">
                                                        <div class="col-12">
																<a style="cursor:pointer;" id="carregar_imagem" class="interest-cats">
																	<img style="width:100%;" id="image_produto"  src="images/noimage.jpg" alt="" class="img-fluid">
																</a>
																<input type="file" style="display:none;" id="ufile" name="ufile">
																<?php $id = $_GET['id']; ?>
																<input type="hidden" id="id_clientt" name="id_clientt" value="<?php echo $id ?>" />
                                                                    
                                                                <span id="status_img"></span>
                                                                <div class="progress-bar progress bg-success wow animated progress-animated" style="width:0%;height:2px;" role="progressbar"> 
                                                                    <span class="sr-only"></span> 
                                                                </div>
                                                            </div>
													    </div>
                                                        <div id="lista_moradores_left" class="profile-news mt-4 pb-3">
                    
                                                        </div>
												</div>
											</div>
											<div id="webcam" class="tab-pane fade">
												<form method="POST" >
													<div class="row">
														<div class="col-md-12" style="">
															<div id="my_camera"></div>
														</div>
														
														<div class="col-md-12 text-center" style=" padding-top:20px;">
															<input type="hidden" name="image" class="image-tag">
															<?php $id = $_GET['id']; ?>
															<input type="hidden" name="id_prod" id="id_prod" value="<?php echo $id ?>">
															<button class="btn btn-primary" type="button" id="take_snapshot">Tirar Foto</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-9">
                        <div class="card forms-card">
                            <div class="card-body">
								<h4 class="card-title">Informações do produto</h4><br>
                                <div class="basic-form">
									<form id="form-cliente" action="javascript:editarServico();" method="post" style="width:100%;">

										<div class="row">
                                            <div class="col-lg-5">
                                                <div class="form-group">
													<label class="text-label">Titulo: </label>
													<div class="input-group">
														<input type="text" name="titulo" id="titulo" class="form-control" placeholder="titulo" required >
                                                    </div>
												</div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <label class="text-label">Categoria: </label>
                                                    <div class="input-group">
                                                        <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoria" required >
                                                    </div>
                                                </div>
                                            </div>
											<div class="col-lg-4">
                                                <div class="form-group">
													<label class="text-label">Valor: </label>
													<div class="input-group">
														<input type="text" name="valor" id="valor" class="form-control money" placeholder="Valor" required >
                                                    </div>
												</div>
                                            </div>
											<div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="text-label">Tipo</label>
													<div class="input-group">
														<select id="tipo" name="tipo" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required >
															<option disabled selected value="none"></option>
															<option value="L">L - Litro</option>
                                                            <option value="MG">MG - Miligrama</option>
															<option value="ML">ML - Mililitro</option>
															<option value="KG">KG - Quilograma</option>
															<option value="UN">UN - Unidade</option>
															<option value="PC">PC - Peça</option>
														</select>
													</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
													<label class="text-label">Quantidade: </label>
													<div class="input-group">
														<input type="text" name="qtd" id="qtd" class="form-control" placeholder="Quantidade" required >
                                                    </div>
												</div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="text-label">Descrição: </label>
                                                    <div class="input-group">
                                                        <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Descrição" required >
                                                    </div>
                                                </div>
                                            </div>

											<div class="col-lg-12">
												<button type="button" onclick="editarProduto()" class="btn btn-primary">Salvar Produto</button>  
											</div>
                                            <?php $id = $_GET['id']; ?>
                                            <input type="hidden" name="id_page" id="id_page" value="<?php echo $id ?>">
										</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    
  
                    <div class="card  m-b-0">
                    	
                            <div class="card-header">
                                <h4 class="card-title">Variações do Produto</h4>
                            </div>

                            <div class="card-body p-0">

                            
                            	<div class="col-lg-3">
                            		<div class="form-group">
                                        <label class="text-label">Nome: </label>
                                        <div class="input-group">
                                            <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" required >
                                        </div>
                                    </div>
                            	</div>
								
								<div class="col-lg-6">
									<div class="form-group">
										<label class="text-label">Tipo: </label>
										<div class="input-group">
										<select style="width: 100%;height:20px;border: 1px solid #dddfe1;cursor:pointer;" id="tipo_prod" name="tipo_prod" >
											<option disabled selected value="none"></option>
											<option value="cor">COR</option>
                                            <option value="tamanho">TAMANHO</option>
										</select>
										</div>
									</div>
								</div>

								<div class="col-lg-3">
                            		<div class="form-group">
                                        <label class="text-label">Preço: </label>
                                        <div class="input-group">
                                            <input type="text" name="preco_prod" id="preco_prod" class="form-control" placeholder="Preço" required >
                                        </div>
                                    </div>
                            	</div>

                            	<div class="col-lg-3">
                            		<div class="form-group">
                                        <label class="text-label">Quantidade: </label>
                                        <div class="input-group">
                                            <input type="text" name="quantidade" id="quantidade" class="form-control" placeholder="Quantidade" required >
                                        </div>
                                    </div>
                            	</div>


							

								<div class="col-lg-12">
									<br>
									<button type="button" onclick="salvarVarianteProd()" class="btn btn-primary">Salvar Variante</button>  
								</div>

							</div>
								
                                <div class="table-responsive">
                                    <table class="table table-padded table-responsive-fix-big property-overview-table">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Tipo</th>
                                                <th>Preço</th>
                                                <th>Quantidade</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_variantes">
                                        </tbody>
                                    </table>
                                </div>

							</div>
						</div>
                    </div>      
                </div>
            </div>

	<script src="js/webcam.min.js"></script>
	<script>
	$('#tempo_estimado').mask('00:00');

	$('#valor').mask('000.000.000.000.000,00', {reverse: true});
	$('#preco_prod').mask('000.000.000.000.000,00', {reverse: true});

	$('#tipo').select2();
	$('#tipo_prod').select2();

	

	function get_service_single() {

		id = $("#id_page").val();
		$.ajax({
			url:  "includes/loja/get-prod-venda-single.php",
			type : 'GET',
			dataType: 'JSON',
			data:{
				id:id
			},
			success: function(response){
				var json = response.data;
				status = response.status;
				if(status  == 'SUCCESS') {

					id = json.id;
					titulo = json.titulo;
					categoria = json.categoria;
					valor = json.valor;
					qtd = json.qtd;
					descricao = json.descricao;
					tipo = json.tipo;
                    foto = json.foto;
                   

					setTimeout(function(){
						$('#titulo').val(titulo);
						$('#valor').val(valor);
						$('#categoria').val(categoria);
						$('#qtd').val(qtd);
						$('#descricao').val(descricao);
						$('#tipo').val(tipo);
                        $("#image_produto").attr('src', json.foto +'?' + (new Date()).getTime());
					}, 200);
				
				} else {
					//window.location.href = '404';
				}
				}
			});
	}

	get_service_single();

		function editarProduto(){
		var id = $("#id_page").val();
		var titulo = $('#titulo').val();
		var valor =  $('#valor').val();
		var categoria = $('#categoria').val();
		var qtd = $('#qtd').val();
		var descricao = $('#descricao').val();
		var tipo = $('#tipo').val();

		valor = valor.replace(",", ".");
		valor = parseFloat(valor).toFixed(2);


		if(titulo == ""){
			toastr.error(status_txt, 'Preencha o campo Titulo!');
			return false;
		}
		if(valor == ""){
			alert("Preencha o campo Valor!");
			return false;
		}
		if(categoria == ""){
			alert("Preencha o campo Categoria!");
			return false;
		}
		if(qtd == ""){
			toastr.error(status_txt, 'Preencha o campo Quantidade Usos!');
			return false;
		}
		if(descricao == ""){
			alert("Preencha o campo Descricao!");
			return false;
		}
		if(tipo == ""){
			alert("Preencha o campo Tipo!");
			return false;
		}


		$.ajax({
			url: "includes/loja/update_prd_loja.php", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
				id  : id,
                titulo : titulo,
				valor : valor,
				categoria : categoria,
				qtd : qtd,
				descricao : descricao,
				tipo : tipo
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					if(status == 'SUCCESS') {
						setTimeout(function(){
							toastr.success('Sucesso!', status_txt)
						}, 100); 
					} else {
						toastr.error('Erro!', status_txt)
					} 
				},
				error:function(response){
					toastr.error('Erro!', 'Erro ao Salvar');
				} 
		});
	}



		function salvarVarianteProd(){

		var id_prod = $("#id_page").val();
		var nome = $("#nome").val();
		var tipo_prod = $("#tipo_prod").val();
		var preco_prod = $("#preco_prod").val();
		var quantidade = $("#quantidade").val();

		preco_prod = preco_prod.replace(",", ".");
		preco_prod = parseFloat(preco_prod).toFixed(2);
		
		if(nome == null){
			toastr.error('Erro!', 'Escolha o Produto');
			return;
		}
		if(tipo_prod == null){
			toastr.error('Erro!', 'Escolha o Produto');
			return;
		}
		if(preco_prod == null){
			toastr.error('Erro!', 'Escolha o Produto');
			return;
		}
		if(quantidade == null){
			toastr.error('Erro!', 'Escolha o Produto');
			return;
		}


		$.ajax({
			url: "includes/loja/cadastrar_variante.php", 
			type : 'POST', 
			dataType: 'JSON',
			data: {
				id_prod : id_prod,
                nome : nome,
                tipo_prod : tipo_prod,
                preco_prod : preco_prod,
                quantidade : quantidade
			},
				success: function(response){
					status = response.status; 
					status_txt = response.status_txt;
					if(status == 'SUCCESS') {
						toastr.success('Sucesso!', status_txt);
						setTimeout(function(){
							location.reload();
						}, 300); 
					} else {
						toastr.error('Erro!', status_txt)
					} 
				},
				error:function(response){
					console.log(response);
				} 
		});
	}


	function get_variante(){
	var id_prod = $("#id_page").val();
	$.ajax({
     url:"includes/loja/get-list-variant-prod.php",
	 method:"POST",
	 dataType:'json',
     data:{ id_prod : id_prod},
		success:function(response){
		if(status == 'SUCCESS'){
			var variante_table = "";
			var lista = response.data;
				for(var a = 0; a < lista.length; a++){
					id = lista[a].id;
					nome = lista[a].nome;
					tipo = lista[a].tipo;
					preco = lista[a].preco;
					qtd = lista[a].qtd;

					variante_table += '<tr id="row_'+id+'">'+
											'<td id="nome_'+id+'"><a href="variante-'+nome+'"> '+nome+'</a></td>'+
											'<td id="nome_'+id+'"><a href="variante-'+nome+'"> '+tipo+'</a></td>'+
											'<td id="nome_'+id+'"><a href="variante-'+nome+'"> '+preco+'</a></td>'+
											'<td id="nome_'+id+'"><a href="variante-'+nome+'"> '+qtd+'</a></td>'+
											'<td><button class="btn btn-danger" onclick="RemoveVariante('+id+')" type="button" ><i class="icon-trash f-s-17"></i></button></td>'+
										'</tr>';
				}
      		$('#table_variantes').html(variante_table);
		} 
    }
    }); 

  }

  get_variante();
  function RemoveVariante(id){

  	information = '<div class="user-info">'+
                        '<h5>Você deseja realmente remover essa Variante?</h5>'+
                    '</div></div>';   
    swal({
        html: information,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
                   url: 'includes/loja/delete_variante_produto.php',
                   type: 'POST',
                   dataType:"json",
                   data: {
                   id : id
                   }
             })
             .done(function(response){
                var json = response;
                status = json.status;
                status_txt = json.status_txt;
                swal.close(); 
                toastr.success(status_txt, 'Sucesso');  
               
             })
             .fail(function(){
                 swal('Oops...', 'Algo aconteceu errado , se o problema persistir entrar em contato com o Administrador !', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });

  }


    $("#carregar_imagem").click(function(){
        $("#ufile").click();
    });
    
    $("#ufile").change(function(){
        var file = event.target.files;
        $("#load_img").show();
        $(".progress").css("width", "0px");
        $("#status_img").html("0%");

        var reader = new FileReader();
        reader.onload = function(e){
            $("#image_produto").attr("src", e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

        var data = new FormData();
        $.each(file, function(key, value)
        {
        var id = $('#id_page').val();
        //data.append(key, value);
        data.append("upload_file", value);
        data.append("id", id);
        });

        $.ajax({
        xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt){
          if (evt.lengthComputable) {
          var percentComplete = evt.loaded / evt.total;
          var percentInt = parseInt(percentComplete * 100);
          //$("#status_img").html(percentInt + "%");
          }
        }, false);
        xhr.addEventListener("progress", function(evt){
          if (evt.lengthComputable) {
          var percentComplete = evt.loaded / evt.total;
          var percentInt = parseInt(percentComplete * 100);
          $(".progress").css("width", percentInt+"%");
          $("#status_img").html(percentInt + "%");


          }
        }, false);
        return xhr;
      },
      type: 'POST',
      url:"includes/loja/upload_pic_produto",
      data: data,
      dataType:'JSON',
      async: true,
      cache: false,
      processData: false,
      contentType: false,
      success: function(data) {
        var image_path;
        status = data.status;
        status_txt = data.status_txt;
        id_pic = data.id_pic;

        if (status == 'SUCCESS') {
            toastr.success('Sucesso!', status_txt); 
            setTimeout(function(){
                $('#status_img').fadeOut();
                $('.progress').fadeOut();
             }, 4000);
        
        }  else {
            toastr.error('Erro!', status_txt); 
        }
      }
    });
    });
        
    $( "#web_btn" ).click(function() {
        turn_on_camera();
    });

    $( "#pic_btn" ).click(function() {
        turn_off_camera();
    });

    function turn_off_camera(){
        Webcam.reset();
    }
    

    function turn_on_camera(){
        Webcam.on( 'error', function(err) {
        console.log("Sem webcam");
        });

        Webcam.set({
            width: 285,
            height: 285,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
    
        Webcam.attach('#my_camera');

        $('#take_snapshot').click(function(){
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
                image = data_uri;
                id = $("#id_clientt").val();

                $.ajax({
                url:"includes/produto/take_pic_produto",
                data: {base64:image,id:id},// Add as Data the Previously create formData
                type:"POST",
                dataType:'JSON',
                error:function(err){
                    toastr.error('Erro!', status_txt);
                },
                success:function(data){
                    status = data.status;
                    status_txt = data.status_txt;
                    if(status == 'SUCCESS'){
                        toastr.success('Sucesso!', status_txt);
                    }
                },
                complete:function(){

                }
            });
            
            });
            
        }) 
    }
	</script>
