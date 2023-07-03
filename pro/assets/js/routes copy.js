var routes = [
  // Index page
  {
    path: '/',
    url: './index.html',
    name: 'index',
    animate: false,
    on: {
        pageInit: function (e, page) {
          $$('.splash-screen').addClass('hide-screen');
          setTimeout(function () {
            
            let user_info = Utils.userData();
            $$('.splash-screen').addClass('hide-screen');
            if(!user_info){
              page.app.views.main.router.navigate('/sign-in/' , {clearPreviousHistory: true});
            } else {
              page.app.views.main.router.navigate({ name: 'dashboard' } , { reloadAll: false , animate:false , ignoreCache: false });	
            }
          }, 200);
        $$('.scaleffect').on('touchstart', function () {
          $$(this).addClass('box-scale'); 
        });
        $$('.scaleffect').on('touchend', function () {
          $$(this).removeClass('box-scale'); 
        });
        },
        pageAfterOut: function (e, page) {
          // page has left the view
        },
      }
  },
  {
    path: '/sign-in/',
    url: './pages/sign-in.html',
    name: 'sign-in',
    animate: true,
    force: false,
    ignoreCache: true,
    on: {
      pageInit: function (e, page) {
        setTimeout(function(){
          window.animatelo.bounceIn('#logo_login');
        }, 300);
      	$$('.login_btn').on('click', function(e){
          e.preventDefault();
          
          var formData = app.form.convertToData('#form-login');
          let email = formData.email;
          let pass = formData.pass;
          var myinfo , status , status_txt;
          var user_push = Utils.userDataPush();  

          if(email == ''){
            var toast_message = app.toast.create({text: 'Digite um e-mail válido',closeTimeout: 2000,cssClass: 'error_toast'});
            toast_message.open();
            return;
          } else if(pass == ''){
            var toast_message = app.toast.create({text: 'Digite sua senha',closeTimeout: 2000,cssClass: 'error_toast'});
            toast_message.open();
            return;
          }
          app.preloader.show();
          app.request.json(current_path + '/view/get_login',  {email: email, password:pass } , function (data) {
          myinfo = data[0];
          status = data.status;
          status_txt = data.status_txt;
          
          if(status == 'SUCCESS'){
          let IdUser = myinfo.id	
          setTimeout(function () {
            app.preloader.hide();
            }, 500);
          
          const user = {
            id: myinfo.id,
            name: myinfo.name,
            qr_code: myinfo.qr_code,
            type: myinfo.type,
            type2: myinfo.type2,
            sign: myinfo.sign,
            //foto: myinfo.foto+ '?' + new Date().getTime()
            foto: myinfo.foto
          }
          window.localStorage.setItem('user_info_app_insp', JSON.stringify(user));
          app.views.main.router.navigate({ name: 'dashboard' } , { reloadAll: false , animate:false , ignoreCache: false });	
          
        } else {
          
           var toast_message = app.toast.create({text: status_txt,closeTimeout: 2000,cssClass: 'error_toast'});
            toast_message.open();
            setTimeout(function () {
            app.preloader.hide();
            }, 1000);
            
        }
        });
      });

      $$('.scaleffect').on('touchstart', function () {
        $$(this).addClass('box-scale'); 
      });
      $$('.scaleffect').on('touchend', function () {
        $$(this).removeClass('box-scale'); 
      });
      
      
      },
      pageAfterOut: function (e, page) {
        // page has left the view
        sync_download();
      },


    }
  
  
   
  }, 
  {
    path: '/forgot-password/',
    url: './pages/forgot-password.html',
    name: 'forgot-password',
    animate: true,
    force: false,
    ignoreCache: true,
    
    on: {
      pageInit: function (e, page) {

      
        setTimeout(function(){
          window.animatelo.bounceIn('#logo_login');
        }, 300);


      	$$('.forgot_password').on('click', function(e){
          e.preventDefault();
          
          var formData = app.form.convertToData('#form-forgot');
          let email = formData.email;
          
          if(email == ''){
            var toast_message = app.toast.create({text: 'Digite seu e-mail',closeTimeout: 2000,cssClass: 'error_toast'});
            toast_message.open();
            return;
          }
          
          var myinfo , status , status_txt;
          var user_push = Utils.userDataPush();  
      
          app.dialog.confirm('Você tem certeza que deseja ressetar sua senha ? ','Recuperação de Senha', function () {
          app.preloader.show();
                app.request.json(current_path + '/view/email/recupera_senha',  {email: email } , function (data) {
                  myinfo = data[0];
                  status = data.status;
                  status_txt = data.status_txt;
                  
                  if(status == 'SUCCESS'){
                    var toast_message = app.toast.create({text: status_txt,closeTimeout: 2000,cssClass: 'success_toast'});
                    toast_message.open();
                    app.preloader.hide();
                    setTimeout(function () {
                      
                      app.dialog.create({
                        title: '<div class="dialog-title dialog-title-custom" style="padding:15px;background: #18998d;color: #fff;" >Sucesso!</div>',
                        text: '<div class="dialog-inner dialog-inner-custom">Sua nova foi enviada para o e-mail solicitado , verifique sua caixa de Spam!</div>',
                        buttons: [
                          {
                            text: '',
                          },
                          {
                            text: '<div class="dialog-button">Ok</div>',
                            onClick: function () {
                              app.views.main.router.navigate({ name: 'sign-in' } , { reloadAll: true , animate:true , ignoreCache: false });
                            },
                          },
                          
                        ],
                        on: {
                          open: function () {
                            $$('.dialog-inner').removeClass('dialog-inner');
                            $$('.dialog-inner-custom').addClass('dialog-inner');
                          }
                        } 
                      }).open();
                    
                    }, 1000);
                    
                  } else {
                    var toast_message = app.toast.create({text: status_txt,closeTimeout: 2000,cssClass: 'error_toast'});
                    toast_message.open();
                    setTimeout(function () {
                      app.preloader.hide();
                    }, 1000);
                    
                  }
      
                });	
          });
        
      
      });

      $$('.scaleffect').on('touchstart', function () {
        $$(this).addClass('box-scale'); 
      });
      $$('.scaleffect').on('touchend', function () {
        $$(this).removeClass('box-scale'); 
      });
      
      
      },
      pageAfterOut: function (e, page) {
        // page has left the view
      },
    }
  
  
   
  }, 
  {
      path: '/dashboard/',
      url: './pages/dashboard.html',
      name: 'dashboard',
      on: {
        pageInit: function (e, page) {
          //Icon click
          $$('.search .search-icon').on('click', function (e) {
            $$('.searchbar-custom').addClass('open-search');
          });
          $$('.searchbar-disable-button').on('click', function (e) {
            $$('.searchbar-custom').removeClass('open-search');
          });

          var user_push = Utils.userDataPush();  
          var user_info = Utils.userData();
          if(user_info == null || user_info == 'null'){
            app.views.main.router.navigate({ name: 'sign-in' });
          }

          let IdUser = user_info.id;
          var type = user_info.type;

          //sync_download();

          if(type == 'a' || type == 'g' || type == 'r' ){
            $$('#initial_dash').html(
              ' <a href="#approve" class="tab-link tab-link-active">Aguardando Aprovação</a>'+
              '<a href="#pending" class="tab-link">Pendentes</a>'
            );
            $$('#approve').addClass('tab-active');
          } else {
            $$('#initial_dash').html(
             '<a href="#pending" class="tab-link tab-link-active">Pendentes</a>'
            );
            $$('#approve').remove();
            setTimeout(function () {
              $$('#pending').addClass('tab-active');
              }, 1000);
            
          }

          if(user_push != null){

            var condition = navigator.onLine ? "online" : "offline";
            if(condition == 'offline'){

            } else {
              let authToken = user_push.authToken;
              let contentEncoding = user_push.contentEncoding;
              let endpoint = user_push.endpoint;
              let publicKey = user_push.publicKey;
              fetch(current_path + '/controller/notification-subscribe', {
                method: 'POST',
                headers : new Headers(),
                body:JSON.stringify({IdUser:IdUser,authToken:authToken,contentEncoding:contentEncoding,endpoint:endpoint,publicKey:publicKey})
                }).then((res) => res.json())
                .then((data) =>  {
                if(data.status == 'SUCCESS'){
                  setTimeout(function () {
                    app.preloader.hide();
                    }, 1000);
                  
                }
              })
              .catch((err)=>console.log(err))
            }

            
          
          }
          

          setTimeout(function(){ 
            var home_date , month_dummy ;
            var current_month = "";
            var weekLater = new Date();
            month_dummy = weekLater.getMonth() + 1;
        
            if(month_dummy == 1){
              current_month = 'Jan';
            }
            if(month_dummy == 2){
              current_month = 'Fev';
            }
            if(month_dummy == 3){
              current_month = 'Mar';
            }
            if(month_dummy == 4){
              current_month = 'Abr';
            }
            if(month_dummy == 5){
              current_month = 'Mai';
            }
            if(month_dummy == 6){
              current_month = 'Jun';
            }
            if(month_dummy == 7){
              current_month = 'Jul';
            }
            if(month_dummy == 8){
              current_month = 'Ago';
            }
            if(month_dummy == 9){
              current_month = 'Set';
            }
            if(month_dummy == 10){
              current_month = 'Out';
            }
            if(month_dummy == 11){
              current_month = 'Nov';
            }
            if(month_dummy == 12){
              current_month = 'Dez';
            }
            home_date = weekLater.getDate()+'-'+current_month;
            $$('#day_today').html(home_date);
            
            var user_info = Utils.userData();
            if(user_info == null || user_info == 'null'){
              app.views.main.router.navigate({ name: 'sign-in' });
            }
            if(user_info){
                var imagem_usuario = user_info.foto;
                var nome_morador = user_info.name;
                var IdUser = user_info.id;
                var type = user_info.type;

                if(IdUser == null || IdUser == 'null'){
                  app.views.main.router.navigate({ name: 'sign-in' });
                }

                $('.user_name').html(nome_morador);
                $(".user_img").attr('src', imagem_usuario +'?' + (new Date()).getTime());
              }
            
            
            $(".logout_global").click(function(e){
              e.preventDefault();
              window.localStorage.removeItem('user_info_app_insp');
              window.localStorage.removeItem('user_info_push_insp');
              app.views.main.router.navigate('/sign-in/' , {clearPreviousHistory: true});
              });
              
              $(".hot_reload").click(function(e){
              e.preventDefault();
              window.location.reload()
              });

              $(".sync_upload").click(function(e){
                e.preventDefault();
                sync_upload();
              });
              
              $(".sync_download").click(function(e){
                e.preventDefault();
                sync_download();
              });
          
          
              $('#search_events').keyup(function(){
                var that = this, $allListElements = $('#open_list > li');
                var $matchingListElements = $allListElements.filter(function(i, div){
                  var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
                  return ~listItemText.indexOf(searchText);
                });
                $allListElements.hide();
                $matchingListElements.show();
                });
          
          }, 10);

          var condition = navigator.onLine ? "online" : "offline";
          if(condition == 'offline'){
            call_open_events_off();
            $(".refresh_events").click(function(e){
              e.preventDefault();
              call_open_events_off();
              var toast_message = app.toast.create({text: 'Atualizando......',closeTimeout: 3000,cssClass: 'success_toast'});
			        toast_message.open();
            });
          } else {
            call_open_events();
            $(".refresh_events").click(function(e){
              e.preventDefault();
              call_open_events();
              var toast_message = app.toast.create({text: 'Atualizando......',closeTimeout: 3000,cssClass: 'success_toast'});
			        toast_message.open();
            });
          }
        
          
          

          $$('.scaleffect').on('touchstart', function () {
            $$(this).addClass('box-scale'); 
          });
          $$('.scaleffect').on('touchend', function () {
            $$(this).removeClass('box-scale'); 
          });
          
        },
        pageAfterOut: function (e, page) {
          // page has left the view
        },
      }
  },
  {
    path: '/qr-signin/:eventID/:the_status/:id_funcionario/:qrcode/:idform/:configs/:id_groups/:det_info',
    url: './pages/qr-signin.html',
    name: 'qr-signin',
    on: {
      pageInit: function (e, page) {
        //Icon click
        let eventID = page.route.params.eventID;
        let id_funcionario = page.route.params.id_funcionario;
        let qrcode = page.route.params.qrcode;
        let the_status = page.route.params.the_status;
        let idform = page.route.params.idform;
        let configs = page.route.params.configs;
        let id_groups = page.route.params.id_groups;
        let det_info = page.route.params.det_info;
        
        qr_code_start(eventID,the_status,id_funcionario,qrcode,idform,configs,id_groups,det_info);

        $$('.scaleffect').on('touchstart', function () {
          $$(this).addClass('box-scale'); 
        });
        $$('.scaleffect').on('touchend', function () {
          $$(this).removeClass('box-scale'); 
        });
        

      },
      pageAfterOut: function (e, page) {
        // page has left the view
      },
    }
},
  {
    path: '/qr-info/',
    url: './pages/qr-info.html',
    name: 'qr-info',
    options: {
      transition: 'f7-circle',
    },
    on: {
      pageInit: function (e, page) {
        //Icon click
        let eventID = page.route.params.eventID;
        let id_funcionario = page.route.params.id_funcionario;
        let qrcode = page.route.params.qrcode;
        let the_status = page.route.params.the_status;
        let idform = page.route.params.idform;
        
        qr_info(eventID,the_status,id_funcionario,qrcode,idform);

        $$('.scaleffect').on('touchstart', function () {
          $$(this).addClass('box-scale'); 
        });
        $$('.scaleffect').on('touchend', function () {
          $$(this).removeClass('box-scale'); 
        });
        

      },
      pageAfterOut: function (e, page) {
        // page has left the view
      },
    }
},

{
  path: '/info_ativo/:qrCodeMessage',
  url: './pages/info_ativo.html',
  name: 'info_ativo',
  on: {
    pageInit: function (e, page) {
      //Icon click
      let qrCodeMessage = page.route.params.qrCodeMessage;

      let user_info = Utils.userData();
      if(user_info == null || user_info == 'null'){
        app.views.main.router.navigate({ name: 'sign-in' });
      }
	    var IdUser = user_info.id;
	    var type = user_info.type;

      if(IdUser == null || IdUser == 'null'){
        app.views.main.router.navigate({ name: 'sign-in' });
      }

      var id_ativo = ""
      
      fetch(current_path + '/view/get_qr_info_result', {
				method: 'POST',
				headers : new Headers(),
				body:JSON.stringify({IdUser:IdUser,type:type,qrCodeMessage:qrCodeMessage})
				}).then((res) => res.json())
				.then((data) =>  {
				if(data.status == 'SUCCESS'){
          app.preloader.hide();
          var info = data[0];
          var hist = data.hist;
          var endereco , cidade , cep , numero , bairro , complemento , estado = "";

          var category = info.category;
          var descricao = info.descricao;
          var foto = info.foto;
          var foto_client = info.foto_client;
          var id = info.id;
          var id_cliente = info.id_cliente;
          var model = info.model;
          var nome_client = info.nome_client;
          var lat = info.lat;
          var lon = info.lon;
          var register = info.register;
          var phone = info.phone;

          id_ativo = info.id;

          endereco = info.endereco;
          cidade = info.cidade;
          cep = info.cep;
          numero = info.numero;
          bairro = info.bairro;
          complemento = info.complemento;
          estado = info.estado;

          if(endereco != ''){
            endereco = endereco;
          }

          if(numero != ''){
            numero = ' , ' + numero;
          }
          
          if(bairro != ''){
            bairro = ' , ' + bairro;
          }
          
          if(complemento != ''){
            complemento = ' , ' + complemento;
          }
          
          if(cidade != ''){
            cidade = ' , ' + cidade;
          }
          
          if(estado != ''){
            estado = ' , ' + estado;
          }

          if(cep != ''){
            cep = ' , ' + cep;
          }

          var full_endereco = endereco + complemento + cidade + estado + cep ;
          
          
          $$(".info_foto_ativo").attr('src', foto +'?' + (new Date()).getTime());
          $$('.info_desc_ativo').html(descricao);
          $$('.info_model_ativo').html('Modelo: ' + model);
          $$('.info_categoria_ativo').html('Categoria: ' +category);
         
          $$('.info_model_ativo').html(model);
          $$('.info_phone_ativo').html(' '+phone);
          $$('.info_endereco_ativo').html(' '+full_endereco);

            var dummy_open_list_ativo = "";
            var current_status , read = "";
            
            hist.forEach(function (data) {
    
                status_ = data.status;
                if(status_ == 'Pendente'){
                current_status = 'list_status_pendente';
                }
                if(status_ == 'Em Andamento'){
                status_ = 'Em Andamento';
                current_status = 'list_status_andamento';
                read = 'read';
                }
                if(status_ == 'Cancelado'){
                status_ = 'Cancelado';
                current_status = 'list_status_cancelado';
                read = 'read';
                }
                if(status_ == 'Deletado'){
                status_ = 'Deletado';
                current_status = 'list_status_deletado';
    
                }
                if(status_ == 'Concluído'){
                status_ = 'Concluído';
                current_status = 'list_status_concluido';
                read = 'read';
                }
                if(status_ == 'Finalizado'){
                current_status = 'list_status_finalizado';
                read = 'read';
                }

                dummy_open_list_ativo += 
                '<div class="patient-widget">'+		
                  '<div class="patient-top-details">'+
                    '<div>'+
                      '<span class="invoice-id"><strong>'+data.started_at+'</strong></span>'+
                    '</div>'+
                    '<div>'+
                      '<span class="date-col '+current_status+'">'+status_+'</span>'+
                    '</div>'+
                  '</div>'+
                  '<div class="invoice-widget">'+
                    '<div class="pat-info-left">'+
                      '<div class="patient-img">'+
                        '<a href="/atividade/'+data.id_booking+'">'+
                        '<img style="width:50px;height:50px" src="'+data.foto_ativo+'" class="img-fluid" alt="User Image">'+
                        '</a>'+
                      '</div>'+
                      '<div class="pat-info-cont">'+
                        '<h4 class="pat-name"><a href="/atividade/'+data.id_booking+'">'+descricao+'</a></h4>'+
                        '<div class="patient-details-col">'+
                        '<span class="">#'+data.id_booking+'</span>'+
                        '</div>'+
                        '<div class="hour-col">'+
                          '<div>'+
                            '<span class="hours">'+data.descricao+'</span>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '</div>'+
                  '</div>';	
   

            });
            
            $$('#hist_list_ativo').html(dummy_open_list_ativo);

             var options = {
              series: [{
              name: 'Atividades',
              data: data.data_count
            }],
              chart: {
              type: 'bar',
              height: 250
            },
            colors:['#4c958f', '#E91E63', '#9C27B0'],
            grid: {
              show: true,
              borderColor: '#90A4AE',
              strokeDashArray: 0,
              position: 'back',
              xaxis: {
                  lines: {
                      show: false
                  }
              },   
              yaxis: {
                  lines: {
                      show: false
                  }
              },  
              row: {
                  colors: undefined,
                  opacity: 0.5
              },  
              column: {
                  colors: undefined,
                  opacity: 0.5
              },  
              padding: {
                  top: 0,
                  right: 0,
                  bottom: 0,
                  left: 0
              },  
            },
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '50%',
                endingShape: 'rounded'
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
            xaxis: {
              lines: {
                show: false
              },
              categories: ['Jan','Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            },
            yaxis: {
              title: {
                text: 'Atividades'
              }
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return val + " Atividades"
                }
              }
            }
            };
    
            var chart = new ApexCharts(document.querySelector("#chart1"), options);
            chart.render(); 

            
            var size_width = $$('.containers').width() - 10;
            
            var tipo_atividade_desc = data.tipo_atividade_desc;
            var tipo_atividade_valor = data.tipo_atividade_valor;
           
           var options = {
              series: tipo_atividade_valor,
              chart: {
              width: size_width,
              type: 'pie',
            },
            labels: tipo_atividade_desc,
            colors:['#4c958f', '#12b9aa', '#67b1aa'],
            responsive: [{
              breakpoint: 480,
              options: {
                chart: {
                  width: size_width
                },
                legend: {
                  position: 'bottom'
                }
              }
            }]
            };
    
            var chart = new ApexCharts(document.querySelector("#char_atividade"), options);
            chart.render();
            if(lat != '' ){
              var map = L.map('map_local_ativo').setView([lat, lon], 15);
              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(map);

              L.marker([lat, lon]).addTo(map)
                  .bindPopup(full_endereco)
                  .openPopup();
            }
            
            
				 
				  
				} else {
				  var toast_message = app.toast.create({text: 'Ativo não encontrado!',closeTimeout: 2000,cssClass: 'error_toast'});
				 toast_message.open();
				}
			  })
        .catch((err)=>console.log(err));
        
        $$('.scaleffect').on('touchstart', function () {
          $$(this).addClass('box-scale'); 
        });
        $$('.scaleffect').on('touchend', function () {
          $$(this).removeClass('box-scale'); 
        });
      

    
        $$('.report_issue').on('click', function (e) {
          e.preventDefault();
          let the_status = this.id;
          var txt_confirma;

          var open_report_box = app.sheet.create({
            el: '.open_report_box',
            swipeToClose: true,
            swipeToStep: false,
            backdrop: true,
            closeByBackdropClick: true,
            closeByOutsideClick: true
            });
          
              
            open_report_box.open();
                  var manual_tag = "";
                    manual_tag = 
                      '<div class="item-inner">'+
                        '<div class="item-input-wrap">'+
                          '<p style="text-align:center;" >Adicionar Comentário </p><br>'+
                          '<textarea style="background: #f5f5f5;padding: 10px!important;" id="problem_description" name="problem_description" cols="30" rows="10" placeholder="Descreva o Problema"></textarea>'+
                          '<br><button style="background:#18998d;color: #fff;height: 45px;" class="btn button btn_confirm_problem">Confirmar</button>'+
                        '</div>'+
                      '</div>';                   
    
                  $$('#box_open_report').html(manual_tag);
                  
                  $$('.close_manual').on('click', function (e) {
                    e.preventDefault();
                    open_report_box.close();
                  });
                  
                  $$('.btn_confirm_problem').on('click', function (e) {
                    e.preventDefault();
                    var problem_description = $$('#problem_description').val();

                    if(problem_description == ''){
                      var toast_message = app.toast.create({text: 'Digite seu comentário',closeTimeout: 2000,cssClass: 'error_toast'});
                      toast_message.open();
                      return;
                    } else {
                      fetch(current_path+'/controller/new_problem', {
                        method: 'POST',
                        headers : new Headers(),
                        body:JSON.stringify({
                          problem_description:problem_description,
                          id_ativo:id_ativo,
                          IdUser:IdUser                       
                        })
                        }).then((res) => res.json())
                        .then((data) =>  {
                          var status ;
                          status = data.status;
                          if(status == 'SUCCESS'){
         
                            open_report_box.close();
                            var toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 2000,cssClass: 'success_toast'});
                            toast_message.open();
                            
                          }
                      
                      })
                      .catch((err)=>console.log(err))
                    }
                  });
        });
    
    },
    pageAfterOut: function (e, page) {
      // page has left the view
    },
  }
},

