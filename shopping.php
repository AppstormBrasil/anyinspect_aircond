<?php include('includes/common/check_permission.php'); ?>
<?php 
	$user_level = get_user_level();
	if($user_level != 'a'){ 
		echo "<script>window.location.href = '#403';</script>";
		exit(0);
	}
?>
<div class="container-fluid">
    <div id="box_tabela" class="row">
        <div class="col-xl-12" >
            <div class="card m-b-0">
                <div class="card-header" style="background: white;padding:15px;">
                    <h4 class="card-title">Produtos à venda</h4>
                    <a class="float-right btn btn-primary btn-xs" href="#cadastro-prod-venda" type="button"><span>Novo Produto</span></a>
                </div>
                <div class="card-body p-0">
                <div class="event-sideber-search">
                    <form action="#" method="post" class="chat-search-form">
                        <input id="search_produtos" type="search" class="form-control" placeholder="Procurar">
                        <i class="fa fa-search"></i>
                    </form>
                </div>
        </div>
    </div>    
    <div id="grid_prod" class="row"></div>   
</div>

<script>

    exibeProdutos();
    function exibeProdutos(){

    $.ajax({
        url:"includes/loja/get-list-prod-venda",
        method:"POST",
        dataType:'json',

    success:function(response){
        var status = response.status;
        var lista_prod = response.data;
        var card_prod = "";

        for(var a = 0; a < lista_prod.length; a++){
        id = lista_prod[a].id;
        foto = lista_prod[a].foto;
        titulo = lista_prod[a].titulo;
        preco = lista_prod[a].preco;
        qtd = lista_prod[a].qtd;
        card_prod += '<div class="col-sm-6 col-xl-3">'+
                            '<div class="card">'+
                                '<div class="card-body">'+
                                    '<div class="text-center">'+
                                        '<img width="100" height="100" src="'+foto+'" class="rounded-circle" alt="">'+
                                        '<h4 class="mt-4">'+lista_prod[a].titulo+'</h4>'+
                                        '<p>Qtd: <strong>'+qtd+'</strong>'+
                                        '</p><a href="#venda_produto-'+id+'" class="single_link btn btn-sm btn-primary">Visualizar</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                    '</div>';
        }
        $('#grid_prod').html(card_prod);
      }
      });
    }

    $('input[type="search"]').keyup(function(){
    var that = this, $allListElements = $('#grid_prod > div');
    var $matchingListElements = $allListElements.filter(function(i, div){
        var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
        return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
});
</script>
