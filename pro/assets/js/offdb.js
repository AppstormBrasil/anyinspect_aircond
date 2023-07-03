
//var app_path = 'https://tecnoair.anyinspect.com.br/pro/api/';

var db;
let dbReq = indexedDB.open('AnyInspect_dnata', 3);
var user_info = Utils.userData();



var app_path = Utils.apiPath();

dbReq.onupgradeneeded = function(event) {
  // Set the db variable to our database so we can use it!  
db = event.target.result;
db.createObjectStore("tb_events", {keyPath: "id"});
db.createObjectStore("tb_events_group", {keyPath: "id"});
db.createObjectStore("tb_form", {keyPath: "id"});
db.createObjectStore("tb_single", {keyPath: "id"});
db.createObjectStore("tb_save_event", {keyPath: "id" , autoIncrement: true});
db.createObjectStore("tb_save_event_comment", {keyPath: "id" , autoIncrement: true});
db.createObjectStore("tb_save_event_sig", {keyPath: "id", autoIncrement: true});
db.createObjectStore("tb_event_result", {keyPath: "id"});
//db.createObjectStore("tb_save_event_sig", {keyPath: "id"});

}
dbReq.onsuccess = function(event) {
  db = event.target.result;
}
dbReq.onerror = function(event) {
  //alert('error opening database ' + event.target.errorCode);
}

function sync_download() {
  var user_info = Utils.userData();
  if(user_info == null || user_info == 'null'){
    
  } else {
    var IdUser = user_info.id;
    var type = user_info.type;
  
    $$('#sync_app').show();
    $$('#sync_app').html('<div style="" id="loadingDiv">Aguarde Atualizando Banco de Dados</div>');
  
     // GET get_open_events_group_off
     async function get_open_events_group_off() {
      const options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    };
    try {
        
        const response = await fetch(app_path+`/view/get_open_events_group_off?IdUser=`+IdUser+`&type=`+type+``, options)
        const json = await response.json();
        return json
    } catch (err) {
    }
    }
  
    setTimeout(function(){ 
      get_open_events_group_off().then( v => {
        localData = v;
        if(localData){
            for (var i in localData.data) {
                addEventsTable(db, localData.data[i]);
            }
        }
      });
    }, 2000);
  
  
  
    function addEventsTable(db , message){
      let tx = db.transaction(['tb_events'], 'readwrite');
      let store0 = tx.objectStore('tb_events');
      store0.add(message);
      tx.oncomplete = function() { 
  
      }
      tx.onerror = function(event) {
      }
  
    }
    // END get_open_events_group_off
    // GET tb_events_group
    async function get_event_group_off() {
      const options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    };
    try {
        
        const response = await fetch(app_path+`/view/get_evento_group_off?IdUser=`+IdUser+`&type=`+type+``, options)
        const json = await response.json();
        return json
    } catch (err) {
    }
    }
    setTimeout(function(){ 
      get_event_group_off().then( v => {
        localData = v;
        if(localData){
            //add(tubeData);
  
            for (var i in localData.data) {
                addEventGroup(db, localData.data[i]);
            }
        }
      }); 
    }, 1500);
  
    function addEventGroup(db , message){
      let tx = db.transaction(['tb_events_group'], 'readwrite');
      let store = tx.objectStore('tb_events_group');
      let notel = {
          data:message
      };
  
      store.add(message);
      tx.oncomplete = function() { 
  
      }
      tx.onerror = function(event) {
      }
  
    }
    // END tb_events_group
    // GET get_form_off
    async function get_form_off() {
      const options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    };
    try {
        
        const response = await fetch(app_path+`/view/get_form_off?IdUser=`+IdUser+`&type=`+type+``, options)
        const json = await response.json();
        return json
    } catch (err) {
    }
    }
    setTimeout(function(){ 
    get_form_off().then( v => {
      localData = v;
      if(localData){
          //add(tubeData);
  
          for (var i in localData.data) {
              addForm(db, localData.data[i]);
          }
      }
    });
    }, 1500);
  
    function addForm(db , message){
      let tx = db.transaction(['tb_form'], 'readwrite');
      let store = tx.objectStore('tb_form');
  
      let notel = {
          'id': message.id, 
          'conteudo_formulario':message.conteudo_formulario
      
      };
      store.add(notel);
      tx.oncomplete = function() { 
      }
      tx.onerror = function(event) {
      }
  
    }
  
    // END get_form_off
  
    // GET eventos_single
    async function get_eventos_single_off() {
      const options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    };
    try {
        
        const response = await fetch(app_path+`/view/get_eventos_single_off?IdUser=`+IdUser+`&type=`+type+``, options)
        const json = await response.json();
        return json
    } catch (err) {
    }
    }
    setTimeout(function(){ 
      get_eventos_single_off().then( v => {
      localData = v;
      if(localData){
          for (var i in localData.data) {
              addSingle(db, localData.data[i]);
          }
      }
    });
    }, 1500);
  
    function addSingle(db , message){
      let tx = db.transaction(['tb_single'], 'readwrite');
      let store = tx.objectStore('tb_single');
      store.add(message);
      tx.oncomplete = function() { 
      }
      tx.onerror = function(event) {
      }
  
    }
  
    // GET ANSWER DATA
  
    async function get_eventos_result_off() {
      const options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    };
    try {
        
        const response = await fetch(app_path+`/view/get_atividade_result_all?IdUser=`+IdUser+`&type=`+type+``, options)
        const json = await response.json();
        return json
    } catch (err) {
    }
   }
    setTimeout(function(){ 
      get_eventos_result_off().then( v => {
      localData = v;
      if(localData){
          for (var i in localData.data) {
            addRults(db, localData.data[i]);
          }
      }
    });
    }, 1500);
   function addRults(db , message){
    let tx = db.transaction(['tb_event_result'], 'readwrite');
    let store = tx.objectStore('tb_event_result');
    store.add(message);
    tx.oncomplete = function() { 
    }
    tx.onerror = function(event) {
    }
  }
   setTimeout(function(){ 
      var toast_message = app.toast.create({text: 'Banco de dados offline criado com Sucesso!',closeTimeout: 2000,cssClass: 'success_toast'});
      toast_message.open();
      $("#sync_app" ).fadeOut(500, function() {
        $$('#sync_app').hide();
      }); 
      }, 1500); 
  }
}
function clearSaveEvent() {
  var message;
  var transaction = db.transaction(["tb_events"], "readwrite");
  transaction.oncomplete = function(event) {
    message = 1;
  };

  transaction.onerror = function(event) {
    message = 0;
  };

  var objectStore = transaction.objectStore("tb_events");
  var objectStoreRequest = objectStore.clear();

  objectStoreRequest.onsuccess = function(event) {
    return 'Success';
  };
  return 'Success';
};

