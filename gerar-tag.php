<?php 
//header('Content-Type: text/html; charset=utf-8');
include('includes/common/util.php'); 
require_once('includes/qr/qrlib.php');
         
?>


<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

ul li {
	list-style: none;
    float: left;	
}




</style>
<body>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 mb-5">
                    <div class="card transparent-card">

                    <?php 
                   
                    $db = new db(); 
                    $db->query('SELECT tcb.* , tcat.* , tcb.id as id_ativo from 
                    tb_clients_ativo tcb
                    LEFT JOIN tb_category  tcat ON tcb.category = tcat.id
                    ');

                    $db->execute();

                    $result = $db->resultset(); 
                    if($result){
                        $i = 0;
                        $response = array();
                        $output = "";
                        $output .= '<table style="width:100%">';
                        
                        $output .=  '<tbody>';
                        

                        foreach($result as $row) {

                            $category = $row['description'];
                            $model = $row['model'];
                            $register = $row['register'];
                            $descricao = $row['descricao'];
                            $id = $row['id'];
                            $id_ativo = $row['id_ativo'];
                            $qrcode = $row['qrcode'];
                            
                            
                            $qrCodeName = "imagem_qrcode_{$qrcode}.png";

                            QRcode::png($row['qrcode'], $qrCodeName, "L", 5, 5);

                            $output .= '<tr>';
                            $output .= '<th scope="row"><div style="float: left;border-right: 1px solid gray;">'. "<img  src='{$qrCodeName}'>".'</div>
                                        <div style="float:left;padding:10px;">
                                        <div style="float: left;width: 100%;margin-left: 0px;text-align: left;margin-bottom: 5px;" >Embarcação: '.$row['descricao'].'</div>
                                        <div style="float: left;width: 100%;margin-left: 0px;text-align: left;margin-bottom: 5px;" >Modelo: '.$row['model'].'</div>
                                        <div style="float: left;width: 100%;margin-left: 0px;text-align: left;margin-bottom: 5px;" >Nº de Série: '.$row['register'].'</div>
                                        <div style="float: left;width: 100%;margin-left: 0px;text-align: left;margin-bottom: 5px;margin-top: 30px;font-size: 20px;" >Tag Ativo:'.$qrcode.'</div>
                                        </div></th>';
                            $output .= '</tr>';
                                
                            $i++;
                            } 
                            
                            $output .= '</tbody>';
                            $output .= '</table>';
                        
                            echo $output;


                            exit(0);
                    } else { 
                            
                            $response['status'] = 'ERROR'; 
                            $response['status_txt'] = 'Nenhuma informacao disponivel'; 
                            //echo json_encode($response);
                            } 

                    ?>

                
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>

    <!--**********************************
        Main wrapper end
    ***********************************-->
