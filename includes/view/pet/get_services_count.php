<?php 
        include('../../common/util.php'); 
        $current_month = date('m');
        $current_day = date('d');
        $prev_month = $current_month - 1;
        $response = array();
        $db = new db();

 function get_area_clients(){
    $response = array();
    $db = new db();
    /////////////////////// SERVICES TYPES CURRENT MONTH ////////////////////////////
    $db->query("SELECT lat , lon
    FROM pet_client pc ORDER BY lat
    "); 

    $db->execute();
    $result = $db->resultset(); 
    $data = array();
    $total_servico_cur = 0;
    if($result){
        foreach($result as $row) {
            $lat = (float)$row["lat"];
            $lon = (float)$row["lon"];
           
           //$aux = array("lat" => $lat, "lon" => $lon);	
           $aux = array($lat, $lon);
           array_push($data, $aux);
           
        }
        
        
    
    }

    return $data;
 }

 

        // GET MONTH COMPARE 
 function get_month_compare(){
        $current_month = date('m');
        $current_day = date('d');
        $prev_month = $current_month - 1;
        $response = array();
        $db = new db();

        $chart_data = '';

        $data_currents = array();
        $data_prevs = array();
        $data_valor = array();

        $d1new = '0'; $d1old = '0'; $d2new = '0'; $d2old = '0'; $d3new = '0'; $d3old = '0'; $d4new = '0'; $d4old = '0'; $d5new = '0'; $d5old = '0'; $d6new = '0';
        $d6old = '0'; $d7new = '0'; $d7old = '0'; $d8new = '0'; $d8old = '0'; $d9new = '0'; $d9old = '0'; $d10new = '0'; $d10old = '0'; $d11new = '0';
        $d11old = '0'; $d12new = '0'; $d12old = '0'; $d13new = '0'; $d13old = '0'; $d14new = '0'; $d14old = '0'; $d15new = '0'; $d15old = '0';
        $d16new = '0'; $d16old = '0'; $d17new = '0'; $d17old = '0'; $d18new = '0'; $d18old = '0'; $d19new = '0'; $d19old = '0'; $d20new = '0';
        $d20old = '0'; $d21new = '0'; $d21old = '0'; $d22new = '0'; $d22old = '0'; $d23new = '0'; $d23old = '0'; $d24new = '0'; $d24old = '0';
        $d25new = '0'; $d25old = '0'; $d26new = '0'; $d26old = '0'; $d27new = '0'; $d27old = '0'; $d28new = '0'; $d28old = '0'; $d29new = '0';
        $d29old = '0'; $d30new = '0'; $d30old = '0'; $d31new = '0'; $d31old = '0';
        
        $db->query("SELECT DAY(start_date) AS day_ , MONTH(start_date) as month_ , YEAR(start_date) as year_ ,  COUNT(*) as total
        FROM pet_booking 
        WHERE ( (MONTH(start_date) = ".$current_month." OR MONTH(start_date) = ".$prev_month.") AND YEAR(start_date) = 2020)  
        GROUP BY MONTH(start_date) , DAY(start_date) ORDER BY DAY(start_date)
        "); 

         $db->execute();
         $result = $db->resultset(); 
         $data = array();
         $total_servico_cur = 0;
         if($result){
             foreach($result as $row) {
                $total_current = $row["total"];
                $total_prev = $row["total"];

                $day_ = $row["day_"];
            $month_ = $row["month_"];
            $year_ = $row["year_"];

            if($month_ == $current_month){
                if($day_ == 1){
                    $d1new = $total_current;
                }
                if($day_ == 2){
                    $d2new = $total_current;
                    //echo 'aqui 1'.$total_current;
                }
                if($day_ == 3){
                    $d3new = $total_current;
                }
                if($day_ == 4){
                    $d4new = $total_current;
                }
                if($day_ == 5){
                    $d5new = $total_current;
                }
                if($day_ == 6){
                    $d6new = $total_current;
                }
                if($day_ == 7){
                    $d7new = $total_current;
                }
                if($day_ == 8){
                    $d8new = $total_current;
                }
                if($day_ == 9){
                    $d10new = $total_current;
                }
                if($day_ == 10){
                    $d11new = $total_current;
                }
                if($day_ == 11){
                    $d12new = $total_current;
                }
                if($day_ == 12){
                    $d13new = $total_current;
                }
                if($day_ == 13){
                    $d14new = $total_current;
                }
                if($day_ == 14){
                    $d15new = $total_current;
                }
                if($day_ == 15){
                    $d16new = $total_current;
                }
                if($day_ == 16){
                    $d16new = $total_current;
                }
                if($day_ == 17){
                    $d17new = $total_current;
                }
                if($day_ == 18){
                    $d18new = $total_current;
                }
                if($day_ == 19){
                    $d19new = $total_current;
                }
                if($day_ == 20){
                    $d20new = $total_current;
                }
                if($day_ == 21){
                    $d21new = $total_current;
                }
                if($day_ == 22){
                    $d22new = $total_current;
                }
                if($day_ == 23){
                    $d23new = $total_current;
                }
                if($day_ == 24){
                    $d24new = $total_current;
                }
                if($day_ == 25){
                    $d25new = $total_current;
                }
                if($day_ == 26){
                    $d26new = $total_current;
                }
                if($day_ == 27){
                    $d27new = $total_current;
                }
                if($day_ == 28){
                    $d28new = $total_current;
                }
                if($day_ == 29){
                    $d29new = $total_current;
                }
                if($day_ == 30){
                    $d30new = $total_current;
                }
                if($day_ == 31){
                    $d31new = $total_current;
                }
            
            
            
            } else{

     
                if($day_ == 1){
                    $d1old = $total_prev;
                }
                if($day_ == 2){
                    $d2old = $total_prev;
                }
                if($day_ == 3){
                    $d3old = $total_prev;
                }
                if($day_ == 4){
                    $d4old = $total_prev;
                }
                if($day_ == 5){
                    $d5old = $total_prev;
                }
                if($day_ == 6){
                    $d6old = $total_prev;
                }
                if($day_ == 7){
                    $d7old = $total_prev;
                }
                if($day_ == 8){
                    $d8old = $total_prev;
                }
                if($day_ == 9){
                    $d9old = $total_prev;
                }
                if($day_ == 10){
                    $d10old = $total_prev;
                }
                if($day_ == 11){
                    $d11old = $total_prev;
                }
                if($day_ == 12){
                    $d12old = $total_prev;
                }
                if($day_ == 13){
                    $d13old = $total_prev;
                }
                if($day_ == 14){
                    $d14old = $total_prev;
                }
                if($day_ == 15){
                    $d15old = $total_prev;
                }
                if($day_ == 16){
                    $d16old = $total_prev;
                }
                if($day_ == 17){
                    $d17old = $total_prev;
                }
                if($day_ == 18){
                    $d18old = $total_prev;
                }
                if($day_ == 19){
                    $d19old = $total_prev;
                }
                if($day_ == 20){
                    $d20old = $total_prev;
                }
                if($day_ == 21){
                    $d21old = $total_prev;
                }
                if($day_ == 22){
                    $d22old = $total_prev;
                }
                if($day_ == 23){
                    $d23old = $total_prev;
                }
                if($day_ == 24){
                    $d24old = $total_prev;
                }
                if($day_ == 25){
                    $d25old = $total_prev;
                }
                if($day_ == 26){
                    $d26old = $total_prev;
                }
                if($day_ == 27){
                    $d27old = $total_prev;
                }
                if($day_ == 28){
                    $d28old = $total_prev;
                }
                if($day_ == 29){
                    $d29old = $total_prev;
                }
                if($day_ == 30){
                    $d30old = $total_prev;
                }
                if($day_ == 31){
                    $d31old = $total_prev;
                }
            
            
            }


             }
         
             
            array_push($data_currents, round($d1new, 0));
            array_push($data_currents, round($d2new, 0));
            array_push($data_currents, round($d3new, 0));
            array_push($data_currents, round($d4new, 0));
            array_push($data_currents, round($d5new, 0));
            array_push($data_currents, round($d6new, 0));
            array_push($data_currents, round($d7new, 0));
            array_push($data_currents, round($d8new, 0));
            array_push($data_currents, round($d9new, 0));
            array_push($data_currents, round($d10new, 0));
            array_push($data_currents, round($d11new, 0));
            array_push($data_currents, round($d12new, 0));
            array_push($data_currents, round($d13new, 0));
            array_push($data_currents, round($d14new, 0));
            array_push($data_currents, round($d15new, 0));
            array_push($data_currents, round($d16new, 0));
            array_push($data_currents, round($d17new, 0));
            array_push($data_currents, round($d18new, 0));
            array_push($data_currents, round($d19new, 0));
            array_push($data_currents, round($d20new, 0));
            array_push($data_currents, round($d21new, 0));
            array_push($data_currents, round($d22new, 0));
            array_push($data_currents, round($d23new, 0));
            array_push($data_currents, round($d24new, 0));
            array_push($data_currents, round($d25new, 0));
            array_push($data_currents, round($d26new, 0));
            array_push($data_currents, round($d27new, 0));
            array_push($data_currents, round($d28new, 0));
            array_push($data_currents, round($d29new, 0));
            array_push($data_currents, round($d30new, 0));
            array_push($data_currents, round($d31new, 0));
           
            
            array_push($data_prevs, round($d1old, 0));
            array_push($data_prevs, round($d2old, 0));
            array_push($data_prevs, round($d3old, 0));
            array_push($data_prevs, round($d4old, 0));
            array_push($data_prevs, round($d5old, 0));
            array_push($data_prevs, round($d6old, 0));
            array_push($data_prevs, round($d7old, 0));
            array_push($data_prevs, round($d8old, 0));
            array_push($data_prevs, round($d9old, 0));
            array_push($data_prevs, round($d10old, 0));
            array_push($data_prevs, round($d11old, 0));
            array_push($data_prevs, round($d12old, 0));
            array_push($data_prevs, round($d13old, 0));
            array_push($data_prevs, round($d14old, 0));
            array_push($data_prevs, round($d15old, 0));
            array_push($data_prevs, round($d16old, 0));
            array_push($data_prevs, round($d17old, 0));
            array_push($data_prevs, round($d18old, 0));
            array_push($data_prevs, round($d19old, 0));
            array_push($data_prevs, round($d20old, 0));
            array_push($data_prevs, round($d21old, 0));
            array_push($data_prevs, round($d22old, 0));
            array_push($data_prevs, round($d23old, 0));
            array_push($data_prevs, round($d24old, 0));
            array_push($data_prevs, round($d25old, 0));
            array_push($data_prevs, round($d26old, 0));
            array_push($data_prevs, round($d27old, 0));
            array_push($data_prevs, round($d28old, 0));
            array_push($data_prevs, round($d29old, 0));
            array_push($data_prevs, round($d30old, 0));
            
         
         }

      
         $response['data_currents'] = $data_currents;
         $response['data_prevs'] = $data_prevs;

         return $response;


    }

    
         /////////////////////// SERVICES TYPES CURRENT MONTH ////////////////////////////
         $db->query("SELECT count(pb.id) total_service , MONTH(pb.start_date) AS month_ , ps.short_dec
         FROM pet_booking pb
         LEFT JOIN pet_book_detail pbd  ON pb.id = pbd.id 
         LEFT JOIN pet_services ps ON ps.id = pbd.service_name
         WHERE ( (MONTH(pb.start_date) = ".$current_month." ) AND YEAR(pb.start_date) = 2020)
         GROUP BY ps.id
         "); 

         $db->execute();
         $result = $db->resultset(); 
         $data = array();
         $total_servico_cur = 0;
         if($result){
             foreach($result as $row) {
                 $total_service = $row["total_service"];
                 $short_dec = $row["short_dec"];
                 $month_ = get_nome_mes($row["month_"]);

                 $total_servico_cur +=  $total_service ;

                 if($short_dec == ''){
                    $short_dec = 'Não Informado';
                 }

                $aux = array("name" => $short_dec, "y" => (int)$total_service);	
	            array_push($data, $aux);
                
             }
             
             $response['total_servico_cur'] = $total_servico_cur;
         
         }

         //////////////////// SERVICES TYPES PREVIEW MONTH //////////////////////////
         $db->query("SELECT count(pb.id) total_service , MONTH(pb.start_date) AS month_ , ps.short_dec
         FROM pet_booking pb
         LEFT JOIN pet_book_detail pbd  ON pb.id = pbd.id 
         LEFT JOIN pet_services ps ON ps.id = pbd.service_name
         WHERE ( (MONTH(pb.start_date) = ".$prev_month." ) AND YEAR(pb.start_date) = 2020)
         GROUP BY ps.id
         "); 

         $db->execute();
         $result = $db->resultset(); 
         $dataprev = array();
         $total_servico_prev = 0;
         if($result){
             foreach($result as $row) {
                 $total_service = $row["total_service"];
                 $short_dec = $row["short_dec"];
                 $month_ = get_nome_mes($row["month_"]);
                 $total_servico_prev +=  $total_service ;
                 if($short_dec == ''){
                    $short_dec = 'Não Informado';
                 }

                $aux = array("name" => $short_dec, "y" => (int)$total_service);	
	            array_push($dataprev, $aux);
                
             }
             $response['total_servico_prev'] = $total_servico_prev;
         }

     // GET PRICE PRODUCTS
     function get_list_prod_sum_current(){
        $current_month = date('m');
        $current_day = date('d');
        $prev_month = $current_month - 1;
        $db = new db();
        $db->query("SELECT count(pb.id) total_service , SUM(pbd.price) as total_gasto ,  MONTH(pb.start_date) AS month_ , ps.short_dec , pbd.service_name
        FROM pet_booking pb
        LEFT JOIN pet_book_detail pbd  ON pb.id = pbd.id 
        LEFT JOIN pet_services ps ON ps.id = pbd.service_name
        WHERE ( (MONTH(pb.start_date) = ".$current_month." ) AND YEAR(pb.start_date) = 2020)
        GROUP BY ps.id "); 


        $db->execute();
        $result = $db->resultset();
        if($result){
            foreach($result as $row) {
                $total_service = $row["total_service"];
                $short_dec = $row["short_dec"];
                $month_ = get_nome_mes($row["month_"]);
                $service_name = $row["service_name"];

                if($short_dec == ''){
                    $short_dec = 'Não Informado';
                }
                $list_prod[] = get_prod_price($service_name,$total_service);
            }

            $out_uni = array();
            $sumArray = array();
            $datacur_prod = array();
            $id_ = "";
            $desc_ = "";
            $value_ = "";
            $type_ = "";
            $valor_total_prod_mes_atual = 0;


            foreach($list_prod as $key => $item){
                foreach($item as $detail){
                    $id_ = $detail['id'];
                    $desc_ = $detail['desc'];
                    $value_ = $detail['value'];
                    $type_ = $detail['type'];
                    $valor_total_prod_mes_atual += $value_;
                    $aux = array("name" => $desc_, "y" => (int)$value_);	
                    array_push($datacur_prod, $aux);
                }
                }
            }

            $response['datacur_prod'] = $datacur_prod;
            $response['valor_total_prod_mes_atual'] = $valor_total_prod_mes_atual;

            return $response;
        }

        

        function get_list_prod_sum_prev(){
            $dataprev_prod = array();

            $current_month = date('m');
            $current_day = date('d');
            $prev_month = $current_month - 1;
            $db = new db();
            $db->query("SELECT count(pb.id) total_service , SUM(pbd.price) as total_gasto ,  MONTH(pb.start_date) AS month_ , ps.short_dec , pbd.service_name
            FROM pet_booking pb
            LEFT JOIN pet_book_detail pbd  ON pb.id = pbd.id 
            LEFT JOIN pet_services ps ON ps.id = pbd.service_name
            WHERE ( (MONTH(pb.start_date) = ".$prev_month." ) AND YEAR(pb.start_date) = 2020)
            GROUP BY ps.id "); 

            echo "SELECT count(pb.id) total_service , SUM(pbd.price) as total_gasto ,  MONTH(pb.start_date) AS month_ , ps.short_dec , pbd.service_name
            FROM pet_booking pb
            LEFT JOIN pet_book_detail pbd  ON pb.id = pbd.id 
            LEFT JOIN pet_services ps ON ps.id = pbd.service_name
            WHERE ( (MONTH(pb.start_date) = ".$prev_month." ) AND YEAR(pb.start_date) = 2020)
            GROUP BY ps.id ";
    
    
            $db->execute();
            $result = $db->resultset();
            $id_ = "";
            $desc_ = "";
            $value_ = "";
            $type_ = "";
            $valor_total_prod_mes_prev = 0;
            $out_uni = array();
            $sumArray = array();
            $dataprev_prod = array();
            //$list_prod = array(); 
            if($result){
                foreach($result as $row) {
                    $total_service = $row["total_service"];
                    $short_dec = $row["short_dec"];
                    $month_ = get_nome_mes($row["month_"]);
                    $service_name = $row["service_name"];
    
                    if($short_dec == ''){
                        $short_dec = 'Não Informado';
                    }
                    $list_prod[] = get_prod_price($service_name,$total_service);
                }
    
    
                foreach($list_prod as $key => $item){
                    foreach($item as $detail){
                        $id_ = $detail['id'];
                        $desc_ = $detail['desc'];
                        $value_ = $detail['value'];
                        $type_ = $detail['type'];
                        $valor_total_prod_mes_prev += $value_;
                        $aux = array("name" => $desc_, "y" => (int)$value_);	
                        array_push($dataprev_prod, $aux);
                    }
                    }
                }
                
                $response['dataprev_prod'] = $dataprev_prod;
                $response['valor_total_prod_mes_prev'] = $valor_total_prod_mes_prev;
    
                return $response;
            }


       
        function get_prod_price($id,$total_service){
            $my_prices = 0;
            $i = 0;
            $db = new db();
            $db->query("SELECT id_products FROM pet_services WHERE id = $id "); 
            $result = $db->single(); 
                    
            if($result){
                $id_products =  $result['id_products'];
                if($id_products){
                    $my_ids = explode("-",$id_products);
                    foreach($my_ids as $row) {
                        $final_prod[] = get_value_prod($row,$total_service);
                        $i++;
                    }
                }
                
                return $final_prod;
            }
        }



        function get_value_prod($id,$total_service){
            $db = new db();
            $db->query("SELECT pp.id , pp.desc , pp.value , pp.type  FROM pet_product pp WHERE id = $id "); 
            
            $result = $db->single(); 
            if($result){
                $out['id'] = $result['id'];
                $out['desc'] = $result['desc'];
                $out['value'] = $result['value'];
                $out['type'] = $result['type'];
                $out['total_service'] = $total_service;
                return $out;
            }
        }

        function get_semanal(){
            $db = new db(); 
            if(isset($_POST['id'])){ $id = $_POST['id'];} else {$id = '';}
            $db->query("SELECT count(ps.id) AS total_ , pbd.price as soma_,
                    YEAR(pb.start_date) AS yr, MONTH(pb.start_date) AS m, DAYNAME(pb.start_date) as dia_semana , 
                    ps.id as id_servico,  pb.status , pb.id_client , pbd.started_at , pbd.ended_at 
                    FROM pet_booking pb
                    LEFT JOIN pet_book_detail pbd ON pbd.id_booking = pb.id 
                    LEFT JOIN pet_client pc ON pb.id_client = pc.id 
                    LEFT JOIN pet_clients_pet pcp ON pcp.id_client = pc.id 
                    LEFT JOIN pet_services ps ON ps.id = pbd.service_name 
                     group by DAYNAME(pb.start_date) , MONTH(pb.start_date) ORDER BY MONTH(pb.start_date) "); 
           
            $db->execute();
            $result = $db->resultset(); 	
            
                   
            if($result){
    
                $i = 0;
                $response = array();
    
                $jan_seg = array(0, 0, 0);
                $jan_ter = array(0, 1, 0);
                $jan_qua = array(0, 2, 0);
                $jan_qui = array(0, 3, 0);
                $jan_sex = array(0, 4, 0);
                $jan_sab = array(0, 5, 0);
                $jan_dom = array(0, 6, 0);
                
                $fev_seg = array(1, 0, 0);
                $fev_ter = array(1, 1, 0);
                $fev_qua = array(1, 2, 0);
                $fev_qui = array(1, 3, 0);
                $fev_sex = array(1, 4, 0);
                $fev_sab = array(1, 5, 0);
                $fev_dom = array(1, 6, 0);
                
                $mar_seg = array(2, 0, 0);
                $mar_ter = array(2, 1, 0);
                $mar_qua = array(2, 2, 0);
                $mar_qui = array(2, 3, 0);
                $mar_sex = array(2, 4, 0);
                $mar_sab = array(2, 5, 0);
                $mar_dom = array(2, 6, 0);
                
                $abr_seg = array(3, 0, 0);
                $abr_ter = array(3, 1, 0);
                $abr_qua = array(3, 2, 0);
                $abr_qui = array(3, 3, 0);
                $abr_sex = array(3, 4, 0);
                $abr_sab = array(3, 5, 0);
                $abr_dom = array(3, 6, 0);
                
                $mai_seg = array(4, 0, 0);
                $mai_ter = array(4, 1, 0);
                $mai_qua = array(4, 2, 0);
                $mai_qui = array(4, 3, 0);
                $mai_sex = array(4, 4, 0);
                $mai_sab = array(4, 5, 0);
                $mai_dom = array(4, 6, 0);
                
                $jun_seg = array(5, 0, 0);
                $jun_ter = array(5, 1, 0);
                $jun_qua = array(5, 2, 0);
                $jun_qui = array(5, 3, 0);
                $jun_sex = array(5, 4, 0);
                $jun_sab = array(5, 5, 0);
                $jun_dom = array(5, 6, 0);
                
                $jul_seg = array(6, 0, 0);
                $jul_ter = array(6, 1, 0);
                $jul_qua = array(6, 2, 0);
                $jul_qui = array(6, 3, 0);
                $jul_sex = array(6, 4, 0);
                $jul_sab = array(6, 5, 0);
                $jul_dom = array(6, 6, 0);
                
                $ago_seg = array(7, 0, 0);
                $ago_ter = array(7, 1, 0);
                $ago_qua = array(7, 2, 0);
                $ago_qui = array(7, 3, 0);
                $ago_sex = array(7, 4, 0);
                $ago_sab = array(7, 5, 0);
                $ago_dom = array(7, 6, 0);
                
                $set_seg = array(8, 0, 0);
                $set_ter = array(8, 1, 0);
                $set_qua = array(8, 2, 0);
                $set_qui = array(8, 3, 0);
                $set_sex = array(8, 4, 0);
                $set_sab = array(8, 5, 0);
                $set_dom = array(8, 6, 0);
                
                $out_seg = array(9, 0, 0);
                $out_ter = array(9, 1, 0);
                $out_qua = array(9, 2, 0);
                $out_qui = array(9, 3, 0);
                $out_sex = array(9, 4, 0);
                $out_sab = array(9, 5, 0);
                $out_dom = array(9, 6, 0);
                
                $nov_seg = array(10, 0, 0);
                $nov_ter = array(10, 1, 0);
                $nov_qua = array(10, 2, 0);
                $nov_qui = array(10, 3, 0);
                $nov_sex = array(10, 4, 0);
                $nov_sab = array(10, 5, 0);
                $nov_dom = array(10, 6, 0);
                
                $dez_seg = array(11, 0, 0);
                $dez_ter = array(11, 1, 0);
                $dez_qua = array(11, 2, 0);
                $dez_qui = array(11, 3, 0);
                $dez_sex = array(11, 4, 0);
                $dez_sab = array(11, 5, 0);
                $dez_dom = array(11, 6, 0);
    
                
                foreach($result as $row) {
    
                    $yr = $row['yr'];
                    $m = $row['m'];
                    $total_ = $row['total_'];
                    $soma_ = $row['soma_'];
                    $dia_semana = $row['dia_semana'];
    
                    if($m == 1){
                        $dum_jan = $total_;
                        $dum_jan_val = $soma_;
                        if($dia_semana == 'Monday'){
                            $jan_seg = array();
                            array_push($jan_seg, 0, 0, $dum_jan);
                        } else if($dia_semana == 'Tuesday'){
                            $jan_ter = array();
                            array_push($jan_ter, 0, 1, $dum_jan);
                        } else if($dia_semana == 'Wednesday'){
                            $jan_qua = array();
                            array_push($jan_qua, 0, 2, $dum_jan);
                        } else if($dia_semana == 'Thursday'){
                            $jan_qui = array();
                            array_push($jan_qui, 0, 3, $dum_jan);
                        } else if($dia_semana == 'Friday'){
                            $jan_sex = array();
                            array_push($jan_sex, 0, 4, $dum_jan);
                        } else if($dia_semana == 'Saturday'){
                            $jan_sab = array();
                            array_push($jan_sab, 0, 5, $dum_jan);
                        } else if($dia_semana == 'Sunday'){
                            $jan_dom = array();
                            array_push($jan_dom, 0, 6, $dum_jan);
                        }
    
                    
                    } else if($m == 2){
                        $dum_fev = $total_;
                        $dum_jan_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $fev_seg = array();
                            array_push($fev_seg, 1, 0, $dum_fev);
                        } else if($dia_semana == 'Tuesday'){
                            $fev_ter = array();
                            array_push($fev_ter, 1, 1, round($dum_fev, 0));
                        } else if($dia_semana == 'Wednesday'){
                            $fev_qua = array();
                            array_push($fev_qua, 1, 2, $dum_fev);
                        } else if($dia_semana == 'Thursday'){
                            $fev_qui = array();
                            array_push($fev_qui, 1, 3, $dum_fev);
                        } else if($dia_semana == 'Friday'){
                            $fev_sex = array();
                            array_push($fev_sex, 1, 4, $dum_fev);
                        } else if($dia_semana == 'Saturday'){
                            $fev_sab = array();
                            array_push($fev_sab, 1, 5, $dum_fev);
                        } else if($dia_semana == 'Sunday'){
                            $fev_dom = array();
                            array_push($fev_dom, 1, 6, $dum_fev);
                        }
    
                    } else if($m == 3){
                        $dum_mar = $total_;
                        $dum_mar_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $mar_seg = array();
                            array_push($mar_seg, 2, 0, $dum_mar);
                        } else if($dia_semana == 'Tuesday'){
                            $mar_ter = array();
                            array_push($mar_ter, 2, 1, $dum_mar);
                        } else if($dia_semana == 'Wednesday'){
                            $mar_qua = array();
                            array_push($mar_qua, 2, 2, $dum_mar);
                        } else if($dia_semana == 'Thursday'){
                            $mar_qui = array();
                            array_push($mar_qui, 2, 3, $dum_mar);
                        } else if($dia_semana == 'Friday'){
                            $mar_sex = array();
                            array_push($mar_sex, 2, 4, $dum_mar);
                        } else if($dia_semana == 'Saturday'){
                            $mar_sab = array();
                            array_push($mar_sab, 2, 5, $dum_mar);
                        } else if($dia_semana == 'Sunday'){
                            $mar_dom = array();
                            array_push($mar_dom, 2, 6, $dum_mar);
                        }
    
                    } else if($m == 4){
                        $dum_abr = $total_;
                        $dum_abr_val = $soma_;
                        if($dia_semana == 'Monday'){
                            $abr_seg = array();
                            array_push($abr_seg, 3, 0, $dum_abr);
                        } else if($dia_semana == 'Tuesday'){
                            $abr_ter = array();
                            array_push($abr_ter, 3, 1, $dum_abr);
                        } else if($dia_semana == 'Wednesday'){
                            $abr_qua = array();
                            array_push($abr_qua, 3, 2, $dum_abr);
                        } else if($dia_semana == 'Thursday'){
                            $abr_qui = array();
                            array_push($abr_qui, 3, 3, $dum_abr);
                        } else if($dia_semana == 'Friday'){
                            $abr_sex = array();
                            array_push($abr_sex, 3, 4, $dum_abr);
                        } else if($dia_semana == 'Saturday'){
                            $abr_sab = array();
                            array_push($abr_sab, 3, 5, $dum_abr);
                        } else if($dia_semana == 'Sunday'){
                            $abr_dom = array();
                            array_push($abr_dom, 3, 6, $dum_abr);
                        }
    
                    } else if($m == 5){
                        $dum_mai = $total_;
                        $dum_mai_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $mai_seg = array();
                            array_push($mai_seg, 4, 0, $dum_mai);
                        } else if($dia_semana == 'Tuesday'){
                            $mai_ter = array();
                            array_push($mai_ter, 4, 1, $dum_mai);
                        } else if($dia_semana == 'Wednesday'){
                            $mai_qua = array();
                            array_push($mai_qua, 4, 2, $dum_mai);
                        } else if($dia_semana == 'Thursday'){
                            $mai_qui = array();
                            array_push($mai_qui, 4, 3, $dum_mai);
                        } else if($dia_semana == 'Friday'){
                            $mai_sex = array();
                            array_push($mai_sex, 4, 4, $dum_mai);
                        } else if($dia_semana == 'Saturday'){
                            $mai_sab = array();
                            array_push($mai_sab, 4, 5, $dum_mai);
                        } else if($dia_semana == 'Sunday'){
                            $mai_dom = array();
                            array_push($mai_dom, 4, 6, $dum_mai);
                        }
    
                    } else if($m == 6){
                        $dum_jun = $total_;
                        $dum_jun_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $jun_seg = array();
                            array_push($jun_seg, 5, 0, $dum_jun);
                        } else if($dia_semana == 'Tuesday'){
                            $jun_ter = array();
                            array_push($jun_ter, 5, 1, $dum_jun);
                        } else if($dia_semana == 'Wednesday'){
                            $jun_qua = array();
                            array_push($jun_qua, 5, 2, $dum_jun);
                        } else if($dia_semana == 'Thursday'){
                            $jun_qui = array();
                            array_push($jun_qui, 5, 3, $dum_jun);
                        } else if($dia_semana == 'Friday'){
                            $jun_sex = array();
                            array_push($jun_sex, 5, 4, $dum_jun);
                        } else if($dia_semana == 'Saturday'){
                            $jun_sab = array();
                            array_push($jun_sab, 5, 5, $dum_jun);
                        } else if($dia_semana == 'Sunday'){
                            $jun_dom = array();
                            array_push($jun_dom, 5, 6, $dum_jun);
                        }
    
                    } else if($m == 7){
                        $dum_jul = $total_;
                        $dum_jul_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $jul_seg = array();
                            array_push($jul_seg, 6, 0, $dum_jul);
                        } else if($dia_semana == 'Tuesday'){
                            $jul_ter = array();
                            array_push($jul_ter, 6, 1, $dum_jul);
                        } else if($dia_semana == 'Wednesday'){
                            $jul_qua = array();
                            array_push($jul_qua, 6, 2, $dum_jul);
                        } else if($dia_semana == 'Thursday'){
                            $jul_qui = array();
                            array_push($jul_qui, 6, 3, $dum_jul);
                        } else if($dia_semana == 'Friday'){
                            $jul_sex = array();
                            array_push($jul_sex, 6, 4, $dum_jul);
                        } else if($dia_semana == 'Saturday'){
                            $jul_sab = array();
                            array_push($jul_sab, 6, 5, $dum_jul);
                        } else if($dia_semana == 'Sunday'){
                            $jul_dom = array();
                            array_push($jul_dom, 6, 6, $dum_jul);
                        }
    
                    } else if($m == 8){
                        $dum_ago = $total_;
                        $dum_ago_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $ago_seg = array();
                            array_push($ago_seg, 7, 0, $dum_ago);
                        } else if($dia_semana == 'Tuesday'){
                            $ago_ter = array();
                            array_push($ago_ter, 7, 1, $dum_ago);
                        } else if($dia_semana == 'Wednesday'){
                            $ago_qua = array();
                            array_push($ago_qua, 7, 2, $dum_ago);
                        } else if($dia_semana == 'Thursday'){
                            $ago_qui = array();
                            array_push($ago_qui, 7, 3, $dum_ago);
                        } else if($dia_semana == 'Friday'){
                            $ago_sex = array();
                            array_push($ago_sex, 7, 4, $dum_ago);
                        } else if($dia_semana == 'Saturday'){
                            $ago_sab = array();
                            array_push($ago_sab, 7, 5, $dum_ago);
                        } else if($dia_semana == 'Sunday'){
                            $ago_dom = array();
                            array_push($ago_dom, 6, 6, $dum_ago);
                        }
    
                    } else if($m == 9){
                        $dum_set = $total_;
                        $dum_set_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $set_seg = array();
                            array_push($set_seg, 7, 0, $dum_set);
                        } else if($dia_semana == 'Tuesday'){
                            $set_ter = array();
                            array_push($set_ter, 7, 1, $dum_set);
                        } else if($dia_semana == 'Wednesday'){
                            $set_qua = array();
                            array_push($set_qua, 7, 2, $dum_set);
                        } else if($dia_semana == 'Thursday'){
                            $set_qui = array();
                            array_push($set_qui, 7, 3, $dum_set);
                        } else if($dia_semana == 'Friday'){
                            $set_sex = array();
                            array_push($set_sex, 7, 4, $dum_set);
                        } else if($dia_semana == 'Saturday'){
                            $set_sab = array();
                            array_push($set_sab, 7, 5, $dum_set);
                        } else if($dia_semana == 'Sunday'){
                            $set_dom = array();
                            array_push($set_dom, 6, 6, $dum_set);
                        }
    
                    } else if($m == 10){
                        $dum_out = $total_;
                        $dum_out_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $out_seg = array();
                            array_push($out_seg, 8, 0, $dum_out);
                        } else if($dia_semana == 'Tuesday'){
                            $out_ter = array();
                            array_push($out_ter, 8, 1, $dum_out);
                        } else if($dia_semana == 'Wednesday'){
                            $out_qua = array();
                            array_push($out_qua, 8, 2, $dum_out);
                        } else if($dia_semana == 'Thursday'){
                            $out_qui = array();
                            array_push($out_qui, 8, 3, $dum_out);
                        } else if($dia_semana == 'Friday'){
                            $out_sex = array();
                            array_push($out_sex, 8, 4, $dum_out);
                        } else if($dia_semana == 'Saturday'){
                            $out_sab = array();
                            array_push($out_sab, 8, 5, $dum_out);
                        } else if($dia_semana == 'Sunday'){
                            $out_dom = array();
                            array_push($out_dom, 8, 6, $dum_out);
                        }
    
                    } else if($m == 11){
                        $dum_nov = $total_;
                        $dum_nov_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $nov_seg = array();
                            array_push($nov_seg, 9, 0, $dum_nov);
                        } else if($dia_semana == 'Tuesday'){
                            $nov_ter = array();
                            array_push($nov_ter, 9, 1, $dum_nov);
                        } else if($dia_semana == 'Wednesday'){
                            $nov_qua = array();
                            array_push($nov_qua, 9, 2, $dum_nov);
                        } else if($dia_semana == 'Thursday'){
                            $nov_qui = array();
                            array_push($nov_qui, 9, 3, $dum_nov);
                        } else if($dia_semana == 'Friday'){
                            $nov_sex = array();
                            array_push($nov_sex, 9, 4, $dum_nov);
                        } else if($dia_semana == 'Saturday'){
                            $nov_sab = array();
                            array_push($nov_sab, 9, 5, $dum_nov);
                        } else if($dia_semana == 'Sunday'){
                            $nov_dom = array();
                            array_push($nov_dom, 9, 6, $dum_nov);
                        }
    
                    } else if($m == 12){
                        $dum_dez = $total_;
                        $dum_dez_val = $soma_;
    
                        if($dia_semana == 'Monday'){
                            $dez_seg = array();
                            array_push($dez_seg, 10, 0, $dum_nov);
                        } else if($dia_semana == 'Tuesday'){
                            $dez_ter = array();
                            array_push($dez_ter, 10, 1, $dum_nov);
                        } else if($dia_semana == 'Wednesday'){
                            $dez_qua = array();
                            array_push($dez_qua, 10, 2, $dum_nov);
                        } else if($dia_semana == 'Thursday'){
                            $dez_qui = array();
                            array_push($dez_qui, 10, 3, $dum_nov);
                        } else if($dia_semana == 'Friday'){
                            $dez_sex = array();
                            array_push($dez_sex, 10, 4, $dum_nov);
                        } else if($dia_semana == 'Saturday'){
                            $dez_sab = array();
                            array_push($dez_sab, 10, 5, $dum_nov);
                        } else if($dia_semana == 'Sunday'){
                            $dez_dom = array();
                            array_push($dez_dom, 10, 6, $dum_nov);
                        }
                    }
    
                    
                    //$graph_array[] = [$state,$month,$data['value']];
                
                
                }
            }
    
    
            $arr[] = $jan_seg;
            $arr[] = $jan_ter;
            $arr[] = $jan_qua;
            $arr[] = $jan_qui;
            $arr[] = $jan_sex;
            $arr[] = $jan_sab;
            $arr[] = $jan_dom;
            
            $arr[] = $fev_seg;
            $arr[] = $fev_ter;
            $arr[] = $fev_qua;
            $arr[] = $fev_qui;
            $arr[] = $fev_sex;
            $arr[] = $fev_sab;
            $arr[] = $fev_dom;
            
            $arr[] = $mar_seg;
            $arr[] = $mar_ter;
            $arr[] = $mar_qua;
            $arr[] = $mar_qui;
            $arr[] = $mar_sex;
            $arr[] = $mar_sab;
            $arr[] = $mar_dom;
            
            $arr[] = $abr_seg;
            $arr[] = $abr_ter;
            $arr[] = $abr_qua;
            $arr[] = $abr_qui;
            $arr[] = $abr_sex;
            $arr[] = $abr_sab;
            $arr[] = $abr_dom;
            
            $arr[] = $mai_seg;
            $arr[] = $mai_ter;
            $arr[] = $mai_qua;
            $arr[] = $mai_qui;
            $arr[] = $mai_sex;
            $arr[] = $mai_sab;
            $arr[] = $mai_dom;
            
            $arr[] = $jun_seg;
            $arr[] = $jun_ter;
            $arr[] = $jun_qua;
            $arr[] = $jun_qui;
            $arr[] = $jun_sex;
            $arr[] = $jun_sab;
            $arr[] = $jun_dom;
            
            $arr[] = $jul_seg;
            $arr[] = $jul_ter;
            $arr[] = $jul_qua;
            $arr[] = $jul_qui;
            $arr[] = $jul_sex;
            $arr[] = $jul_sab;
            $arr[] = $jul_dom;
            
            $arr[] = $ago_seg;
            $arr[] = $ago_ter;
            $arr[] = $ago_qua;
            $arr[] = $ago_qui;
            $arr[] = $ago_sex;
            $arr[] = $ago_sab;
            $arr[] = $ago_dom;
            
            $arr[] = $set_seg;
            $arr[] = $set_ter;
            $arr[] = $set_qua;
            $arr[] = $set_qui;
            $arr[] = $set_sex;
            $arr[] = $set_sab;
            $arr[] = $set_dom;
            
            $arr[] = $out_seg;
            $arr[] = $out_ter;
            $arr[] = $out_qua;
            $arr[] = $out_qui;
            $arr[] = $out_sex;
            $arr[] = $out_sab;
            $arr[] = $out_dom;
            
            $arr[] = $nov_seg;
            $arr[] = $nov_ter;
            $arr[] = $nov_qua;
            $arr[] = $nov_qui;
            $arr[] = $nov_sex;
            $arr[] = $nov_sab;
            $arr[] = $nov_dom;
            
            $arr[] = $dez_seg;
            $arr[] = $dez_ter;
            $arr[] = $dez_qua;
            $arr[] = $dez_qui;
            $arr[] = $dez_sex;
            $arr[] = $dez_sab;
            $arr[] = $dez_dom;
    
            return $arr;
            
          }
          
         $week_val =  get_semanal();
         $compare_val = get_month_compare();
         $get_area_clients = get_area_clients();

         $compare_curs = $compare_val['data_currents'];
         $compare_prevs = $compare_val['data_prevs'];

        // $get_list_prod_sum_current = get_list_prod_sum_current();
         //$get_list_prod_sum_prev = get_list_prod_sum_prev();
         
         $get_list_prod_sum_current = 0;
         $get_list_prod_sum_prev = 0;

         $response['data_current'] = $data;
         $response['data_prev'] = $dataprev;
         $response['week_val'] = $week_val;
         $response['compare_curs'] = $compare_curs;
         $response['compare_prevs'] = $compare_prevs;
         $response['get_area_clients'] = $get_area_clients;
         

         

         $response['dataprev_prod'] = $get_list_prod_sum_prev['dataprev_prod'];
         $response['valor_total_prod_mes_prev'] = $get_list_prod_sum_prev['valor_total_prod_mes_prev'];

         $response['datacur_prod'] = $get_list_prod_sum_current['datacur_prod'];
         $response['valor_total_prod_mes_atual'] = $get_list_prod_sum_current['valor_total_prod_mes_atual'];


         $response['cur_month'] = get_nome_mes_completo($current_month);
         $response['prev_month'] = get_nome_mes_completo($prev_month);

         echo json_encode($response);
    
    ?>