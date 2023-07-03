<?php

include('../common/util.php'); 

$arr = array();
    $db = new db();
    /////////////////////// SERVICES TYPES CURRENT MONTH ////////////////////////////
    $db->query("SELECT tca.* , tl.lat as lat_local ,  tl.lon as long_local , tl.* , tca.id as id_ativo  , tca.foto as foto_ativo , tca.descricao as descricao_ativo , tl.descricao as descricao_local 
    FROM tb_clients_ativo tca
    LEFT JOIN tb_local tl ON tca.local = tl.id
    "); 

    $db->execute();
    $result = $db->resultset(); 
    $data = array();
    $total_ativos = 0;
    if($result){
        foreach($result as $row) {
            $lat_local = (float)$row["lat_local"];
            $long_local = (float)$row["long_local"];
            
            if($lat_local != '' && $long_local != ''){
                
                $id = $row["id"];
                $id_ativo = $row["id_ativo"];
                $foto_ativo = $row["foto_ativo"];
                $id_client = $row["id_client"]; 
                $descricao = $row["descricao"]; 
                $category = $row["category"];
                $register = $row["register"]; 
                $obs = $row["obs"];  
                $foto = $row["foto"]; 
                $qrcode = $row["qrcode"];
                $local = $row["local"]; 
                $validade = $row["validade"]; 
                $descricao_local = $row["descricao_local"]; 
                $descricao_ativo = $id_ativo.'-'.$row["descricao_ativo"].'['.$descricao_local.']'; 

                if ($foto_ativo != ""){
                    $foto_ativo = 'images/upload/ativos/'.$foto_ativo;
                 }else{
                    $foto_ativo = "assets/images/noimage.png" ;
                 } 

                //$lat_local = (float)$row["lat_local"];
                //$long_local = (float)$row["long_local"];
                $responsavel = $row["responsavel"]; 
                $cep = $row["cep"]; 
                $endereco = $row["endereco"]; 
                $cidade = $row["cidade"]; 
                $estado = $row["estado"]; 
                $bairro = $row["bairro"];
                $complemento = $row["complemento"];
                $numero = $row["numero"];

                $arr['list_ativos'][] = array(
                    "id"=>$id,
                    "id_client"=>$row['id_client'],
                    "descricao"=>$row['descricao'],
                    "category"=>$row['category'],
                    "register"=>$row['register'],
                    "obs"=>$row['obs'],
                    "foto"=>$row['foto'],
                    "qrcode"=>$row['qrcode'],
                    "local"=>$row['local'],
                    "validade"=>$row['validade'],
                    "lat_local"=>$lat_local,
                    "long_local"=>$long_local,
                    "responsavel"=>$row['responsavel'], 
                    "cep"=>$row['cep'], 
                    "endereco"=>$row['endereco'], 
                    "cidade"=>$row['cidade'], 
                    "estado"=>$row['estado'], 
                    "bairro"=>$row['bairro'], 
                    "complemento"=>$row['complemento'], 
                    "numero"=>$row['numero'],
                    "foto_ativo"=>$foto_ativo,
                    "descricao_ativo"=>$descricao_ativo,

                
                );
            }


           
            $total_ativos++;
          
           
        }

        $arr['status'] = "SUCCESS";
        $arr['total_ativos'] = $total_ativos;
		echo json_encode($arr);
		exit(0);
    
    }

        
        //$arr['list_ativos'] = $get_area_clients;

        echo json_encode($arr);

?>
