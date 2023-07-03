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
.transparent-card .table>thead>tr>td, .transparent-card .table>thead>tr>th {color: #65461f;}
.dataTables_filter{display:none;}
table.dataTable.no-footer {border-bottom: 1px solid #ffffff;}
table.dataTable thead th, table.dataTable thead td {padding: 10px 18px;border-bottom: 1px solid #e4e4e4;background: #f9f9f9;}
.dt-buttons{margin-bottom: 20px;float: right;}
.btn {padding: 0.3rem 1.0rem;font-size: 1.6rem;border-radius: 5px;}
</style>
</head>
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
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a id="geral_" href="#geral" data-toggle="tab" class="nav-link active show">Geral</a></li>
                                <li class="nav-item"><a href="#hist_prod_tab" data-toggle="tab" class="nav-link">Histórico</a></li>
                                </ul>
                            <div class="tab-content" style="margin-top: 40px;">
                                <div id="geral" class="tab-pane fade active show">
                                    <div class="pt-3">
                                    
                                        <div class="settings-form">
                                            <form class="form-update-prod" action="javascript:updateProd();" method="post" style="width:100%;">
                                            <?php $id = $_GET['id']; ?>
                                            <input type="hidden" id="id_page" value="<?=$id;?>" >
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label class="text-label">Produto</label>
                                                            <div class="input-group">
                                                                <input type="text" name="produto" id="produto" class="form-control" placeholder="Produto" required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="text-label">Tipo</label>
                                                            <div class="input-group">
                                                                <select id="tipo" name="tipo" style="width: 100%;height:45px;border: 1px solid #dddfe1;" required >
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="text-label">Base</label>
                                                            <div class="input-group">
                                                                <select id="base" name="base" style="width: 100%;height:46px;border: 1px solid #dddfe1;"  >
                                                                    <option disabled selected value="none">Selecione o tipo</option>
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="text-label">Valor</label>
                                                            <div class="input-group">
                                                                <input type="text" name="valor" id="valor" class="form-control money" placeholder="Valor" required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="text-label">Quantidade</label>
                                                            <div class="input-group">
                                                                <input type="text" name="qtd" id="qtd" class="form-control" placeholder="Quantidade"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="text-label">Estoque Mínimo</label>
                                                            <div class="input-group">
                                                                <input type="text" name="min_qtd" id="min_qtd" class="form-control" placeholder="Estoque Mínimo"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="text-label">Vencimento</label>
                                                            <div class="input-group">
                                                                <input type="text" name="validade" id="validade" class="data form-control" placeholder="Vencimento"  >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button id="save_produto" class="btn btn-primary" type="submit">Salvar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="hist_prod_tab" class="tab-pane fade ">
                                    
                                    <div class="table-responsive">
                                            <table class="table table-padded market-capital table-responsive-fix-big" id="hist_produtos" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Descrição</th>
                                                    <th>Tipo</th>
                                                    <th>Qtd</th>
                                                    <th>Valor</th>
                                                    <th>Vencimento</th>
                                                    <th>Data Atualização</th>
                                                    <th>Modificado por</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/plugins/innoto-switchery/dist/switchery.min.js"></script>
<script src="includes/produto/get_info_produto.js"></script>
<script src="includes/produto/update_produto.js"></script>
<script src="js/webcam.min.js"></script>

	
<script>

get_lista_base();
function get_prod_hist(){

var id = $('#id_prod').val();
var table = $('#hist_produtos').DataTable({
        ajax: {
            url: 'includes/produto/get_produtos_hist',
            data:{id:id},
            dataType:'JSON'
        },
        language: {
            "lengthMenu": "Mostrar  _MENU_ linhas registros",
            "zeroRecords": "Nenhum resultado encontrado",
            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registos",
            "infoEmpty": "Nenhum dado disponível",
            "infoFiltered": "(Filtrado de _MAX_ registros no total)",
            "sSearch":       "Procurar:",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
            }
        }   ,
        
        columnDefs: [ 
            { 
                "targets": 0 , 
                "data": 'desc'	
            },
            {
                "targets": 1,
                "data": 'tipo',
            },
            { 
                "targets": 2 , 
                "data": 'qtd',
                
            },
            { 
                "targets": 3 , 
                "data": 'valor',
            },
            { 
                "targets": 4 , 
                "data": 'validade'
            },
            { 
                "targets": 5 , 
                "data": 'data_atualizacao'   
            },
            { 
                "targets": 6 ,
                "data": 'nome_funcionario',
                    "render": function (data, type, row, meta) {
                                var img = row.foto_usuario + '?' + (new Date()).getTime();
                                return '<img style="width: 30px;border-radius: 50%;margin-right: 5px;max-height:30px;min-height:30px;" src="'+img+'" />'+row.nome_funcionario+'';
                    }		   
            },

            { "orderable": false, "targets": 1 },
        ],
        "createdRow": function( row, data, dataIndex ) {
            $(row).addClass( 'row_'+data.id );
        },
        dom: 'Bfrtip',
        buttons: [
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        messageTop: '<h2>Lista de Produtos</h2>',
                        columns: ':not(.select-checkbox)',
                        orientation: 'landscape',
                        text: 'Imprimir',
                        className: 'btn btn-primary' 
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-primary'
                    }
                ],

        "deferRender": true
        });

        };

        get_prod_hist();

        $("#search_produtos").on("input", function (e) {
            e.preventDefault();
            $('#lista_product').DataTable().search($(this).val()).draw(); 
        }); 
        


            function go_to_page_single(){
            window.location.href = "cadastro-produto";
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
		var id = $('#id_clientt').val();
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
	  url:"includes/produto/upload_pic_produto",
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

    

    function get_lista_base(){
		var idCliente = $("#id_clientt").val();
		
		$.ajax({
		url:"includes/local/get_base",
		dataType:'JSON',
		method:"GET",
		data:{id:idCliente},
			success:function(response){
				var option = '<option value="0">Nenhum</option>'
				var i;
				for (i = 0; i < response.length; i++) {
					option += '<option value="'+response[i].sigla+'">'+response[i].sigla+'-'+response[i].descricao+'</option>';
							
				}
				$('#base').html(option);	
				
			}
		}); 
   }

   get_info_produto();

</script>
	
