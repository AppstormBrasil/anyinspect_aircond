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

  
  var titulo = $('#titulo').val();
  var descricao = $('.summernote').summernote('code');


  console.log(titulo);
  console.log(descricao);

    $(".loading").show();
		$.ajax({
			url:  "includes/controller/agenda/save_agenda_template",
            type : 'POST',
            data: {
              titulo : titulo,
              descricao: descricao

			},
			success: function(response){
				var json = response;
				status = json.status;
				status_message = json.status_txt;
        last_id = json.last_id;
        page_direct = 'area-comum-'+last_id;

				if(status == "SUCCESS") {
          toastr.success(status_message, 'Sucesso');
         
          setTimeout(function(){
             $(".loading").hide();
              window.location.href = page_direct;
           }, 100);
      
				} else {
					$(".loading").hide();
          toastr.error(status_message, 'Sucesso')

				}

			}
		});

}
