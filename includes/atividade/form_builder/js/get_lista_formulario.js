setTimeout(function(){
    toastr.options = {"positionClass": "toast-top-full-width"}
    if ($('#main_table').length) {
      $('#main_table').DataTable({
        language: {
                "lengthMenu": "Mostrar  _MENU_ linhas registros",
                "zeroRecords": "Não foram encontrados resultados",
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
          },
          "Filter": false, 
          "processing": true,
          "serverSide": true, 
          "Paginate":false,
          "searching": false,
           "ajax": "includes/form_builder/get_table",
          "columns":[
                  {data: "IdFormulario",},
                  {data: "titulo_formulario"},
                  {data: "tipo_formulario"},
		  {data: "data_atualizacao"}
              ],
          "columnDefs": [
			  { 
              "targets": 0,
              "render": function (data, type, row, meta) {
                      return row[0];
                  }
              },
			 { 
              "targets": 1,
              "data": null,
              "render": function (data, type, row, meta) {
                      return '<a href="editar-formulario-'+row[0]+'" ><img style="width:20px;border-radius:50%;margin-right:5px;max-height:20px;min-height:20px;" src="'+row[5]+'" />'+row[1]+'</a>';
                  }
              },
			  { 
              "targets": 2,
              "render": function (data, type, row, meta) {
                      return row[2];
                  }
              },
			  { 
              "targets": 3,
              "render": function (data, type, row, meta) {
                      return row[3];
                  }
              },
			 {
              "targets": 4,
              "width": "10%",
              "data": null,
              "render": function (data, type, row, meta) {
                      return '<button onclick="go_to_page('+row[0]+')" class="btn btn-icon btn-neutral btn-icon-mini"><i class="zmdi zmdi-edit"></i></button><button onclick="RemoveItem('+row[0]+',\''+row[1]+'\',\''+row[5]+'\')" class="btn btn-icon btn-neutral btn-icon-mini"><i class="zmdi zmdi-delete"></i></button>'
                  }
              },
              
              { "orderable": false, "targets": 4 },
              { "width": "5%", "targets": 0 }
           ],
           "createdRow": function( row, data, dataIndex ) {
                $(row).addClass( 'row_'+data[0] );
            },
          "deferRender": true,
           buttons: ['copy', 'excel', 'pdf']
      },
      
      );
    }
  
    $("#procura_cliente").on("input", function (e) {
      e.preventDefault();
     $('#main_table').DataTable().search($(this).val()).draw(); 
  }); 
}, 300);
  
  function go_to_page(id){
      window.location.href = "editar-formulario-"+id;
  }

  function remove_elemento(id) {
	/////////////// INFORMAÇÕES PESSOAIS //////////////
	$("#defaultModalDelete").modal('show');
	$("#dummy_del").val(id);
		
  }

  function RemoveItem(IdFormulario,nome,imagem){
    information = '<div class="user-info">'+
                        '<div class="image"><a href="formulario-'+IdFormulario+'" class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
                            '<h4><strong>'+nome+'</strong></h4>'+
                            '<h5>Você deseja realmente remover este Formulário ?</h5>'+
                        '</div>'+
                    '</div>';
    
    swal({
        html: information,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        showLoaderOnConfirm: false,
          
        preConfirm: function() {
          return new Promise(function(resolve) {
               
             $.ajax({
                   url: 'includes/form_builder/deletar_formulario',
                   type: 'POST',
                   data: {
                    id : IdFormulario
                }
             })
             .done(function(response){
                var json = JSON.parse(response);
                status = json.status;
                status_txt = json.status_txt;
                //swal('Removido!', status_txt, status);
                swal.close(); 
                $('.row_'+IdFormulario).remove();
                toastr.success(status_txt, 'Sucesso');  
               
             })
             .fail(function(){
                 swal('Oops...', 'Something went wrong with ajax !', 'error');
             });
          });
        },
        allowOutsideClick: false			  
    });	
    
}

function sim_deleta(){
    id = $("#dummy_del").val();
    toastr.options = {"positionClass": "toast-top-full-width"}
	$(".loading").show();
	$.ajax({
		url:  "includes/form_builder/deletar_formulario",
		type : 'POST',
		data: {
			id
		},
		success: function(response){
			var json = JSON.parse(response);
			status = json.status;
			status_message = json.status_txt;
			
			if(status == "SUCCESS") {
			setTimeout(function(){
				 $(".loading").hide();
                 $('.row_'+id).remove();
				 setTimeout(function(){
					toastr.success(status_message, 'Sucesso');
				 }, 100);
                 $("#defaultModalDelete").modal('hide');
                
			}, 100);

			} else {
				$(".loading").hide();
                 toastr.error(status_message, 'Sucesso');
			}
		}
	});
}
  