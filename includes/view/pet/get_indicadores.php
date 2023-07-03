<?php 
        include('../../common/util.php'); 
        $current_month = date('m');
        $current_day = date('d');
        $prev_month = $current_month - 1;

        $db = new db();


        /*"SELECT DAY(pb.start_date) AS day_ , MONTH(pb.start_date) as month_ , YEAR(pb.start_date) as year_ ,  COUNT(*) as total , sum(pbd.price)
        FROM pet_booking pb
        LEFT JOIN pet_book_detail pbd ON pbd.id = pb.id
        WHERE ( (MONTH(pb.start_date) = 02 OR MONTH(pb.start_date) = 1)AND YEAR(pb.start_date) = 2020)  
        GROUP BY MONTH(start_date)  ORDER BY DAY(pb.start_date)"*/

        $db->query("SELECT DAY(start_date) AS day_ , MONTH(start_date) as month_ , YEAR(start_date) as year_ ,  COUNT(*) as total_mes
        FROM pet_booking 
        WHERE ( (MONTH(start_date) = ".$current_month." OR MONTH(start_date) = ".$prev_month.") AND YEAR(start_date) = 2020  )
        GROUP BY MONTH(start_date)  ORDER BY MONTH(start_date)"); 
        
        $db->execute();
        $result = $db->resultset(); 
        if($result){
            foreach($result as $row) {
                $total_mes[] = $row["total_mes"];
                $month_[] = get_nome_mes($row["month_"]);
                
               
            
            }

            $response['total_mes'] = $total_mes;
            $response['month_'] = $month_;
           
        }

        // SOMA LAS MONTH
        $db->query("SELECT SUM(pbd.price) as soma_mes , MONTH(pb.start_date) AS month_
        FROM pet_booking pb
        LEFT JOIN pet_book_detail pbd  ON pb.id = pbd.id_booking 
        WHERE ( (MONTH(pb.start_date) = ".$prev_month." )AND YEAR(pb.start_date) = 2020)"); 
        
        $db->execute();
        $result = $db->resultset(); 
        $soma_mes_price = 0;
        $month_price = 0;
        if($result){
          
            foreach($result as $row) {
                $soma_mes_price = $row["soma_mes"];
                if($soma_mes_price == ''){
                    $soma_mes_price = 0;
                }
                $month_price = get_nome_mes($row["month_"]);
                if($month_price == ''){
                    $month_price = 0;
                }
            }

            $response['soma_mes_price_p'] = $soma_mes_price;
            $response['month_price_p'] = $month_price;
           
        } else {
            $response['soma_mes_price_p'] = $soma_mes_price;
            $response['month_price_p'] = $month_price;
        }

        // SOMA CURRENT MONTH
        $db->query("SELECT SUM(pbd.price) as soma_mes , MONTH(pb.start_date) AS month_
        FROM pet_booking pb
        LEFT JOIN pet_book_detail pbd  ON pb.id = pbd.id_booking 
        WHERE ( (MONTH(pb.start_date) = ".$current_month." )AND YEAR(pb.start_date) = 2020)"); 
        
        $db->execute();
        $result = $db->resultset(); 
        if($result){
            foreach($result as $row) {
                $soma_mes_price = $row["soma_mes"];
                $month_price = get_nome_mes($row["month_"]);
            }

            $response['soma_mes_price_c'] = $soma_mes_price;
            $response['month_price_c'] = $month_price;
           
        }

         // SERVICES TYPES LAST MONTH
         $db->query("SELECT count(pb.id) total_service , MONTH(pb.start_date) AS month_ , ps.short_dec
         FROM pet_booking pb
         LEFT JOIN pet_book_detail pbd  ON pb.id = pbd.id 
         LEFT JOIN pet_services ps ON ps.id = pbd.service_name
         WHERE ( (MONTH(pb.start_date) = ".$prev_month." ) AND YEAR(pb.start_date) = 2020)
         GROUP BY ps.id
         "); 

         $db->execute();
         $result = $db->resultset(); 
         if($result){
             foreach($result as $row) {
                 $total_service = $row["total_service"];
                 $short_dec = $row["short_dec"];
                 $month_ = get_nome_mes($row["month_"]);

                 if($short_dec == ''){
                    $short_dec = 'Não Informado';
                 }
                $response['total_service'][] = $total_service;
                $response['short_dec'][] = $short_dec;
                
             }
         } else {
            $response['total_service'][] = 0;
            $response['short_dec'][] = '';
         }


         // SERVICES TYPES CURRENT MONTH
         $db->query("SELECT count(pb.id) total_service , MONTH(pb.start_date) AS month_ , ps.short_dec
         FROM pet_booking pb
         LEFT JOIN pet_book_detail pbd  ON pb.id = pbd.id 
         LEFT JOIN pet_services ps ON ps.id = pbd.service_name
         WHERE ( (MONTH(pb.start_date) = ".$current_month." ) AND YEAR(pb.start_date) = 2020)
         GROUP BY ps.id
         "); 

         $db->execute();
         $result = $db->resultset(); 
         if($result){
             foreach($result as $row) {
                 $total_service = $row["total_service"];
                 $short_dec = $row["short_dec"];
                 $month_ = get_nome_mes($row["month_"]);

                 if($short_dec == ''){
                    $short_dec = 'Não Informado';
                 }
                $response['total_service_c'][] = $total_service;
                $response['short_dec_c'][] = $short_dec;
                
             }
         }




      
        echo json_encode($response);
        //echo $chart_data;
    
    ?>