{
    path: '/relatorio',
    url: './pages/relatorio.html',
    name: 'relatorio',
    on: {
      pageInit: function (e, page) {
       
             
        $('#btGerarPDF').click(function () {
               
       
        });

        getPDF();

        function getPDF(){

          var HTML_Width = $("#sharedContent").width();
          var HTML_Height = $("#sharedContent").height();
          var top_left_margin = 15;
          var PDF_Width = HTML_Width+(top_left_margin*2);
          var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
          var canvas_image_width = HTML_Width;
          var canvas_image_height = HTML_Height;
          var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
          html2canvas($("#sharedContent")[0],{allowTaint:true}).then(function(canvas) {
            canvas.getContext('2d');
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
              pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
            for (var i = 1; i <= totalPDFPages; i++) { 
              pdf.addPage(PDF_Width, PDF_Height);
              pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
            }
            
              pdf.save("Relatório2.pdf");
            
            
            });
        };
        $('#search_events_all').keyup(function(){
          var that = this, $allListElements = $('#calendar_serv > li');
          var $matchingListElements = $allListElements.filter(function(i, div){
            var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
            return ~listItemText.indexOf(searchText);
          });
          $allListElements.hide();
          $matchingListElements.show();
          });

          $$('.scaleffect').on('touchstart', function () {
            $$(this).addClass('box-scale'); 
          });
          $$('.scaleffect').on('touchend', function () {
            $$(this).removeClass('box-scale'); 
          });
        

      },
      pageAfterOut: function (e, page) {
        // page has left the view
      },
    }
},
{
    path: '/calendario',
    url: './pages/calendario.html',
    name: 'calendario',
    on: {
      pageInit: function (e, page) {
        //Icon click
        get_calendar();

        $('#search_events_all').keyup(function(){
          var that = this, $allListElements = $('#calendar_serv > li');
          var $matchingListElements = $allListElements.filter(function(i, div){
            var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
            return ~listItemText.indexOf(searchText);
          });
          $allListElements.hide();
          $matchingListElements.show();
          });

          $$('.scaleffect').on('touchstart', function () {
            $$(this).addClass('box-scale'); 
          });
          $$('.scaleffect').on('touchend', function () {
            $$(this).removeClass('box-scale'); 
          });
        

      },
      pageAfterOut: function (e, page) {
        // page has left the view
      },
    }
},
{
    path: '/atividade-grupo/:id_group',
    url: './pages/atividade-grupo.html',
    name: 'atividade-grupo',
    on: {
      pageInit: function (e, page) {
        let id_group = page.route.params.id_group;
        var condition = navigator.onLine ? "online" : "offline";
        if(condition == 'offline'){
          call_open_events_groups_off(id_group);
        } else {
          call_open_events_groups(id_group);
        }
        $('#search_events_all').keyup(function(){
          var that = this, $allListElements = $('#open_list_grupo > li');
          var $matchingListElements = $allListElements.filter(function(i, div){
            var listItemText = $(div).text().toUpperCase(), searchText = that.value.toUpperCase();
            return ~listItemText.indexOf(searchText);
          });
          $allListElements.hide();
          $matchingListElements.show();
          });

          $$('.scaleffect').on('touchstart', function () {
            $$(this).addClass('box-scale'); 
          });
          $$('.scaleffect').on('touchend', function () {
            $$(this).removeClass('box-scale'); 
          });
        

      },
      pageAfterOut: function (e, page) {
        // page has left the view
      },
    }
},
{
    path: '/userprofile/',
    url: './pages/userprofile.html',
    name: 'userprofile',
    on: {
      pageInit: function (e, page) {
        call_user_profile();

        $$('.scaleffect').on('touchstart', function () {
            $$(this).addClass('box-scale'); 
          });
          $$('.scaleffect').on('touchend', function () {
            $$(this).removeClass('box-scale'); 
          });

      },
      pageAfterOut: function (e, page) {
        // page has left the view
      },
    }
},
{

  path: '/gps-signin/:qr/:eventID/:the_status/:id_funcionario/:qrcode/:id_form/:configs/:id_groups/:det_info',
  url: './pages/gps-signin.html',
  name: 'gps-signin',
  on: {
    pageInit: function (e, page) {
      //Icon click
      let eventID = page.route.params.eventID;
      let id_funcionario = page.route.params.id_funcionario;
      let qrcode = page.route.params.qrcode;
      let the_status = page.route.params.the_status;
      let idform = page.route.params.idform;
      let qr = page.route.params.qr;
      let det_info = page.route.params.det_info;
      let id_form = page.route.params.id_form;
      let id_groups = page.route.params.id_groups;
      let configs = page.route.params.configs;
      start_get_location(qr,eventID,the_status,id_funcionario,qrcode,idform,configs,id_groups,det_info);
      var condition = navigator.onLine ? "online" : "offline";

      if(condition == 'offline'){
        $$('.yes_checkin_gps').on('click', function (e) {
          e.preventDefault();
          
          var gps_lat = $$('#gps_lat').val();
          var gps_lon = $$('#gps_lon').val();

          if(gps_lat != '' && gps_lon != ''){
              app.preloader.show();

              var message = {
                gps_lat:gps_lat,
                gps_lon:gps_lon,
                eventID:eventID
              }

              var objectStore = db.transaction(['tb_single'], "readwrite").objectStore('tb_single');
              var request = objectStore.get(eventID);
              request.onerror = function(event) {
              };
              request.onsuccess = function(event) {
              var data = request.result;
              data.start_lat = gps_lat;
              data.start_lon = gps_lon;
              var requestUpdate = objectStore.put(data);
              requestUpdate.onerror = function(event) {
                var toast_message = app.toast.create({text: 'Erro ao registrar localização!',closeTimeout: 2000,cssClass: 'error_toast'});
                toast_message.open();

              };
              requestUpdate.onsuccess = function(event) {
                app.preloader.hide();
                var toast_message = app.toast.create({text: 'Registrado com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
                toast_message.open();
                $$('#gps_lat').val('');
                $$('#gps_lon').val('');

                console.log('qr' + qr)
                console.log(configs)


                if(qr == 1){
                  get_info_gerais_off(eventID);
                } else {
                    altera_status_off(eventID,the_status,id_funcionario,qrcode,id_form,configs,id_groups,det_info);
                }

                setTimeout(function () {
                  $$('.back').click()
                }, 1000);


              };
              };
          
            } else {
            start_get_location(qr,eventID,the_status,id_funcionario,qrcode,idform,configs,id_groups,det_info);
          }
        
        
        });


      } else {
          $$('.yes_checkin_gps').on('click', function (e) {
            e.preventDefault();
            
            var gps_lat = $$('#gps_lat').val();
            var gps_lon = $$('#gps_lon').val();
    
            if(gps_lat != '' && gps_lon != ''){
                app.preloader.show();
                fetch(current_path + '/controller/checkin-gps', {
                  method: 'POST',
                  headers : new Headers(),
                  body:JSON.stringify({IdUser:id_funcionario,eventID:eventID,gps_lat:gps_lat,gps_lon:gps_lon})
                  }).then((res) => res.json())
                  .then((data) =>  {
                  if(data.status == 'SUCCESS'){
                    app.preloader.hide();
                    var toast_message = app.toast.create({text: 'Registrado com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
                    toast_message.open();
                    $$('#gps_lat').val('');
                    $$('#gps_lon').val('');
                    
                    if(qr == 1){
                      get_info_gerais(eventID);
                    } else {
                        altera_status(eventID,the_status,id_funcionario,qrcode,id_form,configs,id_groups,det_info);
                    } 
                    
                    setTimeout(function () {
                      $$('.back').click()
                    }, 1000);
                    
                  } else {
                    var toast_message = app.toast.create({text: 'Erro ao registrar localização!',closeTimeout: 2000,cssClass: 'error_toast'});
                    toast_message.open();
                  }
                })
                .catch((err)=>console.log(err))
            } else {
              start_get_location(qr,eventID,the_status,id_funcionario,qrcode,idform,configs,id_groups,det_info);
            }
          
          
          });
      }

      

      $$('.try_gps_again').on('click', function (e) {
        e.preventDefault();
          start_get_location(qr,eventID,the_status,id_funcionario,qrcode,idform,configs,id_groups,det_info);
        });

      $$('.scaleffect').on('touchstart', function () {
        $$(this).addClass('box-scale'); 
      });
      $$('.scaleffect').on('touchend', function () {
        $$(this).removeClass('box-scale'); 
      });
    },
    pageAfterOut: function (e, page) {
      // page has left the view
    },
  }
},
  {
    path: '/comments-atividade/:idcomentario/:idatividade/:item',
    //url: './pages/comments-atividade.html',
    name: 'comments-atividade',
    
    async: function (routeTo, routeFrom, resolve, reject) {
       app.preloader.show();
     
      let id_booking = routeTo.params.idatividade;
      let id_element = routeTo.params.idcomentario;
      let label = routeTo.params.item;
      //var idcomentario = page.route.params.idcomentario;

      var condition = navigator.onLine ? "online" : "offline";
      if(condition == 'offline'){
        var data = [];
        app.preloader.hide();
        resolve(
          {templateUrl: './pages/comments-atividade.html'},
          {
              context:{
                   response: data
              }
          }
        );

      } else {
        app.request({
          url:			current_path+'/view/get_comment_single?id_booking='+id_booking+'&id_element='+id_element+' ' , 
          method:			'GET',
          dataType:		'json',
          crossDomain:	true,
          success: function(data, textStatus ){
            item = data;
              app.preloader.hide();
              resolve(
                {templateUrl: './pages/comments-atividade.html'},
                {
                    context:{
                         response: data
                    }
                }
              );
           },
          error: function(xhr, textStatus, errorThrown){
          console.log("error" + xhr);
          },
        });
      }

      
  },
  on: {
    pageInit: function (e, page) {
      let data_ = page.route.context.response;
      let id_element = page.route.params.idcomentario;
      let id_booking = page.route.params.idatividade;
      var label = page.route.params.item;
      var comment_el = "";
      var status = data_.status;
      if(status == 'SUCCESS'){
          data_.comments.forEach(function (data) {
            comment_el += '<section class="year">'+
                              '<section>'+
                              '<ul>'+
                                '<li>'+data.target_value+'<br><small>'+data.date_create+'</small></li>'+
                              '</ul>'+
                              '</section>'+     
                          '</section>';
          
          });
        $$('#comment_list').html(comment_el);
       
      }

      setTimeout(function () {
        $$('#title_comment').html('<h3>Item: '+label+'</h3>')
      }, 200);
     

      $$('.save_comment_').on('click', function (e) {
        e.preventDefault();
        var condition = navigator.onLine ? "online" : "offline";
        if(condition == 'offline'){
          save_comment_off(id_element,id_booking)
        } else {
          save_comment(id_element,id_booking)
        }
        
      
      });

      var textarea = document.querySelector('textarea');

      textarea.addEventListener('keydown', autosize);
                  
      function autosize(){
        var el = this;
        setTimeout(function(){
          el.style.cssText = 'height:auto; padding:0';
          // for box-sizing other than "content-box" use:
          // el.style.cssText = '-moz-box-sizing:content-box';
          el.style.cssText = 'height:' + (el.scrollHeight - 10) + 'px';
        },0);
      }

      $$('.scaleffect').on('touchstart', function () {
        $$(this).addClass('box-scale'); 
      });
      $$('.scaleffect').on('touchend', function () {
        $$(this).removeClass('box-scale'); 
      });
      
     
    
    },
    pageAfterOut: function (e, page) {
      // page has left the view
    },
  } 
  
 },
{
  path: '/pa-atividade/:idcomentario/:idatividade/:item',
  //url: './pages/comments-atividade.html',
  name: 'pa-atividade',
  
  async: function (routeTo, routeFrom, resolve, reject) {
      app.preloader.show();
    
    let id_booking = routeTo.params.idatividade;
    let id_element = routeTo.params.idcomentario;
    //var idcomentario = page.route.params.idcomentario;

    app.request({
      url:			current_path+'/view/get_pa_single?id_booking='+id_booking+'&id_element='+id_element+' ' , 
      method:			'GET',
      dataType:		'json',
      crossDomain:	true,
      success: function(data, textStatus ){
        item = data;
          app.preloader.hide();
          resolve(
            {templateUrl: './pages/pa-atividade.html'},
            {
                context:{
                      response: data
                }
            }
          );
        },
      error: function(xhr, textStatus, errorThrown){
      console.log("error" + xhr);
      },
    });
},
on: {
  pageInit: function (e, page) {
    
    let data_ = page.route.context.response;
    let id_element = page.route.params.idcomentario;
    let id_booking = page.route.params.idatividade;
    let label = page.route.params.item;

    $$('#pa_title').html('<h3>Item: '+label+'</h3>');

    var day , month , year, currentMonth , currentYear , currentDay , final_date , total_date , final_date_
    var calendarDateTime = app.calendar.create({
      inputEl: '#when_at',
      timePicker: false,
      //dateFormat: { day: 'numeric', month: 'numeric', year: 'numeric' },
      dateFormat: 'dd/mm/yyyy',
      on: {
        change: function(p, dayContainer, year, month, day ){
      
        },
        dayClick: function (p, dayContainer, year, month, day) {
          var final_date = day+'/'+month+'/'+year;
          $$('#data_servico').html(final_date)
          $$('#choose_date_dummy').val(final_date)
          calendarDateTime.close();

          
        }
      }
      }); 

    var status = data_.status;
    if(status == 'SUCCESS'){
      $$('#what_at').val(data_.pa.what_at);
      $$('#why_at').val(data_.pa.why_at);
      $$('#how_at').val(data_.pa.how_at);
      $$('#resp_at').val(data_.pa.resp_at);
      $$('#where_at').val(data_.pa.where_at);
      $$('#when_at').val(data_.pa.when_at);
      $$('#cost_at').val(data_.pa.cost_at);
    }
   
    

    //$$('#comment_list').html(comment_el);

    $$('#update_pa').on('click', function (e) {
      e.preventDefault();
      save_pa(id_element,id_booking)
    
    });

    $$('.scaleffect').on('touchstart', function () {
      $$(this).addClass('box-scale'); 
    });
    $$('.scaleffect').on('touchend', function () {
      $$(this).removeClass('box-scale'); 
    });


  
  },
  pageAfterOut: function (e, page) {
    // page has left the view
  },
} 

},
{
  path: '/imagem-atividade/:idcomentario/:idatividade/:item',
  //url: './pages/comments-atividade.html',
  name: 'imagem-atividade',
  
  async: function (routeTo, routeFrom, resolve, reject) {
      app.preloader.show();
    
    let id_booking = routeTo.params.idatividade;
    let id_element = routeTo.params.idcomentario;
    let label = routeTo.params.item;
    //var idcomentario = page.route.params.idcomentario;

    app.request({
      url:			current_path+'/view/get_img_evi?id_booking='+id_booking+'&id_element='+id_element+' ' , 
      method:			'GET',
      dataType:		'json',
      crossDomain:	true,
      success: function(data, textStatus ){
        item = data;
          app.preloader.hide();
          resolve(
            {templateUrl: './pages/imagem-atividade.html'},
            {
                context:{
                      response: data
                }
            }
          );
        },
      error: function(xhr, textStatus, errorThrown){
      console.log("error" + xhr);
      },
    });
},
on: {
  pageInit: function (e, page) {
    
    let data_ = page.route.context.response;
    let id_element = page.route.params.idcomentario;
    let id_booking = page.route.params.idatividade;
    let label = page.route.params.item;

    var gallery = [];
    var images = "";
    var status = data_.status;

    if(status == 'SUCCESS'){
        data_.img.forEach(function (data) {
          images += '<div class="swiper-slide">'+
                            '<a href="#" class="pb-standalone-dark"><img src="'+data.imagem+'" alt=""></a>'+
                        '</div>';
          gallery.push(data.imagem);
        
        });

      $$('#has_image').html('<h6>Galeria</h6>');

      $$('#slide_box_img').html(images);
    }

    setTimeout(function () {
      $$('#title_imagem').html('<h3>Item: '+label+'</h3>')
    }, 200);

    $$('.back_images').on('click', function (e) {
      e.preventDefault();
      app.views.current.router.back();
    });

    

    var myPhotoBrowserDark = app.photoBrowser.create({
      photos : gallery,
      theme: 'light'
    });

  

  $$('.pb-standalone-dark').on('click', function () {
      myPhotoBrowserDark.open();
  });
  var toastWithButton = app.toast.create({
    text: 'Name Updated',
    closeButton: true,
  });
  $$('.open-toast-button').on('click', function () {
    toastWithButton.open();
  });

  
  
  $$(".new_image_at").change(function(event){ 

    var id = this.id;
    var file = event.target.files;
    var toast_message = "";

    setTimeout(function(){  
      if(file != 'undefined'){
        var file_size = file[0].size ; 
        var file_type = file[0].type ; 
        var max_size = parseInt(5000);
        file_size = parseInt((file_size/1024));
        
        if(file_type == 'image/png' || file_type == 'image/jpeg' || file_type == 'image/jpg'){
        } 

        else {
          toast_message = app.toast.create({text: 'Somente Arquivos PNG ou JPG',closeTimeout: 3000,cssClass: 'error_toast'});
          toast_message.open();
          $("#temp_image").attr("src", 'images/add_img.svg');
          file = "";
          return;
        }
        if(max_size <= file_size ){
          toast_message = app.toast.create({text: 'Arquivo Máximo de 5MB',closeTimeout: 3000,cssClass: 'error_toast'});
          toast_message.open();
          $("#temp_image").attr("src", 'images/add_img.svg');
          file = "";
          return;
        } 
      }
    }, 30);
    
    
    if(file){
      $$(".progress").css("width", "0px");
        var reader = new FileReader();
        reader.onload = function(e){
        
        var new_img = '<div class="swiper-slide">'+
                          '<a href="#" class="pb-standalone-dark"><img width="68" height="68" src="'+e.target.result+'" alt=""></a>'+
                      '</div>';
        $$("#temp_image").attr("src", e.target.result);
        $$("#temp_new_image").val(e.target.result);
        setTimeout(function(){
          app.views.main.router.navigate('/nova-imagem/'+id_element+'/'+id_booking+'/'+label);
        }, 100);
       

        $$('.pb-standalone-dark').on('click', function () {
          myPhotoBrowserDark.open();
      
        });
        
      
      }
      reader.readAsDataURL(this.files[0]);
    }  
    setTimeout(function(){ 
      $$('.edit_img_pop_exec').on('click', function(e){
        e.preventDefault();
        var id = this.id;
        $$('#current_edit_id_exec').val('');
        $$('#current_edit_id_exec').val(id);
        $$('.open_pop_edit_img_exec').click();
      });
      $$(".remove_img_exec").click(function(e){
        e.preventDefault(); 
        var id = this.id;
        $$("#image_client_exec_"+id+"").attr("src", 'images/add_img.svg');
        $$("#dummy_img_edit_evi_exec_"+id+"").val(""); 
        $$('.img_file_evi_exec_'+id+'').val(""); 
        $$('#edit_img_evi_exec_'+id+'').html(""); 
      });
    
    }, 300);
  });

  $$('.scaleffect').on('touchstart', function () {
    $$(this).addClass('box-scale'); 
  });
  $$('.scaleffect').on('touchend', function () {
    $$(this).removeClass('box-scale'); 
  });


  
  },
  pageAfterOut: function (e, page) {
    // page has left the view
  },
} 

},

{
  path: '/signature-page/:formID/:idatividade/:item/:title',
  url: './pages/signature-page.html',
  //url: './pages/comments-atividade.html',
  name: 'signature-page',

on: {
  pageInit: function (e, page) {
   
    //let data_ = page.route.context.response;
    let id_element = page.route.params.idcomentario;
    let idatividade = page.route.params.idatividade;
    let label = page.route.params.item;
    let title = page.route.params.title;
    let formID = page.route.params.formID;

    var size_width = $$('.page-current').width() - 10;
    var size_height = $$('.page-current').height() - 10;
    var user_info = Utils.userData();
    if(user_info == null || user_info == 'null'){
      app.views.main.router.navigate({ name: 'sign-in' });
    }
    let IdUser = user_info.id;
    var sign = user_info.sign;


    setTimeout(function () {
      $$('#title_comment').html('<h3>Assinatura: '+title+'</h3>')
    }, 200);

    if(title == 'Cliente'){
      $$('.load_sign').remove();
    }

    $$('.load_sign').on('click', function (e) {
      e.preventDefault();
      $$('.download_sign').remove();
      $$('.js-signature').append('<div class="download_sign"><img class="download_image_sign" style="float:left" src="'+sign+'" alt="Assinatura" ></div>');

    });

    $$('.back_images').on('click', function (e) {
      e.preventDefault();
      app.views.current.router.back();
    });

    $('.js-signature').jqSignature({
        autoFit: false,
        width: size_height,
        lineColor: '#000',
        border: '1px solid #fff',
        lineWidth: 1
    
    });

    $('.js-signature').on('jq.signature.changed', function() {
        $$('.download_sign').remove();
    });
      

         var saveButton = document.getElementById('save_sig_din');
					
						saveButton.addEventListener('click', function (event) {
							event.preventDefault();
              var has_downloaded = "";
              has_downloaded = $$('.download_image_sign').attr('src');

              if(has_downloaded == undefined || has_downloaded == 'undefined'){
                value = $('.js-signature').jqSignature('getDataURL');
              } else {
                value = sign;
              }

              if(value == ''){
								var toast_message = app.toast.create({text: 'Assinatura não localizada!',closeTimeout: 2000,cssClass: 'error_toast'});
								  toast_message.open();
								  return;
							} else {
								
                var condition = navigator.onLine ? "online" : "offline";
                if(condition == 'offline'){
                  var request = window.indexedDB.open('AnyInspect_dnata', 3);
                  var db;
                  request.onsuccess = function (event) {
                  db = request.result;
                    setTimeout(function(){
                      var current_data = 0;
                      let objectStore2 = db.transaction("tb_save_event_sig").objectStore("tb_save_event_sig");
                      objectStore2.openCursor().onsuccess = function(event) {
                      var cursor = event.target.result;
                      if(cursor){
                        if (cursor.value.IdEvento == idatividade && cursor.value.campo == label) {
                          data = cursor.value;
                          current_data = 1;
                          var key = cursor.key;
                          var objectStore = db.transaction(['tb_save_event_sig'], "readwrite").objectStore('tb_save_event_sig');
                          var request = objectStore.get(key);
                          request.onerror = function(event) {
                          // Tratar erro
                          };
                          request.onsuccess = function(event) {
                          var data = request.result;
                          data.valor = value;
                           var requestUpdate = objectStore.put(data);
                          requestUpdate.onerror = function(event) {
                            var toast_message = app.toast.create({text: 'Erro ao salvar!',closeTimeout: 2000,cssClass: 'error_toast'});
                            toast_message.open();
                          };
                          requestUpdate.onsuccess = function(event) {
                            var toast_message = app.toast.create({text: 'Salvo com Sucesso',closeTimeout: 2000,cssClass: 'success_toast'});
                            toast_message.open();

                            if(title == 'Cliente'){
                              box_signature =  '<div class="title-col-100" style="padding:10px">'+
                              '<a href="/signature-page/'+formID+'/'+idatividade+'/'+label+'/'+title+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
                              '<h6 style="width: 100%;">'+
                                '<img class="has_sign_client" src="'+value+'" alt=""></h6>'+
                              '</div>';
                          
                            } else if(title == 'Responsável Execução'){
                                box_signature =  '<div class="title-col-100" style="padding:10px">'+
                              '<a href="/signature-page/'+formID+'/'+idatividade+'/'+label+'/'+title+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
                              '<h6 style="width: 100%;">'+
                                '<img class="has_sign_rest_exec" src="'+value+'" alt=""></h6>'+
                              '</div>';
                            } else if(title == 'Responsável Técnico'){
                              box_signature =  '<div class="title-col-100" style="padding:10px">'+
                            '<a href="/signature-page/'+formID+'/'+idatividade+'/'+label+'/'+title+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
                            '<h6 style="width: 100%;">'+
                              '<img class="has_sign_tec" src="'+value+'" alt=""></h6>'+
                            '</div>';
                          }
                            $('.'+label).html(box_signature);
                            app.views.current.router.back();
                          };
                          };
      
                                        
                        } else {
                          current_data = 0;
                          cursor.continue();
                        }
      
                      } else {
                        

                        var request = window.indexedDB.open('AnyInspect_dnata', 3);
                        var dbsavebdhist;
                        var IdEvent;
                        request.onsuccess = function (event) {
                        dbsavebdhist  = request.result;

                         console.log(value);

                         console.log(label)
                         console.log(idatividade)
                         console.log(IdUser)
                         console.log(formID)
                        

      
                        setTimeout(function(){
                          var store = dbsavebdhist.transaction(["tb_save_event_sig"], "readwrite")
                          .objectStore("tb_save_event_sig")
                          .add({ campo:label,IdEvento:idatividade,IdUsuario:IdUser,IdFormulario: formID,valor:value});
                                  
                          store.onsuccess = function(event) {
                            IdEvent = event.target.result;
                            dbsavebdhist.close(); 
                          
                            var toast_message = app.toast.create({text: 'Salvo com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
                            toast_message.open();

                            if(title == 'Cliente'){
                              box_signature =  '<div class="title-col-100" style="padding:10px">'+
                              '<a href="/signature-page/'+formID+'/'+idatividade+'/'+label+'/'+title+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
                              '<h6 style="width: 100%;">'+
                                '<img class="has_sign_client" src="'+value+'" alt=""></h6>'+
                              '</div>';
                          
                            } else if(title == 'Responsável Execução'){
                                box_signature =  '<div class="title-col-100" style="padding:10px">'+
                              '<a href="/signature-page/'+formID+'/'+idatividade+'/'+label+'/'+title+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
                              '<h6 style="width: 100%;">'+
                                '<img class="has_sign_rest_exec" src="'+value+'" alt=""></h6>'+
                              '</div>';
                            } else if(title == 'Responsável Técnico'){
                              box_signature =  '<div class="title-col-100" style="padding:10px">'+
                            '<a href="/signature-page/'+formID+'/'+idatividade+'/'+label+'/'+title+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
                            '<h6 style="width: 100%;">'+
                              '<img class="has_sign_tec" src="'+value+'" alt=""></h6>'+
                            '</div>';
                          }
                            $('.'+label).html(box_signature);
                            app.views.current.router.back();
                          
                          }
      
                          store.onerror = function(event) {
                            var toast_message = app.toast.create({text: 'Erro ao salvar!',closeTimeout: 2000,cssClass: 'error_toast'});
                            toast_message.open();
                          }
                          } , 1000)
                        }; 
                      }
      
                      
                      };
                    }, 500);
                  
                  };

                } else {
                    
                    setTimeout(function(){
                      $.ajax({
                        url:  current_path+"/controller/upload_signature",
                        type : 'POST',
                        dataType: 'JSON',
                        data: {
                          valor: value,
                          campo: label,
                          IdEvento: idatividade,
                          IdUsuario: IdUser,
                          IdFormulario: formID
                        },
    
                        success: function(response){
                          status = response.status;
                          if(status == "SUCCESS") {
                            var image_data = "";
                            var id_imagem = "";
    
                            console.log(label)
    
                            $(".loading").hide();
                            toast_message = app.toast.create({text: 'Salvo com sucesso',closeTimeout: 3000,cssClass: 'success_toast'});
                            toast_message.open();
                            
                            if(title == 'Cliente'){
                                box_signature =  '<div class="title-col-100" style="padding:10px">'+
                                '<a href="/signature-page/'+formID+'/'+idatividade+'/'+label+'/'+title+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
                                '<h6 style="width: 100%;">'+
                                  '<img class="has_sign_client" src="'+value+'" alt=""></h6>'+
                                '</div>';
                            
                            } else if(title == 'Responsável Execução'){
                                box_signature =  '<div class="title-col-100" style="padding:10px">'+
                              '<a href="/signature-page/'+formID+'/'+idatividade+'/'+label+'/'+title+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
                              '<h6 style="width: 100%;">'+
                                '<img class="has_sign_rest_exec" src="'+value+'" alt=""></h6>'+
                              '</div>';
                            } else if(title == 'Responsável Técnico'){
                              box_signature =  '<div class="title-col-100" style="padding:10px">'+
                            '<a href="/signature-page/'+formID+'/'+idatividade+'/'+label+'/'+title+'" class="box-shadow tem-link item-content link " style="background: #d0d0d0;border-radius: 50%;float: right;padding: 8px;position: absolute;right: 10px;margin-top:-25px;"><i class="fa fa-pencil-square-o" style="font-size: 16px;color: #4c4c4c;"></i></a>'+	
                            '<h6 style="width: 100%;">'+
                              '<img class="has_sign_tec" src="'+value+'" alt=""></h6>'+
                            '</div>';
                          }
                            
                            
    
                            $('.'+label).html(box_signature);
                            app.views.current.router.back();
    
                          } else {
                            toastr.error('Erro ao Editar a Imagem', 'Sucesso');
                
                          }
                
                        }
                      }); 
                    }, 500); 
                }
              }
						});
  
  $(".clear_sig").click(function(e){ 
      e.preventDefault();
      var id = this.id;
      $('.js-signature').jqSignature('clearCanvas');
      $$('.download_sign').remove();
  });

  

  $$('.scaleffect').on('touchstart', function () {
    $$(this).addClass('box-scale'); 
  });
  $$('.scaleffect').on('touchend', function () {
    $$(this).removeClass('box-scale'); 
  });


  
  },
  pageAfterOut: function (e, page) {
    // page has left the view
  },
} 

},
{
  path: '/signature-page-user/:IdUser',
  url: './pages/signature-page-user.html',
  name: 'signature-page-user',

on: {
  pageInit: function (e, page) {

    
    //let data_ = page.route.context.response;
    let IdUser = page.route.params.IdUser;
       var size_width = $$('.page-current').width() - 10;
    var size_height = $$('.page-current').height() - 10;
    var user_info = Utils.userData();
    if(user_info == null || user_info == 'null'){
      app.views.main.router.navigate({ name: 'sign-in' });
    }

   
    $$('.back_images').on('click', function (e) {
      e.preventDefault();
      app.views.current.router.back();
    });

    $('.js-signature-user').jqSignature({
        autoFit: false,
        width: size_height,
        lineColor: '#000',
        border: '1px solid #fff',
        lineWidth: 1
    
    });

         var saveButton = document.getElementById('save_sig_din_user');
						saveButton.addEventListener('click', function (event) {
							event.preventDefault();
              value = $('.js-signature-user').jqSignature('getDataURL');

							if(value == ''){
								var toast_message = app.toast.create({text: 'Assinatura não localizada!',closeTimeout: 2000,cssClass: 'error_toast'});
								  toast_message.open();
								  return;
							} else {
								setTimeout(function(){
									$.ajax({
										url:  current_path+"/controller/upload_signature_user",
										type : 'POST',
										dataType: 'JSON',
										data: {
                      valor: value,
                      IdUsuario: IdUser
										},
										success: function(response){
											status = response.status;
											if(status == "SUCCESS") {
												var box_signature_user = "";
												var id_imagem = "";
												$(".loading").hide();
												toast_message = app.toast.create({text: 'Salvo com sucesso',closeTimeout: 3000,cssClass: 'success_toast'});
												toast_message.open();
                        box_signature_user =  '<div class="title-col-100" style="padding:10px">'+
                        '<h6 style="width:100%;">'+
                          '<img src="'+value+'" alt=""></h6>'+
                        '</div>';
                        $('#box_action_sig_user').html(box_signature_user);

                        let user_info = Utils.userData();
                        if(user_info == null || user_info == 'null'){
                          app.views.main.router.navigate({ name: 'sign-in' });
                        }
                        let id = user_info.id;
                        let name = user_info.name;
                        let qr_code = user_info.qr_code;
                        let type = user_info.type;
                        let type2 = user_info.type2;
                        let foto = user_info.foto;

                        const user = {
                          id: id,
                          name: name,
                          qr_code: qr_code,
                          type: type,
                          type: type2,
                          sign: value,
                          foto: foto+ '?' + new Date().getTime()
                          }

                          window.localStorage.setItem('user_info_app_insp', JSON.stringify(user));
                          app.views.current.router.back();

											} else {
												toastr.error('Erro ao Editar a Imagem', 'Sucesso');
						
											}
						
										}
									}); 
								}, 500); 
							}
								
								
						
						});
  
  $(".clear_sig_user").click(function(e){ 
      e.preventDefault();
      var id = this.id;
      $('.js-signature-user').jqSignature('clearCanvas');
  });

  

  $$('.scaleffect').on('touchstart', function () {
    $$(this).addClass('box-scale'); 
  });
  $$('.scaleffect').on('touchend', function () {
    $$(this).removeClass('box-scale'); 
  });


  
  },
  pageAfterOut: function (e, page) {
    // page has left the view
  },
} 

},

{
  path: '/nova-imagem/:id_element/:id_booking/:item',
  url: './pages/nova-imagem.html',
  name: 'nova-imagem',
  on: {
    pageInit: function (e, page) {
      //Icon click
      let id_element = page.route.params.id_element;
      let id_booking = page.route.params.id_booking;
      let label = page.route.params.item;
      var size_heigh = $$(window).height();
      //var size_heigh = $$('#canvas_box').height();
      //var size_width = $$('.page-content').width();


      
      var size_width = $$('#canvas_box').width() - 22;
      $$('#canvas_box').html(' <canvas id="drawing-area-exec" class="drawing-area-exec" height="400" width="'+size_width+'"></canvas>')
      var dummy_img_edit = $$('#temp_new_image').val();
      setTimeout(function(){
        window.animatelo.bounceIn('#clear-button');
      }, 500);
      setTimeout(function(){
        window.animatelo.bounceIn('#save_image');
      }, 800);
      setTimeout(function(){
        window.animatelo.bounceIn('#remove_image');
      }, 1100);

      setTimeout(function(){
        const canvas = document.getElementById('drawing-area-exec');
        const canvasContext = canvas.getContext('2d');
        let dummy_img = new Image();
        dummy_img.src = dummy_img_edit;
        dummy_img.onload = function() {
          canvasContext.drawImage(dummy_img, 0, 0, canvas.width, canvas.height);
        }
        const state = {
          mousedown: false
        };
        const lineWidth = 2;
        const halfLineWidth = lineWidth / 2;
        const fillStyle = '#F44336';
        const strokeStyle = '#F44336';
        const shadowColor = '#F44336';
        const shadowBlur = lineWidth / 4;
        canvas.addEventListener('mousedown', handleWritingStart);
        canvas.addEventListener('mousemove', handleWritingInProgress);
        canvas.addEventListener('mouseup', handleDrawingEnd);
        canvas.addEventListener('mouseout', handleDrawingEnd);
        canvas.addEventListener('touchstart', handleWritingStart);
        canvas.addEventListener('touchmove', handleWritingInProgress);
        canvas.addEventListener('touchend', handleDrawingEnd);
        //clearButton.addEventListener('click', handleClearButtonClick);
        function handleWritingStart(event) {
        event.preventDefault();
        const mousePos = getMosuePositionOnCanvas(event);
        canvasContext.beginPath();
        canvasContext.moveTo(mousePos.x, mousePos.y);
        canvasContext.lineWidth = lineWidth;
        canvasContext.strokeStyle = strokeStyle;
        canvasContext.shadowColor = null;
        canvasContext.shadowBlur = null;
        canvasContext.fill();
        state.mousedown = true;
        }
        function handleWritingInProgress(event) {
        event.preventDefault();
        
        if (state.mousedown) {
          const mousePos = getMosuePositionOnCanvas(event);
  
          canvasContext.lineTo(mousePos.x, mousePos.y);
          canvasContext.stroke();
        }
        }
  
        function handleDrawingEnd(event) {
        event.preventDefault();
        
        if (state.mousedown) {
          canvasContext.shadowColor = shadowColor;
          canvasContext.shadowBlur = shadowBlur;
  
          canvasContext.stroke();
        }
        
        state.mousedown = false;
        }
  
        function getMosuePositionOnCanvas(event) {
          const clientX = event.clientX || event.touches[0].clientX;
          const clientY = event.clientY || event.touches[0].clientY;
          const { offsetLeft, offsetTop } = event.target;
          const canvasX = clientX - offsetLeft;
          const canvasY = clientY - offsetTop;
    
          return { x: canvasX, y: canvasY };
        } 

      },10);

      $$("#save_image").click(function(e){
        e.preventDefault();
        app.dialog.progress('Salvando!Aguarde');
        
        var temp_new_image = $$('#temp_new_image').val();

        if(temp_new_image == ''){
          app.dialog.close();
          toast_message = app.toast.create({text: 'Imagem não encontrada',closeTimeout: 3000,cssClass: 'error_toast'});
          toast_message.open();
          return;
        }
        
        var canvas = document.getElementById("drawing-area-exec");
        var ctx=canvas.getContext("2d");
        var url = canvas.toDataURL();
        var image_data = canvas.toDataURL("image/jpg")
        setTimeout(function(){
          $$("#current_edit_id_exec").val(url);
        }, 500);

        
        if(temp_new_image != ''){
          $.ajax({
            url: current_path+'/controller/upload_image_form' , 
            type : 'POST',
            dataType: 'JSON',
            data: {
              image_data: image_data,
              id_element: id_element,
              id_booking: id_booking,
            },
            success: function(response){
                status = response.status;
                if(status == "SUCCESS") {
                                        
                  app.dialog.close();
                    image_data = "";
                    id_imagem = "";
                  
                    $$('#current_edit_id_exec').val('');
                    $$('#temp_new_image').val('');
                    
                    toast_message = app.toast.create({text: 'Salvo com sucesso',closeTimeout: 3000,cssClass: 'success_toast'});
                    toast_message.open();
                    setTimeout(function(){
                      app.views.main.router.navigate('/imagem-atividade/'+id_element+'/'+id_booking+'/'+label );
                      $('#current_edit_id_exec').val('');
                    }, 50); 

                    var myCanvas = document.getElementById("jq-signature-canvas-1");
                    if(myCanvas == null){} else {
                        var ctx = myCanvas.getContext('2d');
                        ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
                        
                    }
                    
                } else {
                  app.dialog.close();
                  toast_message = app.toast.create({text: 'Erro ao salvar a imagem, tente novamente',closeTimeout: 3000,cssClass: 'error_toast'});
                  toast_message.open();

                }

            }
          }); 
        }

      });

        
        $$("#clear-button").click(function(e){
          e.preventDefault(); 
          clearCanvas();
        });

        $$("#remove_image").click(function(e){
          e.preventDefault(); 
          $$('#temp_new_image').val('');
          $$('#canvas_box').remove();
          clearCanvas();
        });
        
        function clearCanvas() {
          var dummy_img_edit = $$('#temp_new_image').val();
          const canvas = document.getElementById('drawing-area-exec');
          const canvasContext = canvas.getContext('2d');
          const clearButton = document.getElementById('clear-button');
          let dummy_img = new Image();
          dummy_img.src = dummy_img_edit;
          
          dummy_img.onload = function() {
            canvasContext.drawImage(dummy_img, 0, 0, canvas.width, canvas.height);
          }
        }
       
        $$('.scaleffect').on('touchstart', function () {
          $$(this).addClass('box-scale'); 
        });
        $$('.scaleffect').on('touchend', function () {
          $$(this).removeClass('box-scale'); 
        });



    },
    pageAfterOut: function (e, page) {
      // page has left the view
      $('#temp_new_image').val('');
    },
  }
},

  {
    path: '/atividade/:idatividade',
    url: './pages/atividade.html',
    name: 'atividade',
    on: {
      pageInit: function (e, page) {
        //Icon click

        var id_atividade = page.route.params.idatividade;
        var size_heigh = $$(window).height();
        var size_width = $$('.page-content').width() - 20;

        $$('#at_number_header').html(' #'+id_atividade)

        $(".tab" ).on('tab:show', function() {
          var $tabEl = $(this);
          var tabId = $tabEl.attr('id');
          if(tabId == 'tab-1'){
            $$('.left_tab_act').html('')
            $$('.active_slide .tab1').addClass('active');
            $$('.active_slide .tab2').removeClass('active');
            $$('.active_slide .tab3').removeClass('active');
            $$('.right_tab_act').html('<a href="#tab-2" class="submit-btn tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');
          }
          if(tabId == 'tab-2'){
            $$('.left_tab_act').html('<a href="#tab-1" class="submit-btn-left tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');
            $$('.right_tab_act').html('<a href="#tab-3" class="submit-btn tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');
           
            $$('.active_slide .tab2').addClass('active');
            $$('.active_slide .tab1').removeClass('active');
            $$('.active_slide .tab3').removeClass('active');
          }
          if(tabId == 'tab-3'){
            $$('.left_tab_act').html('<a href="#tab-2" class="submit-btn-left tab-link"><img src="assets/img/icons/arrow.png" alt=""></a>');
            $$('.right_tab_act').html('');
            $$('.active_slide .tab3').addClass('active');
            $$('.active_slide .tab1').removeClass('active');
            $$('.active_slide .tab2').removeClass('active');
          }
          
          
          })
          var condition = navigator.onLine ? "online" : "offline";
          if(condition == 'offline'){
            get_info_gerais_off(id_atividade);
          } else {
            get_info_gerais(id_atividade);
          }
          

          $$('.scaleffect').on('touchstart', function () {
            $$(this).addClass('box-scale'); 
          });
          $$('.scaleffect').on('touchend', function () {
            $$(this).removeClass('box-scale'); 
          });

      
      },
      pageAfterOut: function (e, page) {
        // page has left the view
      },
    }
},
{
  path: '/manuais',
  url: './pages/manuais.html',
  name: 'manuais',
  animate: false,
  on: {
      pageInit: function (e, page) {
        $$('.splash-screen').addClass('hide-screen');
        setTimeout(function () {
          
          let user_info = Utils.userData();
          $$('.splash-screen').addClass('hide-screen');
          if(!user_info){
            page.app.views.main.router.navigate('/sign-in/' , {clearPreviousHistory: true});
          } 
          var IdUser = user_info.id;
          app.request.json(current_path + '/view/get_manuais',  {IdUser: IdUser } , function (data) {
            myinfo = data;
            var dummy_manuais = "";
            var manual_result = data.data.length;
            $('#manual_results').html(manual_result)
            data.data.forEach(function (data) {
              link_page = adm_path+"/images/upload/manuais/"+data.id+"";
              dummy_manuais += '<li class="col-100 medium-50">'+
                                      '<div class="card-bx job-card">'+
                                          '<div class="card-media">'+
                                              '<a target="_blank" class="link" href="'+link_page+'"><img src="img/logo/logo1.png" alt=""/></a>'+
                                          '</div>'+
                                          '<div class="card-info">'+
                                              '<h6 class="item-title"><a target="_blank" class="link external" href="'+link_page+'">'+data.descricao+'</a></h6>'+
                                              '<div class="list-info">'+
                                                  '<p>Rev: '+data.rev+'</p>'+
                                              '</div>'+
                                              '<div class="item-footer">'+
                                                  '<a href="#" class="item-tag">'+data.tipo+'</a>'+
                                                  '<h3 class="item-price text-primary">'+data.ref_fabricante+'</h3>'+
                                              '</div>'+
                                          '</div>'+
                                      '</div>'+
                                  '</li>';
                                  
          });
          $$('#manual_list').html(dummy_manuais);
          });	
       
        }, 200);
       
        
        
      $$('.scaleffect').on('touchstart', function () {
        $$(this).addClass('box-scale'); 
      });
      $$('.scaleffect').on('touchend', function () {
        $$(this).removeClass('box-scale'); 
      });
      },
      pageAfterOut: function (e, page) {
        // page has left the view
      },
    }
},

];