function cleartb_events() {
  var message;
  var transaction = db.transaction(["tb_events"], "readwrite");
  transaction.oncomplete = function(event) {
    message = 1;
  };

  transaction.onerror = function(event) {
     message = 0;
  };
  var objectStore = transaction.objectStore("tb_events");
  var objectStoreRequest = objectStore.clear();

  objectStoreRequest.onsuccess = function(event) {
 
  };

  return 'Success';
};

function cleartb_events_group() {
  var message;
  var transaction = db.transaction(["tb_events_group"], "readwrite");
  transaction.oncomplete = function(event) {
    message = 1;
  };

  transaction.onerror = function(event) {
    message = 0;
  };
  var objectStore = transaction.objectStore("tb_events_group");
  var objectStoreRequest = objectStore.clear();
  objectStoreRequest.onsuccess = function(event) {
  }; 
};

function cleartb_forms() {
  var message;
  var transaction = db.transaction(["tb_form"], "readwrite");
  transaction.oncomplete = function(event) {
    message = 1;
  };

  transaction.onerror = function(event) {
    message = 0;
  };

  var objectStore = transaction.objectStore("tb_form");
  var objectStoreRequest = objectStore.clear();

  objectStoreRequest.onsuccess = function(event) {
  
  };

  
};

function cleartb_save_event() {
  var message;
  var transaction = db.transaction(["tb_save_event"], "readwrite");
  transaction.oncomplete = function(event) {
    message = 1;
  };

  transaction.onerror = function(event) {
    message = 0;
  };

  var objectStore = transaction.objectStore("tb_save_event");
  var objectStoreRequest = objectStore.clear();
  objectStoreRequest.onsuccess = function(event) {
  };
};

function cleartb_save_event_sig() {
  var message;
  var transaction = db.transaction(["tb_save_event_sig"], "readwrite");
  transaction.oncomplete = function(event) {
    message = 1;
  };

  transaction.onerror = function(event) {
    message = 0;
  };

  var objectStore = transaction.objectStore("tb_save_event_sig");
  var objectStoreRequest = objectStore.clear();
  objectStoreRequest.onsuccess = function(event) { 
  };

  
};

