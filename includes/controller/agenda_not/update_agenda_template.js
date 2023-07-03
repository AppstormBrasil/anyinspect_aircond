jQuery(document).ready(function() {
  $(".summernote").summernote({
      height: 350,
      minHeight: null,
      maxHeight: null,
      focus: !1
  }), $(".inline-editor").summernote({
      airMode: !0
  })
}), window.edit = function() {
  $(".click2edit").summernote()
}, window.save = function() {

  $("#desc").val($('#desc').code());

  $(".click2edit").summernote("destroy")
};


$('#titulo').on('keyup', function() {
    if (this.value.length > -1) {
    $('#titulo_left').html(this.value);
 }});


function save_agenda_template() {
  /////////////// INFORMAÇÕES PESSOAIS //////////////
  
  toastr.options = {"positionClass": "toast-top-full-width"}

  var id_page = $('#id_page').val();
  var titulo = $('#titulo').val();
  var descricao = $('.summernote').summernote('code');


  console.log(titulo);
  console.log(descricao);

  console.log(id_page);

    $(".loading").show();
		$.ajax({
			url:  "includes/controller/agenda/update_agenda_template",
            type : 'POST',
            data: {
              titulo : titulo,
              descricao: descricao,
              id: id_page

			},
			success: function(response){
				var json = response;
				status = json.status;
				status_message = json.status_txt;
				if(status == "SUCCESS") {
          toastr.success(status_message, 'Sucesso');
         
          setTimeout(function(){
             $(".loading").hide();
           }, 100);
      
				} else {
					$(".loading").hide();
          toastr.error(status_message, 'Sucesso')

				}

			}
		});

}
