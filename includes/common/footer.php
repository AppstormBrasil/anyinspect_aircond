<div class="footer no-print">
            <div class="copyright">
                <p>Copyright &copy; <a href="">AnyInspect</a></p>
            </div>
        </div>
        <input type="hidden" id="global_user" value="<?php echo  get_current_id() ?>"  />
        <input type="hidden" id="get_user_type" value="<?php echo get_user_type() ?>"  />
        

        <script>
           
            function call_user_global() {
                /////////////// INFORMACOES PESSOAIS //////////////
                var global_user = $("#global_user").val();
                var get_user_typ = $("#get_user_type").val();
                    $.ajax({
                        url:  "includes/view/login/get_user_global",
                        dataType: "JSON",
                        data:{
                            global_user:global_user,
                            get_user_typ:get_user_typ
                        },
                        type : 'GET',
                        success: function(response){
                            var json = response.data;
                            user_name = json.name;
                            pic_user = json.foto;
                            my_user = '<img src="'+pic_user+'" alt=""> <span>'+user_name+'</span>  <i class="fa fa-caret-down f-s-14" aria-hidden="true"></i>'
                            $('.log-user').html(my_user);
                        }
                    });

            }

            setTimeout(function(){
                call_user_global()
			}, 200);
   
           
            setTimeout(function() {
            
                $(".logout_global").click(function(){
                deleteCookie('_x19a01m31da');
                deleteCookie('_x19a01m31db');
                deleteCookie('_x19a01m31dc');
                deleteCookie('_x19a01m31de');
                db.removeItem("_x19a01m31da");
                db.removeItem("_x19a01m31db");
                db.removeItem("_x19a01m31dc");
                db.removeItem("_x19a01m31de");
                window.location.href = "login";

                });

                function deleteCookie(nome) {
                var expires = '';
                var valor = '';
                var date = new Date();
                date.setTime(date.getTime());
                expires = '; expires=' + date.toGMTString();
                document.cookie = nome + '=' + valor + expires + '; path=/';
                //window.location.href = caminho ;
                };

                function getLocalStorage() {
                        try {
                            if(window.localStorage) return window.localStorage;
                        }
                        catch (e) {
                            return undefined;
                        }
                    }
                    var db = getLocalStorage();

                   
                    function startTime() {
                    var today = new Date();
                    var h = today.getHours();
                    var m = today.getMinutes();
                    var s = today.getSeconds();
                    // add a zero in front of numbers<10
                    m = checkTime(m);
                    s = checkTime(s);
                    
                    current_time = h+':'+m+':'+s ;
                    
                    document.getElementById('clock_time').innerHTML = h + ":" + m + ":" + s;
                    //document.getElementById('time').innerHTML = h-1 + ":" + m + ":" + s;
                    t = setTimeout(function() {
                        startTime()
                    }, 1000);
                    }
                    startTime();
                    function checkTime(i) {
                    if (i < 10) {
                    i = "0" + i;
                    }
                    return i;
                    }        
             }, 
             
             1000);           
        </script>