function cleartb_single() {
  var message;
  var transaction = db.transaction(["tb_single"], "readwrite");
  transaction.oncomplete = function(event) {
    message = 1;
  };

  transaction.onerror = function(event) {
    message = 0;
  };
  var objectStore = transaction.objectStore("tb_single");
  var objectStoreRequest = objectStore.clear();
  objectStoreRequest.onsuccess = function(event) {
  };

  
};

window.addEventListener('DOMContentLoaded', function() {
  var status = document.getElementById("status");
  function updateOnlineStatusL(event) {
    var condition = navigator.onLine ? "online" : "offline";
    setTimeout(function(){ 
        if(condition == 'offline'){
          $('#status_app').show();
          $('#status_app').html(condition.toUpperCase());
          window.localStorage.setItem('global_status', 0);
        } else {
          $('#status_app').hide();
          $('#status_app').html(condition.toUpperCase());
          window.localStorage.setItem('global_status', 1); 
        }
      }, 300);
  
  }
    window.addEventListener('online', function(event){
      sync_upload();
      updateOnlineStatusL();
      
    });

    window.addEventListener('offline', function(event){
      updateOnlineStatusL();
  });
});


function sync_upload(){
  $$('#sync_app').show();
  $$('#sync_app').html('<div style="" id="loadingDiv">Aguarde Atualizando Banco de Dados</div>');
  var request = window.indexedDB.open('AnyInspect_dnata', 3);
  var db;
  request.onsuccess = function (event) {
  db  = request.result;
  var AllDataProd = [];
  var AllSignature = [];
  var AllStatus = [];
  var AllComments = [];
  var user_info = Utils.userData();
  let IdUsuario = user_info.id;
        var objectStore = db.transaction("tb_save_event").objectStore("tb_save_event");
        objectStore.openCursor().onsuccess = function(event) {
          var cursor = event.target.result;
          if (cursor) {
            AllDataProd.push(cursor.value)
                cursor.continue();
          }
        };
        var objectStoresig = db.transaction("tb_save_event_sig").objectStore("tb_save_event_sig");
        objectStoresig.openCursor().onsuccess = function(event) {
          var cursorsig = event.target.result;
          if (cursorsig) {
            AllSignature.push(cursorsig.value)
            cursorsig.continue();
          }
        };
        
              
        var objectStoreStat = db.transaction("tb_single").objectStore("tb_single");
        objectStoreStat.openCursor().onsuccess = function(event) {
          var cursorstat = event.target.result;
          if (cursorstat) {
            AllStatus.push(cursorstat.value)
            cursorstat.continue();
          }
        };
        var objectStoreComment = db.transaction("tb_save_event_comment").objectStore("tb_save_event_comment");
        objectStoreComment.openCursor().onsuccess = function(event) {
          var cursorcomment = event.target.result;
          if (cursorcomment) {
            AllComments.push(cursorcomment.value)
            cursorcomment.continue();
          }
        };
      setTimeout(function(){ 
         // db.close();
          fetch(app_path+'/controller/sync_data_online', {
            method: 'POST',
            headers : new Headers(),
            body:JSON.stringify({alldata:AllDataProd,alldatasig:AllSignature,alldatastat:AllStatus,allcomment:AllComments,IdUsuario:IdUsuario})
            }).then((res) => res.json())
            .then((data) =>  {
              $$('#sync_app').hide();
                var status_txt = data.status_txt;
                var status = data.status;
                if(data.status){
                  if(status == 'SUCCESS'){
                      var toast_message = app.toast.create({text: status_txt ,closeTimeout: 2000,cssClass: 'success_toast'});
                      toast_message.open();
                  } 
                  cleartb_events();
                  cleartb_events();
                  cleartb_events_group();
                  cleartb_forms();
                  cleartb_save_event();
                  cleartb_save_event_sig();
                  cleartb_single();

                  setTimeout(function(){
                    sync_download();
                  } ,4000 )
                } else {
                    $("#sync_app").fadeOut(500, function() {
                    $$('#sync_app').hide();
                  }); 
                  
                }
             })
            .catch((err)=>console.log(err));
              
  } ,1500 )
    
  }
}


 
