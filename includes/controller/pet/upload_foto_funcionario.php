<?php 

include('../../common/util.php');

$IdCondominio = 2;
$max_file_size = 2048*1000;

if (isset($_FILES['ufile_image_funcionario'])) {
    $id = $_POST['id_funcc'];
    $max_file_size = 1024*10000;
   
    $file = $_FILES['ufile_image_funcionario'];

    $path = '../../../images/pet/upload/funcionarios/';

    $name = $id.'.jpg';
    $new_name = $name;

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    if ($file['size'] > $max_file_size) {
        $arr['status_message'] = "Foto maior que 10MB";
        $arr['status'] = "ERROR";
        echo json_encode($arr);
        exit(0);
	} else {

        if(move_uploaded_file($_FILES['ufile_image_funcionario']['tmp_name'], $path . $new_name)){
            try{
                $db = new db(); 
                $db->query('UPDATE pet_team SET foto = :imagem  WHERE id = :id ');
                $db->bind(':imagem', $name);
                $db->bind(':id', $id); 		 
                if($db->execute()){ 
                    $arr['status'] = "SUCCESS";
                    $arr['status_txt'] = "Imagem atualizada com sucesso!";
					echo "Sucesso! Você será redirecionado de volta....";
					header( "Refresh:3; url=http://localhost/Agendazy/pet-lista-funcionario-detalhado.php?id=$id", true, 303);
					exit(0);
                } else {
                $arr['status'] = "ERROR";
                $arr['status_txt'] = "Ocorreu algum erro ao salvar seus dados , entre em contato com o administrador";
                echo json_encode($arr);
                }

                }
                catch(PDOException $e){
                print_r($e->getMessage());
                }  
        } else {
            $arr['status_message'] = "Não foi possível atualizar a imagem , verifique o se o tamanho está abaixo de  1,5Mb";
            $arr['status'] = "ERROR";
            echo json_encode($arr);
            exit(0);
        }
        exit;
        }
} else {
    echo "No files uploaded ...";
}?>