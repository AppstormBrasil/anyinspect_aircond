id = $("#id_form").val();

$("#carregar").click(function(){
	$("#ufile").click();
  });

  $("#ufile").change(function(){
	var file = event.target.files;
	$("#load_img").show();
	$(".progress-user").css("width", "0px");
	$("#status_img").html("0%");

	var reader = new FileReader();
	reader.onload = function(e){
	$("#user_avatar").attr("src", e.target.result);

	
	}
	reader.readAsDataURL(this.files[0]);

	var data = new FormData();
	$.each(file, function(key, value)
	{
	  data.append(key, value);
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
		  $(".progress-user").css("width", percentInt+"%");
		  $("#status_img").html(percentInt + "%");


		  }
		}, false);
		return xhr;
	  },
	  type: 'POST',
	  url: 'includes/form_builder/upload_form_img.php',
	  data: data,
	  async: true,
	  cache: false,
	  processData: false,
	  contentType: false,
	  success: function(data) {
        
        var json = JSON.parse(data);
		status = json.status;
        status_message = json.status_txt;
        toastr.options = {"positionClass": "toast-top-full-width"}

        console.log(status);

		if (status  == 'SUCCESS') {
            
            toastr.success(status_message, 'Sucesso');
		} else {
            toastr.error(status_message, 'Erro');
		}
			  setTimeout(function(){
				$('#status_img').fadeOut();
				$('.progress-user').fadeOut();
			 }, 4000);
	  }
	});

	
  });