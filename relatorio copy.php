<!DOCTYPE html>
<html lang="pt">
<?php include('includes/common/check_permission.php'); ?>
<?php 
    $mes = date("M");
    $year = date("Y");
    $user_level = get_user_level();
    if($user_level != 'a'){ 
        echo "<script>window.location.href = '403';</script>";
        exit(0);
    } 
    $id_atividade = $_GET['id'];
    $id_form = $_GET['form'];
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Anynspect - Atividade</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="includes/atividade/style.css">
    <link rel="stylesheet" href="assets/plugins/toastr/css/toastr.min.css">
    <link href="assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="css/style-full.css" rel="stylesheet">
    
</head>
<style>
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }

    .remove_comment_line , .remove_img , .edit_image_ , .save_comment_{
        display: none !important;
    }

    body {
        background:#fff;
    }

}

tr ,td{padding:5px;}



input[type=radio]:disabled:checked+label::after {
    background-color: rgba(0, 0, 0, .26)!important;
}
</style>
<body>
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <?php include('includes/common/nav-header.php'); ?>
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
		<?php include('includes/common/header.php'); ?>
        <!--**********************************
            Header end
        ***********************************-->
        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include('includes/common/sidebar.php'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid" style="max-width: 740px;">

            <div class="row">


            <div itemprop="sharedContent" class="post-content" style="background: white;padding: 10px;">


                <h2><strong class="title_form">PLANO DE MANUTENÇÃO, OPERAÇÃO E CONTROLE – PMOC</strong></h2>
                <h3><strong>1 – INFORMAÇÕES DO CLIENTE:</strong></h3>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 970px; height: 97px;">
                    <tbody>
                        <tr>
                            <td colspan="5" valign="top">Nome:<span class="client_name"></span></td>
                        </tr>
                        <tr>
                            <td colspan="4" valign="top" width="81%">Endereço completo:</td>
                            <td valign="top" width="19%">N.º:</td>
                        </tr>
                        <tr>
                            <td valign="top" width="23%">Complemento:</td>
                            <td valign="top" width="24%">Bairro:</td>
                            <td colspan="2" valign="top" width="33%">Cidade:</td>
                            <td valign="top" width="19%">UF:</td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="top" width="47%">Telefone:</td>
                            <td colspan="2" valign="top" width="53%">Fax:</td>
                        </tr>
                    </tbody>
                </table>
                <h3><strong>2 – INFORMAÇÕES DO EQUIPAMENTO:</strong></h3>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 970px; height: 78px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="61%">Tipo:</td>
                            <td valign="top" width="39%">Marca:</td>
                        </tr>
                        <tr>
                            <td valign="top" width="61%">Nº de Série:</td>
                            <td valign="top" width="39%">Capacidade:</td>
                        </tr>
                        <tr>
                            <td valign="top" width="61%">Tag:</td>
                            <td valign="top" width="39%">Localização:</td>
                        </tr>
                    </tbody>
                </table>
                <h3><strong>3 – Identificação do Responsável Técnico:</strong></h3>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 970px; height: 102px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="61%">Nome/Razão Social:</td>
                            <td valign="top" width="39%">CIC/CGC:</td>
                        </tr>
                        <tr>
                            <td valign="top" width="61%">Endereço completo:</td>
                            <td valign="top" width="39%">Tel./Fax/Endereço Eletrônico:</td>
                        </tr>
                        <tr>
                            <td valign="top" width="61%">Registro no Conselho de Classe:</td>
                            <td valign="top" width="39%">ART*:</td>
                        </tr>
                    </tbody>
                </table>
                <p><a href="//www.webarcondicionado.com.br/art-e-pmoc-voce-sabe-o-que-e" target="_blank" rel="noopener">* ART = Anotação de Responsabilidade Técnica</a></p>
                <h3><strong>4 – Relação dos Ambientes Climatizados:</strong></h3>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 970px; height: 270px;">
                    <tbody>
                        <tr>
                            <td width="17%" style="text-align: center;">Tipo de Atividade</td>
                            <td colspan="2" width="22%" style="text-align: center;">N.º de Ocupantes</td>
                            <td width="28%" style="text-align: center;">Identificação do Ambiente ou Conjunto de Ambientes</td>
                            <td width="17%" style="text-align: center;">Área Climatizada Total</td>
                            <td width="17%" style="text-align: center;">Carga Térmica</td>
                        </tr>
                        <tr>
                            <td width="17%" style="text-align: center;"></td>
                            <td width="10%" style="text-align: center;">Fixos</td>
                            <td width="12%" style="text-align: center;">Flutuantes</td>
                            <td width="28%"></td>
                            <td width="17%"></td>
                            <td width="17%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="10%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="12%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="28%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                        </tr>
                        <tr>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="10%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="12%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="28%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);"><span style="color: rgb(255, 255, 255);">.</span></span></td>
                        </tr>
                        <tr>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="10%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="12%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="28%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                        </tr>
                        <tr>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="10%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="12%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="28%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                            <td valign="top" width="17%"><span style="color: rgb(255, 255, 255);">.</span></td>
                        </tr>
                    </tbody>
                </table>
                <p>NOTA: anexar Projeto de Instalação do sistema de climatização.</p>
                <h3><strong>5 – Plano de Manutenção e Controle</strong></h3>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 970px; margin-bottom: 20px; height: 400px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="40%" style="text-align: center;">Descrição da atividade</td>
                            <td valign="top" width="15%" style="text-align: center;">Periodicidade</td>
                            <td valign="top" width="13%" style="text-align: center;">Data de execução</td>
                            <td valign="top" width="13%" style="text-align: center;">Executado por</td>
                            <td valign="top" width="19%" style="text-align: center;">Aprovado por</td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top"><strong>a) Condicionador de Ar (do tipo “expansão direta” e “água gelada”)</strong></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão no gabinete, na moldura da serpentina e na bandeja</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">limpar as serpentinas e bandejas</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a operação dos controles de vazão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a operação de drenagem de água da bandeja</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o estado de conservação do isolamento termo-acústico</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a vedação dos painéis de fechamento do gabinete</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                    </tbody>
                </table>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 970px; margin-bottom: 20px; height: 400px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="40%">verificar a tensão das correias para evitar o escorregamento</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">lavar as bandejas e serpentinas com remoção do biofilme (lodo), sem o uso de produtos desengraxantes e corrosivos</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">limpar o gabinete do condicionador e ventiladores (carcaça e rotor)</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar os filtros de ar</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>filtros de ar (secos)</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">medir o diferencial de pressão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar as frestas dos filtros</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">limpar (quando recuperável) ou substituir (quando descartável) o elemento filtrante</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>filtros de ar (embebidos em óleo)</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">medir o diferencial de pressão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar as frestas dos filtros</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">lavar o filtro com produto desengraxante e inodoro</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">pulverizar com óleo (inodoro) e escorrer, mantendo uma fina película de óleo</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top"><strong>b) Condicionador de Ar (do tipo “com condensador remoto” e “janela”)</strong></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão no gabinete, na moldura da serpentina e na bandeja</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a operação de drenagem de água da bandeja</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o estado de conservação do isolamento termo- acústico (se está preservado e se não contém bolor)</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a vedação dos painéis de fechamento do gabinete</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">lavar as bandejas e serpentinas com remoção do biofilme (lodo), sem o uso de produtos desengraxantes e corrosivos</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">limpar o gabinete do condicionador</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar os filtros de ar</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>filtros de ar</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar as frestas dos filtros</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">limpar o elemento filtrante</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top"><strong>c) Ventiladores</strong></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a fixação</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o ruído dos mancais</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">lubrificar os mancais</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a tensão das correias para evitar o escorregamento</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar vazamentos nas ligações flexíveis</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a operação dos amortecedores de vibração</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                    </tbody>
                </table>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 970px; margin-bottom: 20px; height: 400px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="40%">verificar a instalação dos protetores de polias e correias</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a operação dos controles de vazão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a drenagem de água</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">limpar interna e externamente a carcaça e o rotor</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top"><strong>d) Casa de Máquinas do Condicionador de Ar</strong></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira e água</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar corpos estranhos</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar as obstruções no retorno e tomada de ar externo</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>aquecedores de ar</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, dano e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o funcionamento dos dispositivos de segurança</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">limpar a face de passagem do fluxo de ar</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>umidificador de ar com tubo difusor (ver obs.1)</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a operação da válvula de controle</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">ajustar a gaxeta da haste da válvula de controle</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">purgar a água do sistema</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o tapamento da caixa d’água de reposição</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o funcionamento dos dispositivos de segurança</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o estado das linhas de distribuição de vapor e de condensado</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>tomada de ar externo(ver obs.2)</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos, e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a fixação</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">medir o diferencial de pressão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">medir a vazão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar as frestas dos filtros</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o acionamento mecânico do registro de ar (“damper”)</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">limpar (quando recuperável) ou substituir (quando descartável) o elemento filtrante</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>registro de ar (“damper”) de retorno (ver obs.2)</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o seu acionamento mecânico</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">medir a vazão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>registro de ar (“damper”) corta fogo (quando houver)</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o certificado de teste</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira nos elementos de fechamento, trava e reabertura</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o funcionamento dos elementos de fechamento, trava e reabertura</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o posicionamento do indicador de condição(aberto ou fechado)</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>registro de ar (“damper”) de gravidade (venezianas automáticas)</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                    </tbody>
                </table>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 970px; margin-bottom: 20px; height: 400px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="40%">verificar o acionamento mecânico</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">lubrificar os mancais</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <strong>Observações:</strong>
                            <p></p>
                            <p>1. Não é recomendado o uso de umidificador de ar por aspersão que possui bacia de água no interior do duto de insuflamento ou no gabinete do condicionador.</p>
                            <p>2. É necessária a existência de registro de ar no retorno e tomada de ar externo, para garantir a correta vazão de ar no sistema.</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top"><strong>e) Dutos, Acessórios e Caixa Pleno para o Ar</strong></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira (interna e externa), danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a vedação das portas de inspeção em operação normal</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar danos no isolamento térmico</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a vedação das conexões</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>bocas de ar para insuflamento e retorno do ar</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão;</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar a fixação;</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">medir a vazão;</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <ul>
                                <li>dispositivos de bloqueio e balanceamento.</li>
                            </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar o funcionamento</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top"><strong>f) Ambientes Climatizados</strong></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, odores desagradáveis, fontes de ruídos, infiltrações, armazenagem de produtos químicos, fontes de radiação de calor excessivo, e fontes de geração de microorganismos</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top"><strong>g) Torre de Resfriamento</strong></td>
                        </tr>
                        <tr>
                            <td valign="top" width="40%">verificar e eliminar sujeira, danos e corrosão</td>
                            <td valign="top" width="15%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="13%"></td>
                            <td valign="top" width="19%"></td>
                        </tr>
                        <tr>
                            <td colspan="5" valign="top">
                            <strong>Notas:</strong>
                            <p></p>
                            <p><strong>1)</strong> As práticas de manutenção acima devem ser aplicadas em conjunto com as recomendações de manutenção mecânica da NBR 13.971 – Sistemas de Refrigeração, Condicionamento de Ar e Ventilação – Manutenção Programada da ABNT, assim como aos edifícios da Administração Pública Federal o disposto no capítulo Práticas de Manutenção, Anexo 3, itens 2.6.3 e 2.6.4 da Portaria n.º 2296/97, de 23 de julho de 1997, Práticas de Projeto, Construção e Manutenção dos Edifícios Públicos Federais, do Ministério da Administração Federal e Reforma do Estado – MARE. O somatório das práticas de manutenção para garantia do ar e manutenção programada visando o bom funcionamento e desempenho térmico dos sistemas, permitirá o correto controle dos ajustes das variáveis de manutenção e controle dos poluentes dos ambientes.</p>
                            <p><strong>2)</strong> Todos os produtos utilizados na limpeza dos componentes dos sistemas de climatização, devem ser biodegradáveis e estarem devidamente registrados no Ministério da Saúde para esse fim.</p>
                            <p><strong>3)</strong> Toda verificação deve ser seguida dos procedimentos necessários para o funcionamento correto do sistema de climatização.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3><strong>6 – Recomendações aos usuários em situações de falha do equipamento e outras de emergência:</strong></h3>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 722px; margin-bottom: 20px; height: 184px;">
                    <tbody>
                        <tr>
                            <td valign="top"><strong>Descrição:</strong></td>
                        </tr>
                        <tr>
                            <td valign="top"><span style="color: rgb(255, 255, 255);">.</span></td>
                        </tr>
                        <tr>
                            <td valign="top"><span style="color: rgb(255, 255, 255);">.</span></td>
                        </tr>
                        <tr>
                            <td valign="top"><span style="color: rgb(255, 255, 255);">.</span></td>
                        </tr>
                        <tr>
                            <td valign="top"><span style="color: rgb(255, 255, 255);">.</span></td>
                        </tr>
                        <tr>
                            <td valign="top"><span style="color: rgb(255, 255, 255);">.</span></td>
                        </tr>
                        <tr>
                            <td valign="top"><span style="color: rgb(255, 255, 255);">.</span></td>
                        </tr>
                    </tbody>
                </table>
                <p><strong>ANEXO II</strong></p>
                <h3><strong>Classificação de filtros de ar para utilização em ambientes climatizados, conforme recomendação normativa 004-1995 da SBCC</strong></h3>
                <table border="1" cellspacing="1" cellpadding="0" class="responsive" style="width: 720px; height: 329px;">
                    <tbody>
                        <tr>
                            <td valign="top" width="450">Classe de filtro</td>
                            <td colspan="2">Eficiência (%)</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213">Grossos</td>
                            <td valign="top" width="221">G0</td>
                            <td colspan="2" valign="top" width="498">30-59</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213"></td>
                            <td valign="top" width="221">G1</td>
                            <td colspan="2" valign="top" width="498">60-74</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213"></td>
                            <td valign="top" width="221">G2</td>
                            <td colspan="2" valign="top" width="498">75-84</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213"></td>
                            <td valign="top" width="221">G3</td>
                            <td colspan="2" valign="top" width="498">85 e acima</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213">Finos</td>
                            <td valign="top" width="221">F1</td>
                            <td colspan="2" valign="top" width="498">40-69</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213"></td>
                            <td valign="top" width="221">F2</td>
                            <td colspan="2" valign="top" width="498">70-89</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213"></td>
                            <td valign="top" width="221">F3</td>
                            <td colspan="2" valign="top" width="498">90 e acima</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213">Absolutos</td>
                            <td valign="top" width="221">A1</td>
                            <td colspan="2" valign="top" width="498">85-94,9</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213"></td>
                            <td valign="top" width="221">A2</td>
                            <td colspan="2" valign="top" width="498">95-99,96</td>
                        </tr>
                        <tr>
                            <td valign="top" width="213"></td>
                            <td valign="top" width="221">A3</td>
                            <td colspan="2" valign="top" width="498">99,97 e acima</td>
                        </tr>
                        <tr>
                            <td width="128"></td>
                            <td width="93"></td>
                            <td width="186"></td>
                        </tr>
                    </tbody>
                </table>
                <p><strong>1)</strong>&nbsp; métodos de ensaio:</p>
                <p>Classe G: Teste gravimétrico, conforme ASHRAE* 52.1 – 1992 (arrestance)</p>
                <p>Classe F: Teste colorimétrico, conforme ASHRAE 52.1 – 1992 (dust spot)</p>
                <p>Classe A: Teste fotométrico DOP TEST, conforme U.S. Militar Standart 282</p>
                <p>*ASHRAE – American Society of Heating, Refrigerating, and Air Conditioning Engineers, Inc.</p>
                <p><strong>2)</strong>&nbsp; Para classificação das áreas de contaminação controlada, referir-se a NBR 13700 de junho de 1996, baseada na US Federal Standart 209E de 1992.</p>
                <p><strong>3)</strong> SBCC – Sociedade Brasileira de Controle da Contaminação</p>
                <ul>
                    <li><strong>Leia também:</strong>&nbsp;<a href="https://www.webarcondicionado.com.br/perguntas-e-respostas-sobre-a-lei-13-589-a-manutencao-do-ar-condicionado-e-obrigatoria" target="_blank" rel="noopener"><strong>Perguntas e respostas sobre a lei 13.589 – A manutenção do ar-condicionado é obrigatória</strong></a></li>
                </ul>
                <p><strong>Alguma dúvida sobre o modelo de check list do PMOC? </strong>Faça um comentário e seja respondido.</p>
                <div id="crp_related" class="crp_related">
                    <h3>Posts Relacionados:</h3>
                    <ul>
                        <li><a href="/webarcondicionado-lanca-servico-de-orcamento-solicite-instalacao-e-manutencao-online" data-category="Blog / Artigo" data-label="Artigo / Post Relacionado" data-value="webarcondicionado-lanca-servico-de-orcamento-solicite-instalacao-e-manutencao-online" class="crp_title">GRÁTIS – WebArCondicionado tem Solicitação de…</a></li>
                        <li><a href="/split-e-o-modelo-que-mais-vendeu-no-mundo-em-2017" data-category="Blog / Artigo" data-label="Artigo / Post Relacionado" data-value="split-e-o-modelo-que-mais-vendeu-no-mundo-em-2017" class="crp_title">Split é o modelo que mais vendeu no mundo em 2017</a></li>
                        <li><a href="/gree-amplia-linha-de-ar-condicionado-fotovoltaico-no-brasil-e-anuncia-modelo-com-sistema-inteligente" data-category="Blog / Artigo" data-label="Artigo / Post Relacionado" data-value="gree-amplia-linha-de-ar-condicionado-fotovoltaico-no-brasil-e-anuncia-modelo-com-sistema-inteligente" class="crp_title">Gree amplia linha de Ar-Condicionado Fotovoltaico no Brasil…</a></li>
                        <li><a href="/carrier-risco-incendio-modelo-ar-condicionado-multisplit" data-category="Blog / Artigo" data-label="Artigo / Post Relacionado" data-value="carrier-risco-incendio-modelo-ar-condicionado-multisplit" class="crp_title">Carrier anuncia risco de Incêndio em modelo de…</a></li>
                        <li><a href="/jaguar-lanca-modelo-de-carro-que-filtra-o-ar-da-cabine-antes-do-passageiro-ingressar-no-veiculo" data-category="Blog / Artigo" data-label="Artigo / Post Relacionado" data-value="jaguar-lanca-modelo-de-carro-que-filtra-o-ar-da-cabine-antes-do-passageiro-ingressar-no-veiculo" class="crp_title">Jaguar lança modelo de carro que filtra o ar da cabine…</a></li>
                    </ul>
                    <div style="clear: both;"></div>
                </div>
                </div>






            </div>
               
                
                
                <!--<div class="row">
                    

                    <div class="col-lg-9" style="margin:auto;">
                        <div class="card invoice-info-card" >
                            <div class="card-header support-tickets text-center">
                            <div class="ticket-id d-md-flex pb-3">
                                    <div>
                                        <h4 class="card-intro-title" id="id_at"></h4>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <h3 class="mr-2">Status: </h3>
                                        <span id="status_atividade"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-xl-8">
                                        <div class="invoice-info-left">
                                            <div class="">
                                                <div>
                                                <span id="foto_empresa" > </span>
                                                    <h4 id="nome_empresa" class="text-primarys mb-2" ></h4>
                                                    <a id="email_empresa" ></a>
                                                </div>
                                                <div  style="margin-top:20px;" class="mb-4">
                                                    <h6 id="endereco_empresa"></h6>
                                                    <h6 id="cidade_empresa"></h6>
                                                </div>
                                               
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-4 ">
                                        <div class="invoice-info-right" style="text-align:right;">
                                                <div class="mb-4">
                                                <span id="foto_cliente"><img  style="width:50px;height:50px;float:right;" class="avatar_logo" src="assets/images/noimage.png" alt=""> </span>
                                                    <h4 id="nome_cliente" class="text-primarys mb-2"  ></h4>
                                                    <a id="email_cliente" ></a>
                                                </div>
                                                <div  style="margin-top:20px;" class="mb-4">
                                                    <h6 id="endereco_cliente"></h6>
                                                    <h6 id="cidade_cliente"></h6>
                                                </div>
                                               
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-xl-12 mb-12">
                                        <div class="col-md-12">
                                            <div class="card-body py-0 px-4">
                                                
                                                <div class="my-4">
                                                    <p class="mb-0">Atividade</p>
                                                    <h5 id="titulo_atividade" ></h5>
                                                </div>
                                                <div class="my-4">
                                                    <p class="mb-0">Ativo / Equipamento</p>
                                                    <h5 id="ativo_equipamento" ></h5>
                                                </div>
                                                <div class="my-4">
                                                    <p class="mb-0">Localização</p>
                                                    <h5 id="local_ativo" ></h5>
                                                </div>
                                                <div class="my-4">
                                                    <p class="mb-0">Data Atividade</p>
                                                    <h5 id="data_atividade"></h5>
                                                </div>
                                                <div class="border-bottom-1 my-4 pb-3">
                                                    <p class="mb-0">Tempo Estimado</p>
                                                    <h5 id="tempo_estimado"></h5>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-4">
                                                        <h6><span class="d-block pb-2">Executado por</span><span class="h4 text-primary" id="executado_por"></span></h6>
                                                    </div>
                                                    <div class="col-3 ">
                                                        <h6><span class="d-block pb-2">Iniciado</span><span class="h4 text-primary" id="atividade_iniciada">-</span></h6>
                                                    </div>
                                                    <div class="col-3 ">
                                                        <h6><span class="d-block pb-2">Finalizado</span><span class="h4 text-primary" id="atividade_finalizada">-</span></h6>
                                                    </div>
                                                    <div class="col-2 ">
                                                        <h6><span class="d-block pb-2">Tempo</span><span class="h4 text-primary" id="atividade_tempo" >-</span> </h6>
                                                    </div>
                                                </div>
                                                <div class="my-4">
                                                    <p class="text-dark">Ações:</p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div id="sjfb-wrap">
                                            <form class="form" id="sjfb-sample" >
                                                <div id="sjfb-fields"></div>
                                            </form>

                                        </div>

                                      
                                    </div>
                                    <div style="background: #f2f5f8;margin: 12px;width: 100%;height: 10px;"></div>
                                        
                                    <div id="box_sig_col" style="width: 100%;">
                                        <div class="col-lg-12">
                                            <div id="sjfb-fields"><label for="text-4" class="block-title">Assinatura Colaborador</label></div>
                                            <div id="boxcanvas_colab" class="wrapper" style="height: 150px;border: 1px dashed gray;margin: 10px;">
                                                <canvas id="signature-pad" class="signature-pad" width=980 height=165 ></canvas>
                                                <input id="dummy_sig_colab" name="dummy_sig_colab" type="hidden" >
                                            </div>
                                        </div>
                                
                                        <div id="box_action_sigcolab" class="col-lg-12" style="text-align: right;padding-right: 20px;margin-bottom: 15px;">
                                            <button  class="btn-xs btn btn-primary no-print" id="save_sig1">Confirmar Assinatura</button>
                                            <button style="background: #9E9E9E;color: #fff;" class="no-print btn btn-xs" id="clear_sig1">Limpar</button>
                                        </div>
                                    </div>
                                        
                                    <div style="background: #f2f5f8;margin: 12px;width: 100%;height: 10px;"></div>

                                    <div id="box_sig_cli" style="width: 100%;">
                                        <div class="col-lg-12">
                                            <div id="sjfb-fields"><label for="text-4" class="block-title">Assinatura Cliente</label></div>
                                            <div id="boxcanvas_cli" class="wrapper" style="height: 150px;border: 1px dashed gray;margin: 10px;">
                                                <canvas id="signature-pad-cli" class="signature-pad-cli" width=980 height=165 ></canvas>
                                                <input id="dummy_sig_cli" name="dummy_sig_cli" type="hidden" >
                                            </div>
                                        </div>
                                
                                        <div id="box_action_sigcli" class="col-lg-12" style="text-align: right;padding-right: 20px;margin-bottom: 15px;">
                                            <button class="btn-xs btn btn-primary no-print" id="save_sigcli">Confirmar Assinatura</button>
                                            <button style="background: #9E9E9E;color: #fff;" class="no-print btn btn-xs" id="clear_sig1cli" >Limpar</button>
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table invoice-details-table" style="min-width: 500px;">
                                                <thead>
                                                    <tr>
                                                        <th>Ativo</th>
                                                        <th>Serviço</th>
                                                        <th>Data</th>
                                                        <th class="text-center">Valor</th>
                                                        <th class="text-center">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table_comissao">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end my-4">
                                            <button onclick="window.print();" class="btn btn-primary btn-sl-lg mr-3 no-print" style="color:#222;background: #f9f9f9;border-color: #d2d2d2;">Imprimir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
                
                
                <input type="hidden" id="id_atividade" value="<?=$id_atividade?>" />
                <input type="hidden" id="id_form" value="<?=$id_form?>" />
                <input type="hidden" name="current_status" id="current_status">
                <input type="hidden" name="flow_approve" id="flow_approve">
                <input type="hidden" name="geo_location" id="geo_location">
                <input type="hidden" name="image_require" id="image_require">
                <input type="hidden" name="signature" id="signature">
                <input type="hidden" name="signature_exec" id="signature_exec">

            </div>
            <!-- #/ container -->
        </div>

        <!-- Default Size -->
        <div class="modal fade" id="EditImage" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                
                                <button style="float:right;" type="button" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Fechar</button>
                            </div>
                                <form class="form novo_equipamento_form" id="validate_form_imagem" role="form" style="width: 100%;">
                                    <div class="cards">
                                        <div class="body">
                                            <div class="row clearfix">
                                                <div style="text-align:center;margin: auto;" class="js-signature" data-width="500" data-height="500"  data-line-color="#bc0000" data-auto-fit="false"></div>
                                                <div class="col-md-12">
                                                   <!-- <a style="width:100%;color:#fff;" class="no-print btn btn-brand btn-elevate" value="submit">Salvar</a>
                                                    
                                                    <button id="clearBtn" class="btn btn-default" >Limpar</button>
                                                    <button id="saveBtn2" class="btn btn-success" >Salvar</button> -->
                                                    <input type="hidden" name="save_remote_data" id="save_remote_data">
                                                    <input type="hidden" name="imagem_anexo_dummy" id="imagem_anexo_dummy">
                                                    <input type="hidden" name="id_imagem" id="id_imagem">
                                                    <input type="hidden" name="image_name" id="image_name">
                                                    <input type="hidden" name="type_" id="type_">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>

                        </div>
                    
                    
                    </div>
                </div>
            </div>
        </div>
        <style>
        .has-error{position:relative!important;}

        </style>


        <!--**********************************
            Content body end
        ***********************************-->
        <!--**********************************
            Footer start
        ***********************************-->
       <?php include('includes/common/footer.php'); ?>
        <!--**********************************
            Footer end
        ***********************************-->
        <!--**********************************
            Right sidebar start
        ***********************************-->
        <?php //include('includes/common/right-sidebar.php'); ?>
        <!--**********************************
            Right sidebar end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="assets/plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>
    <script src="js/jq-signature.min.js"></script>
    <script src="js/signature_pad.min.js"></script>
    <script src="assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script>
        toastr.options = {"positionClass": "toast-top-full-width"};
        var id_atividade = $("#id_atividade").val();
        var id_form = $("#id_form").val();

        var size_heigh = $(window).height();
        var size_width = $('.invoice-info-card').width() - 20;

        $('#boxcanvas_colab').html('<canvas id="signature-pad" class="signature-pad" width='+size_width+' height=150 ></canvas>')
        $('#boxcanvas_cli').html('<canvas id="signature-pad-cli" class="signature-pad-cli" width='+size_width+' height=150 ></canvas>')
  
        function get_info_gerais(){
           

            $.ajax({
            //url:"includes/calendario/get_eventos_single",
            url:"includes/atividade/get_eventos_single",
            method:"POST",
            dataType: 'JSON',
            data:{
                id:id_atividade
                          
            },
                success:function(response){

                var empresa = response.empresa;
                var cliente = response.cliente;
                var config = response.config;
                var content = response[0];
                var comissao = response.comission;
                var comission_total = 0;

                var foto_empresa = empresa.foto_empresa +'?' + (new Date()).getTime();
                var foto_cliente = cliente.foto_cliente +'?' + (new Date()).getTime();
                var foto_funcionario = content.foto_funcionario +'?' + (new Date()).getTime();
                var nome_funcionario_exec = content.nome_funcionario_exec;

                $('.title_form').html(content.desc_service);
                $('.client_name').html(cliente.nome_empresa);

                $("#status_atividade").html('<span><a style="cursor:pointer;" class="start_servico" name="'+content.id+'" ><span style="background:'+content.color+';color:'+content.textColor+'" class="label label label-rounded ">'+content.status_+'</a></span>');
                $("#id_at").html('ID #'+content.id);
               
						
                $("#foto_empresa").html('<img  style="width:50px;height:50px;float: left;" class="avatar_logo" src="'+foto_empresa+'" alt="">');
                $("#nome_empresa").html(empresa.nome_empresa);
                $("#email_empresa").html(empresa.email);
                $("#endereco_empresa").html(empresa.endereco + ' , ' + empresa.bairro + ' , nº' + empresa.number);
                $("#cidade_empresa").html(empresa.cidade+' - '+ empresa.estado + ' '+empresa.cep);
                $("#cep_empresa").html(empresa.cep);
                $("#telefone_empresa").html(empresa.phone);
                //$("#foto_funcionario").html(funcionario.foto_funcionario);
                $("#nome_cliente").html(cliente.nome_empresa);
                $("#email_cliente").html(cliente.email_cliente);
                $("#endereco_cliente").html(cliente.endereco_cliente + ' , ' + cliente.bairro_cliente + ' , nº' + cliente.num_cliente);
                $("#cidade_cliente").html(cliente.cidade_cliente+' - '+ cliente.estado_cliente+' '+cliente.cep_cliente);
                $("#foto_cliente").html('<img  style="width:50px;height:50px;float:right;" class="avatar_logo" src="'+foto_cliente+'" alt="">');

                $("#flow_approve").val(config.flow_approve);
                $("#geo_location").val(config.geo_location);
                $("#image_require").val(config.image_require);
                $("#signature").val(config.signature);
                $("#signature_exec").val(config.signature_exec);
                
                

                $("#titulo_atividade").html(content.desc_service);
                $("#ativo_equipamento").html(content.descricao);
                $("#local_ativo").html(content.local_ativo);
                $("#data_atividade").html(content.br_start);
                $("#preco_atividade").html(content.preco);
                $("#atividade_iniciada").html(content.started_at);
                $("#atividade_finalizada").html(content.ended_at);
                $("#tempo_estimado").html(content.est_time);
                
                if(content.ended_at == '00/00/0000 00:00:00'){
                    $("#atividade_tempo").html('');
                } else {
                    $("#atividade_tempo").html(content.tempo_realizado);
                }
               
                $("#current_status").val(content.status_);

                if(content.id_quem_executou == null){
                    $("#executado_por").html('-');
                } else {
                    $("#executado_por").html('<a href="funcionario-'+content.id_quem_executou+'" ><img style="width: 25px;height:25px;float: left;margin-right: 5px;" class="rounded-circle" src="'+foto_funcionario+'" alt="'+nome_funcionario_exec+'"><p class="mb-0">'+nome_funcionario_exec+'</p></a>');
                }

                
                if(content.status_ == 'Pendente'){
                    $("#atividade_iniciada").html('<button id="comecar" style="" onclick="alteraStatus(`comecar`)" class="btn-xs btn btn-start">Iniciar Atividade</button>');
                    $("#atividade_finalizada").html('-');
                    $("#atividade_tempo").html('-');
                } 
                
                if(content.status_ == 'Em Andamento'){
                    $("#atividade_finalizada").html('<button id="finalizar" style="" onclick="alteraStatus(`finalizar`)" class="btn-xs btn btn-close">Finalizar Serviço</button>');
                }

                var status_det = $('#current_status').val();
                generateForm(id_form,content.status_)
               
                
                }
            }); 
        }

    /*function alteraStatus(acao){ 

	var eventID = $('#id_atividade').val();
	var id_funcionario = $('#eventFunc').val();
         
	   toastr.options = {"positionClass": "toast-top-full-width"}
       
        $.ajax({
            url: "includes/atividade/alteraStatus",
        data: {
            eventID:eventID,
            acao:acao
        },
                type: "POST",
                dataType: 'JSON',
                success: function(response) {
                status = response.status;
                status_message = response.status_txt;
                }

            })
			if(acao == "concluido"){
				fullname = response.fullname;
				foto = response.foto;

				imagem = foto +'?' + (new Date()).getTime();
				
				zap = response.zap;
				zap = zap.replace("(", "");
				zap = zap.replace(")", "");
				zap = zap.replace("-", "");
				zap = zap.replace(" ", "");

				toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
				$('#calendarModal').modal('hide');

				information = '<div class="user-info">'+
                        '<div class="image"><a  class=" waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
							'<h4><strong>'+fullname+'</strong></h4>'+
							'<h5>O serviço foi finalizado! Deseja enviar uma mensagem no whatsapp do cliente?</h5>'+
							'<h5>Telefone Cliente</h5>'+
							'<span><input class="phone" value="'+response.zap+'" type="text" style="margin-bottom: 10px;width:100%;height:40px;border:1px solid #dddfe1;border-radius:5px;padding-left:5px;" id="phone_message_cliente" name="phone_message_cliente"></input></span>'+
							'<br><span><textarea type="text" id="zap_message" name="zap_message" class="form-control" ></textarea></span>'+
                        '</div>'+
                    '</div>';
    
				swal({
					html: information,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim, Enviar!',
					cancelButtonText: 'Não Obrigado',
					showLoaderOnConfirm: true,
					
					preConfirm: function() {
						zap_message = $('#zap_message').val();
						phone_message_cliente = $('#phone_message_cliente').val();

						phone_message_cliente = phone_message_cliente.replace("(", "");
						phone_message_cliente = phone_message_cliente.replace(")", "");
						phone_message_cliente = phone_message_cliente.replace("-", "");
						phone_message_cliente = phone_message_cliente.replace(" ", "");
						
						if(zap_message != ''){
							if(phone_message_cliente != ''){
                                var string_zap = 'https://wa.me/55'+phone_message_cliente+'/?text='+zap_message+' ';

                                window.open(string_zap+' ','_blank');

								//window.open('https://api.whatsapp.com/send?phone=55'+phone_message_cliente+'&text='+zap_message+' ','_blank');
							} else {
								toastr.error('Erro!', "Oops, Digite o telefone do cliente!");
								$('#calendarModal').modal('hide');

							}
							
						} else {
							toastr.error('Erro!', "Oops, Digite uma mensagem para o cliente!");
							$('#calendarModal').modal('hide');

						}
						

						toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
						$('#calendarModal').modal('hide');
					
					
					},
					allowOutsideClick: true			  
                });
                
                $('.phone').mask('(00) 00000-0009');
				$('#concluido').show();
                $('#reprovar').show();
                $('#finalizar').hide();
				
			} else if(acao == "finalizar"){

            } else if(acao == "comecar"){

            } 
			
			

           
       
       
   } */

function alteraStatus(acao){ 
	var eventID = $('#id_atividade').val();
    var id_funcionario = $('#eventFunc').val();
    
    imagem = 'images/nouser.png';
         
    toastr.options = {"positionClass": "toast-top-full-width"}

    information = '<div class="user-info">'+
                    '<div class="image"><a  class=" waves-effect waves-block"><img  style="width:60px;height:60px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                        '<div class="detail">'+
							'<h4><strong>Olá</strong></h4>'+
							'<h5>Você tem certeza que deseja executar esta ação!</h5>'+
                        '</div>'+
                    '</div>';
    
				swal({
					html: information,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim!',
					cancelButtonText: 'Não',
					showLoaderOnConfirm: true,
					
					preConfirm: function() {

                      
                        $.ajax({
                            url: "includes/atividade/alteraStatus",
                           data: {
                            eventID:eventID,
                            acao:acao,
                           },
                                type: "POST",
                                dataType: 'JSON',
                                success: function(response) {
                                    status = response.status;
                                    status_message = response.status_txt;
                                    data_criacao = response.data_criacao;
                                    if(status == 'SUCCESS'){
                                        toastr.success(status_message, 'Sucesso');
                                        get_info_gerais()
                                    } else {
                                        toastr.error(status_message, 'Error');
                                    }
                                    
                                }
                           });
					
					},
					allowOutsideClick: true			  
                });

       
       
       
}      

function alteraStatusReprovado(acao){ 
    $('.phone').mask('(00) 00000-0009');
	var eventID = $('#id_atividade').val();
    var id_funcionario = $('#eventFunc').val();
    
    imagem = 'images/noimage.png';
         
    toastr.options = {"positionClass": "toast-top-full-width"}

    information = '<div class="user-info">'+
                        '<div class="detail">'+
							'<h4><strong>Olá</strong></h4>'+
							'<h5>Digite o Motivo!</h5>'+
							'<br><span><textarea rows="4" type="text" id="repprove_message" name="repprove_message" class="form-control" ></textarea></span>'+
                        '</div>'+
                    '</div>';
    
				swal({
					html: information,
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sim, Enviar!',
					cancelButtonText: 'Não Obrigado',
					showLoaderOnConfirm: true,
					
					preConfirm: function() {

                       var repprove_message =  $('#repprove_message').val();
                       if(repprove_message == ''){
                        toastr.success("Digite a Justificativa!", 'Ops'); 
                        return;
                       }
                        
                        $.ajax({
                            url: "includes/calendario/repprove_event",
                           data: {
                            eventID:eventID,
                            acao:acao,
                            id_funcionario:id_funcionario,
                            repprove_message:repprove_message
                           },
                                type: "POST",
                                dataType: 'JSON',
                                success: function(response) {
                                    status = response.status;
                                    status_message = response.status_txt;
                                    get_open_service();
                                    toastr.success("Serviço finalizado com sucesso!", 'Sucesso');
                                    $('#calendarModal').modal('hide');
                                    $('#concluido').hide();
                                    $('#reprovar').hide();
                                 }
                           });
					
					},
					allowOutsideClick: true			  
                });

       
       
       
}      

get_info_gerais();


function generateForm(formID,status_det) {
console.log(status_det)
$("#sjfb-fields").empty();
    $.getJSON('includes/atividade/sjfb-load-form?form_id=' + formID, function(data) {
        
        if (data) {
            var titulo_formulario = data.titulo_formulario;
            var tipo_formulario = data.tipo_formulario;
            var imagem = data.imagem;
            var conteudo_formulario = JSON.parse(data.conteudo_formulario);
            var enable_disable = ""; 
            var i = 0;
            var k = 0;

            
            if(conteudo_formulario == null || conteudo_formulario == 'null' ){
                
            } else {
                //$('#sjfb-fields').append('<p style="padding:5px;margin: 5px;background: #2f4260;" ><span style="color: #fff;font-size: 16px;font-weight: 700;">Check-list </span></p>')
                $.each( conteudo_formulario, function( k,  v) {

                    console.log(conteudo_formulario)
                    
                    

                    var fieldType = v['type'];
                    //Add the field
                    $('#sjfb-fields').append(addFieldHTML(fieldType));
                    var $currentField = $('#sjfb-fields .sjfb-field').last();
                    //Add the label
                    $currentField.find('label').text(v['label']);
                    //Any choices?
                    if (v['choices']) {
                        //var uniqueID = Math.floor(Math.random()*999999)+1;
                        var uniqueID = formID;
                        var name_radio = $currentField.find('label').text(v['label']).prevObject[0].id;
                        
                        $.each( v['choices'], function( k, v ) {

                            

                        
                            if (fieldType == 'select') {
                                var selected = v['sel'] ? ' selected' : '';
                                var choiceHTML = '<option' + selected + '>' + v['label'] + '</option>';
                                $currentField.find(".choices").append(choiceHTML);
                            }

                            else if (fieldType == 'radio') {

                                

                                var selected = v['sel'] ? ' checked' : '';
                            
                                var choiceHTML = '<div class="col-sm-6 col-md-4 col-xl">'+
                                    '<div class="form-radio">'+
                                        '<input id="radio-' + i + '" class="radio-outlined" '+enable_disable+' type="radio" name="radio-' + name_radio + '"' + selected + ' value="' + v['label'] + '" >'+
                                        '<label for="radio-' + i + '" class="radio-green">' + v['label'] + '</label>'+
                                    '</div>'+
                                '</div>';
                                
                                $currentField.find(".choices").append(choiceHTML);
                            }

                            else if (fieldType == 'checkbox') {
                                var selected = v['sel'] ? ' checked' : '';

                                var choiceHTML = '<div class="col-12">'+
                                                        '<div class="form-check mb-5 mr-5">'+
                                                            '<input class="form-check-input styled-checkbox" styled-checkbox" '+enable_disable+' id="ch_'+i+'" type="checkbox" name="checkbox-' + uniqueID + '[]"' + selected + ' value="' + v['label'] + '" >'+
                                                            '<label for="ch_'+i+'" class="form-check-label check-green ">' + v['label'] + '</label>'+
                                                        '</div>'+
                                                    '</div>';
                                
                                
                                $currentField.find(".choices").append(choiceHTML);
                            }
                            i++;
                            
                            $('.img_file').removeAttr('required');
                            $('.img_file').removeAttr('required-choice');

                        });


                    }

                    //Is it required?
                    if (v['req']) {
                        if (fieldType == 'file') {$currentField.find("input").prop('required',false).removeClass('required-choice') }
                        else if (fieldType == 'text') { $currentField.find("input").prop('required',true).addClass('required-choice') }
                        else if (fieldType == 'textarea') { $currentField.find("textarea").prop('required',true).addClass('required-choice') }
                        else if (fieldType == 'select') { $currentField.find("select").prop('required',true).addClass('required-choice') }
                        else if (fieldType == 'radio') { $currentField.find("input").prop('required',true).addClass('required-choice') }
                       
                        $currentField.addClass('required-field');
                    }

                    $('.choices-select').select2();

                });

                $('#sjfb-fields').append('<div id="box_save_checklist" style="padding:10px;"><button style="width:100%;" type="submitt" class="no-print btn btn-primary save_check_list button">Salvar Atividades</button></div>');
                
                console.log(status_det)
                
                if(status_det == 'Finalizado' || status_det == 'Concluído'){
                    enable_disable = 'disabled';
                    $("input,textarea,select").prop("disabled",true); 
                    $('#box_save_checklist').hide();
                    $('.save_comment_ ').remove();
                    $('.form-control').remove();
                    $('.remove_comment_line').remove();
                    $('#save_sig1').remove();
                    $('#clear_sig1').remove();
                    $('#save_sigcli').remove();
                    $('#clear_sig1cli').remove();
                    $('.remove_comment_line').hide();

                    $("#phone_cliente").prop("disabled",false); 
                    $("#zap_message").prop("disabled",false); 
                }


                function call_lista_atividades(id_form,id) {
                $.ajax({
                    url:  "includes/atividade/get_atividade_result",
                    type : 'GET',
                    data :{
                        IdFormulario:formID,
                        IdEvento:id
                    },
                    success: function(response){
                    var json = JSON.parse(response);
                    var status = json.status;
                
                        if(status  == 'SUCCESS') {
                            
                            var box_atividades = "";
                            id = json.id;
                            var resp_atividade = json.resp_atividade;
                            for(var a = 0; a < resp_atividade.length; a++){
                                var statusdummy = "";
            
                                var find_id = resp_atividade[a].campo
                                var find_valor = resp_atividade[a].valor
            
                                var rates = document.getElementsByName(find_id);
                                var rate_value;
                                for(var i = 0; i < rates.length; i++){
                                    if(find_valor == rates[i].value){
                                            $("input[name="+find_id+"]").val([find_valor]);
                                        
                                    } 
                                }

                                $('input[name="'+find_id+'[]"]').each(function(){
                                    var res = find_valor.split(",");
                                    for(i = 0; i < res.length; i++) {
                                        if(res[i] == $(this).attr('value')){
                                                $(this).prop( "checked", true );
                                        } 
                                        }
                                });
                                $('#'+find_id).val(find_valor);
                            }
                        
                        } else {
                            $('#no_item_message').show();
                        }
            
                        }
                    });
            }

            
            call_lista_atividades(id_form,id_atividade);

                $("input[type='text']").change( function() {
                    if(this.value){
                        $(this).css("border", "1px solid #dddfe1;");
                    }
                });

                $('.save_check_list').on('click', function (e) {
                    e.preventDefault();
                    var requiredElements = document.getElementById("sjfb-sample").querySelectorAll("[required]"),
                    c = document.getElementById("check"),
                    o = document.getElementById("output");

                    var s = "";
                    for (var i = 0; i < requiredElements.length; i++) {
                        var e = requiredElements[i];
                        if(e.value.length > 0){
                            
                           $('#text-4-1').css("border", "1px solid #dddfe1!important");
                           $('#text-4-1').attr('border', "1px solid #dddfe1!important")
                           

                        } else {
                                var targetOffset = $('#'+e.id+'').offset().top - $(window).scrollTop();
                                $('.page-content').animate({ 
                                    scrollTop: targetOffset + 500
                                }, 600);
                                $( '#'+e.id+'' ).focus();
                                $( '#'+e.id+'' ).blur();
                                $( '#'+e.id+'' ).css("border", "1px solid #f44336");
                                toastr.error('Campo Obrigatório', 'Erro!');
                                return false;
                        }

                    }

                    var x = $('#sjfb-sample').serializeArray();
                    var output = [];
            
                    x.forEach(function(value) {
                    var existing = output.filter(function(v, i) {
                        return v.name == value.name;
                    });
                    if (existing.length) {
                        var existingIndex = output.indexOf(existing[0]);
                        output[existingIndex].value = output[existingIndex].value.concat(value.value);
                    } else {
                        if (typeof value.value == 'string')
                        value.value = [value.value];
                        output.push(value);
                    }
                    });
            
                    function isEmpty(obj) {
                        for(var key in obj) {
                            if(obj.hasOwnProperty(key))
                                return false;
                        }
                        return true;
                    }
                   
                    //document.getElementByClass('#'+e.id+'').style.border = "1px solid #dddfe1";
            
                    var data = JSON.stringify(output);
                            //var formID = $('#id_form').val();

                            $.ajax({
                            method: "POST",
                            url: 'includes/atividade/sjfb-save-result',
                            data: {
                                data : data,
                                formID:id_form,
                                at:id_atividade
                            },
                            dataType: 'json',
                            success: function(response) {
                                var status = response.status;
                                var status_message = response.status_txt;
                                toastr.success(status_message, 'Sucesso!');
                                return false;
               
                            }
                        });
            
                });

            }

        
        }

        //HTML templates for rendering frontend form fields
        function addFieldHTML(fieldType) {
            k++;
            var uniqueID = formID;
            var rand = formID;
            switch (fieldType) {

                case 'text':
                    return '' +
                        '<div id="sjfb-'+uniqueID+'" class="sjfb-field sjfb-text ">' +
                        '<label for="text-' + uniqueID + '" class="block-title" ></label>' +
                        '<input name="text-'+uniqueID+'-'+k+'" class="form-control" type="text" id="text-'+uniqueID +'-'+k+'">' +
                        
                        '<div class="post-input no-print" style="text-align: right;margin-top: 10px;"> <a href="javascript:toogle_element(`text_comment_'+uniqueID+'-'+k+'`)"><i class="ti-comments"></i> </a><a href="javascript:toogle_element(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-camera"></i> </a><a href="javascript:open_pa(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-alert"></i> </a></div>'+
                            
                            '<div style="margin: 10px 0px 0px 0px;background: rgb(251, 251, 251);padding: 10px;" class="ticket-widget" id="text_comment_'+uniqueID+'-'+k+'">'+
                                '<h5>Comentário</h5>'+
                                '<textarea  id="comment_'+uniqueID+'-'+k+'" name="textarea" class="form-control" placeholder=""></textarea>'+
                                '<div style="margin-top:10px;"><a href="javascript:save_comment(`'+uniqueID+'-'+k+'`)" id="'+uniqueID+'-'+k+'" class="save_comment_ btn btn-xs badge badge-success">Salvar</a></div>'+
                            '</div>'+
                            
                            /*'<div class="row" style="margin: 10px 0px 0px 0px;background: rgb(251, 251, 251);padding: 10px;" id="image_box_'+uniqueID+'-'+k+'">'+
                                '<h5 style="width:100%;marging-bottom:15px;">Imagem</h5>'+
                                '<div class="col-3" ><a href="javascript:edit_image(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="edit_image_"><i class="icon-pencil f-s-16"></i></a><h6 id="'+uniqueID+'-'+k+'" class="remove_img" style="right: 0px;position: absolute;margin-top: -25px;margin-right: 10px;font-weight: 800;border-radius: 50%;padding: 2px 8px 2px 8px;font-size: 14px;cursor:pointer;color: red;">X</h6></h6>'+
                                '<a style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="carregar_imagem" href="javascript:call_img(`'+uniqueID+'-'+k+'`)">'+
                                    '<img id="image_form_'+uniqueID+'-'+k+'" src="images/noimage.png" alt="" class="img-fluid">'+
                                '</a>'+
                                '<div style="height:5px;border-radius:10px;width:0%" class="progress-img-1 progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                                '<span style="position: absolute;margin-top: -7px;color: green;font-weight: 400;font-size: 13px;    text-align: center;margin-left: 3px;" id="stat_img_1"></span>'+
                                '<input type="file" style="display:none;" id="'+uniqueID+'-'+k+'" class="img_file img_file_'+uniqueID+'-'+k+'" name="img_file_'+uniqueID+'-'+k+'">'+
                                '<div id="badge_save_'+uniqueID+'-'+k+'" style="display:none;" class="bootstrap-badge"><a href="javascript:save_img_bd(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" class="save_img_bd_" id="'+uniqueID+'-'+k+'"  ><span style="width:100%;" class="badge badge-success">Salvar Imagem</span></a></div>'
                             '<div>'+*/
                            '</div>'+
                        
                        
                        '</div>';
                        

                case 'textarea':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-textarea">' +
                        '<label for="textarea-' + uniqueID + '" class="block-title"></label>' +
                        '<textarea class="form-control form-control-lg" name="textarea-'+ uniqueID +'-'+k+'"  id="textarea-' + uniqueID +'-'+k+'"></textarea>' +
                       
                        
                        '</div>';

                case 'select':
                    return '' +
                        '<div id="sjfb-' + uniqueID + '" class="sjfb-field sjfb-select">' +
                        '<label for="select-' + uniqueID + '" class="block-title"></label>' +
                        '<select name="select-' + uniqueID +'-'+k+'" id="select-' + uniqueID +'-'+k+'" class="form-control choices choices-select"></select>' +
                        
                        '<div class="post-input no-print" style="text-align: right;margin-top: 10px;"> <a href="javascript:toogle_element(`text_comment_'+uniqueID+'-'+k+'`)"><i class="ti-comments"></i> </a><a href="javascript:toogle_element(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-camera"></i> </a><a href="javascript:open_pa(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-alert"></i> </a></div>'+
                            
                            '<div style="margin: 10px 0px 0px 0px;background: rgb(251, 251, 251);padding: 10px;" class="ticket-widget" id="text_comment_'+uniqueID+'-'+k+'">'+
                                '<h5>Comentário</h5>'+
                                '<textarea  id="comment_'+uniqueID+'-'+k+'" name="textarea" class="form-control" placeholder=""></textarea>'+
                                '<div style="margin-top:10px;"><a href="javascript:save_comment(`'+uniqueID+'-'+k+'`)" id="'+uniqueID+'-'+k+'" class="save_comment_ btn btn-xs badge badge-success">Salvar</a></div>'+
                            '</div>'+
                            
                            '<div class="row" style="margin: 10px 0px 0px 0px;background: rgb(251, 251, 251);padding: 10px;" id="image_box_'+uniqueID+'-'+k+'">'+
                                '<h5 style="width:100%;marging-bottom:15px;">Imagem</h5>'+
                                /*'<div class="col-3" ><a href="javascript:edit_image(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="edit_image_"><i class="icon-pencil f-s-16"></i></a><h6 id="'+uniqueID+'-'+k+'" class="remove_img" style="right: 0px;position: absolute;margin-top: -25px;margin-right: 10px;font-weight: 800;border-radius: 50%;padding: 2px 8px 2px 8px;font-size: 14px;cursor:pointer;color: red;">X</h6></h6>'+
                                '<a style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="carregar_imagem" href="javascript:call_img(`'+uniqueID+'-'+k+'`)">'+
                                    '<img id="image_form_'+uniqueID+'-'+k+'" src="images/noimage.png" alt="" class="img-fluid">'+
                                '</a>'+
                                '<div style="height:5px;border-radius:10px;width:0%" class="progress-img-1 progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                                '<span style="position: absolute;margin-top: -7px;color: green;font-weight: 400;font-size: 13px;    text-align: center;margin-left: 3px;" id="stat_img_1"></span>'+
                                '<input type="file" style="display:none;" id="'+uniqueID+'-'+k+'" class="img_file img_file_'+uniqueID+'-'+k+'" name="img_file_'+uniqueID+'-'+k+'">'+
                                '<div id="badge_save_'+uniqueID+'-'+k+'" style="display:none;" class="bootstrap-badge"><a href="javascript:save_img_bd(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" class="save_img_bd_" id="'+uniqueID+'-'+k+'"  ><span style="width:100%;" class="badge badge-success">Salvar Imagem</span></a></div>'
                             '<div>'+ */
                            
                             '</div>'+
                        
                        
                        
                        
                        '</div>';

                case 'radio':
                    return '' +
                        '<div id="sjfb-' + uniqueID +'-'+k+'" class="list sjfb-field sjfb-radio">' +
                        '<label class="block-title"></label>' +
                        '<li class="choices choices-radio"></li>' +
                        
                        '<div class="post-input no-print" style="text-align: right;margin-top: 10px;"> <a href="javascript:toogle_element(`text_comment_'+uniqueID+'-'+k+'`)"><i class="ti-comments"></i> </a><a href="javascript:toogle_element(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-camera"></i> </a><a href="javascript:open_pa(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-alert"></i> </a></div>'+
                            
                            '<div style="margin: 10px 0px 0px 0px;background: rgb(251, 251, 251);padding: 10px;" class="ticket-widget" id="text_comment_'+uniqueID+'-'+k+'">'+
                                '<h5>Comentário</h5>'+
                                '<textarea  id="comment_'+uniqueID+'-'+k+'" name="textarea" class="form-control" placeholder=""></textarea>'+
                                '<div style="margin-top:10px;"><a href="javascript:save_comment(`'+uniqueID+'-'+k+'`)" id="'+uniqueID+'-'+k+'" class="save_comment_ btn btn-xs badge badge-success">Salvar</a></div>'+
                            '</div>'+
                            
                            '<div class="row" style="margin: 10px 0px 0px 0px;background: rgb(251, 251, 251);padding: 10px;" id="image_box_'+uniqueID+'-'+k+'">'+
                                '<h5 style="width:100%;marging-bottom:15px;">Imagem</h5>'+
                                /*'<div class="col-3" ><a href="javascript:edit_image(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="edit_image_"><i class="icon-pencil f-s-16"></i></a><h6 id="'+uniqueID+'-'+k+'" class="remove_img" style="right: 0px;position: absolute;margin-top: -25px;margin-right: 10px;font-weight: 800;border-radius: 50%;padding: 2px 8px 2px 8px;font-size: 14px;cursor:pointer;color: red;">X</h6></h6>'+
                                '<a style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="carregar_imagem" href="javascript:call_img(`'+uniqueID+'-'+k+'`)">'+
                                    '<img id="image_form_'+uniqueID+'-'+k+'" src="images/noimage.png" alt="" class="img-fluid">'+
                                '</a>'+
                                '<div style="height:5px;border-radius:10px;width:0%" class="progress-img-1 progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                                '<span style="position: absolute;margin-top: -7px;color: green;font-weight: 400;font-size: 13px;    text-align: center;margin-left: 3px;" id="stat_img_1"></span>'+
                                '<input type="file" style="display:none;" id="'+uniqueID+'-'+k+'" class="img_file img_file_'+uniqueID+'-'+k+'" name="img_file_'+uniqueID+'-'+k+'">'+
                                '<div id="badge_save_'+uniqueID+'-'+k+'" style="display:none;" class="bootstrap-badge"><a href="javascript:save_img_bd(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" class="save_img_bd_" id="'+uniqueID+'-'+k+'"  ><span style="width:100%;" class="badge badge-success">Salvar Imagem</span></a></div>'
                             '<div>'+*/
                            '</div>'+
                        
                        
                        '</div>';

                case 'checkbox':
                    return '' +
                        '<div id="sjfb-checkbox-'+uniqueID +'-'+k+ '" class="list sjfb-field sjfb-checkbox">' +
                        '<label class="sjfb-label block-title"></label>' +
                        '<li class="choices choices-checkbox"></li>' +
                        
                        '<div class="post-input no-print" style="text-align: right;margin-top: 10px;"> <a href="javascript:toogle_element(`text_comment_'+uniqueID+'-'+k+'`)"><i class="ti-comments"></i> </a><a href="javascript:toogle_element(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-camera"></i> </a><a href="javascript:open_pa(`image_box_'+uniqueID+'-'+k+'`)"><i class="ti-alert"></i> </a></div>'+
                            
                            '<div class="row" style="margin: 10px 0px 0px 0px;background: rgb(251, 251, 251);padding: 10px;" class="ticket-widget" id="text_comment_'+uniqueID+'-'+k+'">'+
                                '<h5>Comentário</h5>'+
                                '<textarea  id="comment_'+uniqueID+'-'+k+'" name="textarea" class="form-control" placeholder=""></textarea>'+
                                '<div style="margin-top:10px;"><a href="javascript:save_comment(`'+uniqueID+'-'+k+'`)" id="'+uniqueID+'-'+k+'" class="save_comment_ btn btn-xs badge badge-success">Salvar</a></div>'+
                            '</div>'+
                            
                            '<div style="margin: 10px 0px 0px 0px;background: rgb(251, 251, 251);padding: 10px;" id="image_box_'+uniqueID+'-'+k+'">'+
                                '<h5 style="width:100%;marging-bottom:15px;">Imagem</h5>'+
                                /*'<div class="col-3" ><a href="javascript:edit_image(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="edit_image_"><i class="icon-pencil f-s-16"></i></a><h6 id="'+uniqueID+'-'+k+'" class="remove_img" style="right: 0px;position: absolute;margin-top: -25px;margin-right: 10px;font-weight: 800;border-radius: 50%;padding: 2px 8px 2px 8px;font-size: 14px;cursor:pointer;color: red;">X</h6></h6>'+
                                '<a style="cursor:pointer;" id="'+uniqueID+'-'+k+'" class="carregar_imagem" href="javascript:call_img(`'+uniqueID+'-'+k+'`)">'+
                                    '<img id="image_form_'+uniqueID+'-'+k+'" src="images/noimage.png" alt="" class="img-fluid">'+
                                '</a>'+
                                '<div style="height:5px;border-radius:10px;width:0%" class="progress-img-1 progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                                '<span style="position: absolute;margin-top: -7px;color: green;font-weight: 400;font-size: 13px;    text-align: center;margin-left: 3px;" id="stat_img_1"></span>'+
                                '<input type="file" style="display:none;" id="'+uniqueID+'-'+k+'" class="img_file img_file_'+uniqueID+'-'+k+'" name="img_file_'+uniqueID+'-'+k+'">'+
                                '<div id="badge_save_'+uniqueID+'-'+k+'" style="display:none;" class="bootstrap-badge"><a href="javascript:save_img_bd(`'+uniqueID+'-'+k+'`)" style="cursor:pointer;" class="save_img_bd_" id="'+uniqueID+'-'+k+'"  ><span style="width:100%;" class="badge badge-success">Salvar Imagem</span></a></div>'
                             '<div>'+*/
                            '</div>'+
                        
                        
                        '</div>';

                case 'agree':
                    return '' +
                        '<div id="sjfb-agree-' + uniqueID +'" class="sjfb-field sjfb-agree required-field">' +
                        '<input name="checkbox-' + uniqueID +'-'+k+'" type="checkbox" required>' +
                        '<label class="block-title"></label>' +
                        '</div>'
            }
        }
    });



}
   

function call_img(id){
    $('.img_file_'+id+'').click();

    $(".remove_img").click(function(){ 
        var id = this.id;
        $("#image_form_"+id+"").attr("src", 'images/noimage.png');
        $('.img_file_'+id+'').val(""); 
        $("#badge_save_"+id+"").hide();
    
    });

}

function save_comment(id){
    
        var id_booking = $('#id_atividade').val();
        var comment = $('#comment_'+id+'').val();
        
    $.ajax({
        url:  "includes/atividade/upload_comment_form",
        type : 'POST',
        dataType: 'JSON',
        data: {
            id_booking: id_booking,
            id_element: id,
            comment: comment
        },
        success: function(response){
            status = response.status;
            var new_comment = "";
            if(status == "SUCCESS") {
                var last_date = response.last_date;
                var last_id = response.last_id;

                $(".loading").hide();
                toastr.success('Salvo com Sucesso!', 'Sucesso');

                new_comment = '<ul id="ul_text_comment_'+id+'_'+last_id+'" class="mt-4 mb-4"><li >'+comment+'<br><small>'+last_date+'</small><h6 id="text_comment_'+id+'@'+last_id+'" class="remove_comment_line" style="right: 0px;position: absolute;margin-top: -25px;margin-right: 10px;font-weight: 800;border-radius: 50%;padding: 2px 8px 2px 8px;font-size: 14px;cursor:pointer;color: red;">X</h6></li></ul>';
                $('#text_comment_'+id+'').prepend(new_comment);
                $(".remove_comment_line").click(function(){ 
                var id = this.id;
                var res = id.split("@");
                var id_ = res[1];
                var element = res[0];
                var imagem = 'images/nouser.png';
                information = '<div class="user-info">'+
                                    '<div class="image"><a class="waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                                    '<div class="detail">'+
                                        '<h5>Você deseja remover este comentário ?</h5>'+
                                        '<h4><strong>Olá</strong></h4>'+
                                    '</div>'+
                                '</div>';
                
                swal({
                    html: information,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, remover!',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    
                    preConfirm: function() {
                    return new Promise(function(resolve) {
                        
                        $.ajax({
                            url: 'includes/atividade/delete_comment',
                            type: 'POST',
                            dataType:"json",
                            data: {
                                id : id_
                            }
                        })
                        .done(function(response){
                            var json = response;
                            status = json.status;
                            status_txt = json.status_txt;
                            //swal('Removido!', status_txt, status);
                            swal.close(); 
                            $('#ul_'+element+'_'+id_).remove();
                            toastr.success(status_txt, 'Sucesso');  

                        })
                        .fail(function(){
                            swal('Oops...', 'Erro ao deletar!', 'error');
                        });
                    });
                    },
                    allowOutsideClick: false			  
                });	
            
            });

                

            } else {
                toastr.error('Erro ao Salvar o comentário', 'Sucesso');

            }

        }
    }); 
}

function open_image(src_img){
    $("#EditImage").modal();
    var imgsrc = $( '#image_form_'+id).attr( 'src' ); 
    var imagem_anexo = imgsrc;

    //$('.js-signature').html('<img src="'+src_img+'" >')
}

function edit_image(id){
    //var id = this.id;

           $("#EditImage").modal();
            $('#jq-signature-canvas-1').jqSignature('clearCanvas');
            var myCanvas = document.getElementById("jq-signature-canvas-1");
            if(myCanvas){
            var ctx = myCanvas.getContext('2d');
                ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
            }

            var imgsrc = $( '#image_form_'+id).attr( 'src' ); 
            var imagem_anexo = imgsrc;
            $('#imagem_anexo_dummy').val(imagem_anexo);
            $('#id_imagem').val('id_imagem');
            $('#image_name').val('image_name');
            $('#type_').val('type_');
            
            setTimeout(function(){  
                if ($('.js-signature').length) {
                    $('.js-signature').jqSignature();
                    setTimeout(function(){  
                        var canvas = document.getElementById('jq-signature-canvas-1');
                        var context = canvas.getContext('2d');
                        var imageObj = new Image();
                        var background = new Image();
                    }, 1000);
                    
                    var canvas = document.getElementById('jq-signature-canvas-1');
                    var context = canvas.getContext('2d');
                    var background = new Image();
                    background.src = imagem_anexo;
                    background.onload = function() {
                        fitImageOn(canvas, background);
                    }

                    var fitImageOn = function(canvas, imageObj) {
                    var imageAspectRatio = imageObj.width / imageObj.height;
                    var canvasAspectRatio = canvas.width / canvas.height;
                    var renderableHeight, renderableWidth, xStart, yStart;

                    if(imageAspectRatio < canvasAspectRatio) {
                        renderableHeight = canvas.height;
                        renderableWidth = imageObj.width * (renderableHeight / imageObj.height);
                        xStart = (canvas.width - renderableWidth) / 2;
                        yStart = 0;
                    }
                    else if(imageAspectRatio > canvasAspectRatio) {
                        renderableWidth = canvas.width
                        renderableHeight = imageObj.height * (renderableWidth / imageObj.width);
                        xStart = 0;
                        yStart = (canvas.height - renderableHeight) / 2;
                    }
                    else {
                        renderableHeight = canvas.height;
                        renderableWidth = canvas.width;
                        xStart = 0;
                        yStart = 0;
                    }
                    context.drawImage(imageObj, xStart, yStart, renderableWidth, renderableHeight);
                    }; 
                    
                }
            
            }, 300);

            
            $("#clearBtn").click(function(e){
                e.preventDefault();
               // $("#EditImage").modal('hide');
                setTimeout(function(){  
                if ($('.js-signature').length) {
                    $('.js-signature').jqSignature();
                    setTimeout(function(){  
                        var canvas = document.getElementById('jq-signature-canvas-1');
                        var context = canvas.getContext('2d');
                        var imageObj = new Image();
                        var background = new Image();
                        background.src = "";
                
                }, 2000);
                    
                    var canvas = document.getElementById('jq-signature-canvas-1');
                    var context = canvas.getContext('2d');
                    var background = new Image();
                    background.src = imagem_anexo;
                    background.onload = function() {
                        fitImageOn(canvas, background);
                    }

                    var fitImageOn = function(canvas, imageObj) {
                    var imageAspectRatio = imageObj.width / imageObj.height;
                    var canvasAspectRatio = canvas.width / canvas.height;
                    var renderableHeight, renderableWidth, xStart, yStart;

                    // If image's aspect ratio is less than canvas's we fit on height
                    // and place the image centrally along width
                    if(imageAspectRatio < canvasAspectRatio) {
                        renderableHeight = canvas.height;
                        renderableWidth = imageObj.width * (renderableHeight / imageObj.height);
                        xStart = (canvas.width - renderableWidth) / 2;
                        yStart = 0;
                    }

                    // If image's aspect ratio is greater than canvas's we fit on width
                    // and place the image centrally along height
                    else if(imageAspectRatio > canvasAspectRatio) {
                        renderableWidth = canvas.width
                        renderableHeight = imageObj.height * (renderableWidth / imageObj.width);
                        xStart = 0;
                        yStart = (canvas.height - renderableHeight) / 2;
                    }

                    // Happy path - keep aspect ratio
                    else {
                        renderableHeight = canvas.height;
                        renderableWidth = canvas.width;
                        xStart = 0;
                        yStart = 0;
                    }
                    context.drawImage(imageObj, xStart, yStart, renderableWidth, renderableHeight);
                    }; 

                
                }
            
            }, 300);
            });
            

            $("#saveBtn2").click(function(e){
                e.preventDefault();
                var canvas = document.getElementById("jq-signature-canvas-1");
                var ctx=canvas.getContext("2d");
                var url = canvas.toDataURL();
                var image_data = canvas.toDataURL("image/jpg")
                var newImg = document.createElement("img"); // create img tag
                newImg.src = url;
                //document.getElementById('save_remote_data').value = image_data
                $("#image_form_"+id+" ").attr("src", image_data);
                $("#EditImage").modal('hide');
                id = "";
                //$('#sendBtn2').show();
            });


            

        function getPosition(mouseEvent, sigCanvas) {
            var x, y;
            var rect = sigCanvas.getBoundingClientRect();
            return {
            X: mouseEvent.clientX - rect.left,
            Y: mouseEvent.clientY - rect.top
            };
        }
        function clearCanvas() {
            $('#signature').html('<p><em>Your signature will appear here when you click "Save Signature"</em></p>');
            $('.js-signature').eq(1).jqSignature('clearCanvas');
            $('#saveBtn').attr('disabled', true);
        }

        function saveSignature2() {
            $('#signature').empty();
            var dataUrl = $('.js-signature').eq(1).jqSignature('getDataURL');
            var img = $('<img>').attr('src', dataUrl);
            $('#signature').append($('<p>').text("Here's your signature:"));
            $('#signature').append(img);
        }

        $('.js-signature').eq(1).on('jq.signature.changed', function() {
            $('#saveBtn').attr('disabled', false);
        });
}

function save_img_bd(id){
        id_imagem = id;
        image_data = $("#image_form_"+id+"").attr("src");
        var id_booking = $('#id_atividade').val();

        $.ajax({
            url:  "includes/atividade/upload_image_form",
            type : 'POST',
            dataType: 'JSON',
            data: {
            image_data: image_data,
            id_imagem: id_imagem,
            id_booking: id_booking,
            },
            success: function(response){
                status = response.status;
                if(status == "SUCCESS") {
                    image_data = "";
                    id_imagem = "";
                    $(".loading").hide();
                    toastr.success('Editado com Sucesso!', 'Sucesso');
                    var myCanvas = document.getElementById("jq-signature-canvas-1");
                    if(myCanvas == null){} else {
                        $('.jq-signature').jqSignature('clearCanvas');
                        var ctx = myCanvas.getContext('2d');
                        ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
                        setTimeout(function(){
                            $("#EditImage").modal('hide');
                        }, 50); 
                    }
                    
                } else {
                    toastr.error('Erro ao Editar a Imagem', 'Sucesso');

                }

            }
        }); 
   
}



function toogle_element(element){
    $('#'+element+'').toggle(250);
    $(".img_file").change(function(){ 
        var id = this.id;
        var file = event.target.files;
        setTimeout(function(){  
            if(file != 'undefined'){
                var file_size = file[0].size ; 
                var file_type = file[0].type ; 
                var max_size = parseInt(5000);
                file_size = parseInt((file_size/1024));
                if(file_type == 'image/png' || file_type == 'image/jpeg' || file_type == 'image/jpg'){
                } else {
                    toastr.error('Somente Arquivos PNG ou JPG', 'Erro!');
                    $("#image_form_"+id+"").attr("src", 'images/noimage.png');
                    file = "";
                    return;
                }
                if(max_size <= file_size ){
                    toastr.error('Arquivo Máximo de 5MB', 'Erro!');
                    $("#image_form_"+id+"").attr("src", 'images/noimage.png');
                    file = "";
                    return;
                } 
            }
        }, 30);
        
        if(file){
            $(".progress").css("width", "0px");
            var reader = new FileReader();
            reader.onload = function(e){
            $("#image_form_"+id+" ").attr("src", e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            $('#badge_save_'+id+'').show();
            return;
        }  

         // SAVE IMAGE ADDED
         $(".save_img_bd").click(function(e){
              e.preventDefault();
              var image_data = "";
              var id = this.id;
              id_imagem = id;
              image_data = $("#image_form_"+id+"").attr("src");
              var id_booking = $('#id_atividade').val();

              $.ajax({
                    url:  "includes/atividade/upload_image_form",
                    type : 'POST',
                    dataType: 'JSON',
                    data: {
                    image_data: image_data,
                    id_imagem: id_imagem,
                    id_booking: id_booking,
                    },
                    success: function(response){
                        status = response.status;
                        if(status == "SUCCESS") {
                            image_data = "";
                            id_imagem = "";
                            $('#save_remote_data').val('');
                            $('#image_name').val('');
                            $('#id_imagem').val('');
                            $(".loading").hide();
                            toastr.success('Editado com Sucesso!', 'Sucesso');
                            $('#sendBtn2').hide();
                            $('.jq-signature').jqSignature('clearCanvas');
                            var myCanvas = document.getElementById("jq-signature-canvas-1");
                            var ctx = myCanvas.getContext('2d');
                            ctx.clearRect(0, 0, myCanvas.width, myCanvas.height);
                            setTimeout(function(){
                                $("#EditImage").modal('hide');
                            }, 500); 

                        } else {
                            toastr.error('Erro ao Editar a Imagem', 'Sucesso');

                        }

                    }
                }); 
		    });
    
    
    });




    

}

setTimeout(function(){ 


var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
});
var saveButton = document.getElementById('save_sig1');
var cancelButton = document.getElementById('clear_sig1');

saveButton.addEventListener('click', function (event) {
    event.preventDefault();
    var data = signaturePad.toDataURL('image/png');
    //$('#dummy_sig_colab').val(data)
    //image_data = $("#dummy_sig_"+id+"").val();
        var id_booking = $('#id_atividade').val();

        setTimeout(function(){
            $.ajax({
                url:  "includes/atividade/upload_image_sign",
                type : 'POST',
                dataType: 'JSON',
                data: {
                image_data: data,
                id_imagem: 'sig_colab',
                id_booking: id_booking,
                },
                success: function(response){
                    status = response.status;
                    if(status == "SUCCESS") {
                        image_data = "";
                        id_imagem = "";
                        $(".loading").hide();
                        toastr.success('Editado com Sucesso!', 'Sucesso');
                        $('#box_action_sigcolab').hide();
                        
                    } else {
                        toastr.error('Erro ao Editar a Imagem', 'Sucesso');

                    }

                }
            }); 
        }, 500); 



});

cancelButton.addEventListener('click', function (event) {
    event.preventDefault();
    $('#dummy_sig_colab').val('')
    signaturePad.clear();
});


var signaturePadcli = new SignaturePad(document.getElementById('signature-pad-cli'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
});
var saveButton = document.getElementById('save_sigcli');
var cancelButton = document.getElementById('clear_sig1cli');

saveButton.addEventListener('click', function (event) {
    event.preventDefault();
    //var data_cli = signaturePadcli.toDataURL('image/png');
    //$('#dummy_sig_cli').val(data_cli)
    
    var data = signaturePadcli.toDataURL('image/png');
    //$('#dummy_sig_colab').val(data)
    //image_data = $("#dummy_sig_"+id+"").val();
        var id_booking = $('#id_atividade').val();
        setTimeout(function(){
            $.ajax({
                url:  "includes/atividade/upload_image_sign",
                type : 'POST',
                dataType: 'JSON',
                data: {
                image_data: data,
                id_imagem: 'sig_cli',
                id_booking: id_booking,
                },
                success: function(response){
                    status = response.status;
                    if(status == "SUCCESS") {
                        image_data = "";
                        id_imagem = "";
                        $(".loading").hide();
                        toastr.success('Editado com Sucesso!', 'Sucesso');
                        $('#box_action_sigcli').hide();
                        
                    } else {
                        toastr.error('Erro ao Editar a Imagem', 'Sucesso');

                    }

                }
            }); 
        }, 500); 
        

});

cancelButton.addEventListener('click', function (event) {
    event.preventDefault();
    $('#dummy_sig_cli').val('')
    signaturePadcli.clear();
});




setTimeout(function(){ 
    call_evidences(id_atividade);
}, 500);

function call_evidences(id_atividade) {
    $.ajax({
        url:  "includes/atividade/get_evi_result",
        type : 'GET',
        dataType: 'JSON',
        data :{
            id_atividade:id_atividade,
        },
        success: function(response){
           
           
            var status = response.status;
            
            if(status == 'SUCCESS'){
                var box = response.box;
                var comments = response.comments;
                var images = response.img_elements;
                var img_sign = response.img_sign;

                // OPEN ALL BOX WITH ELEMENTS 
                if(box != null){
                    var box_show = "";
                    for(var a = 0; a < box.length; a++){
                        box_show = box[a].box_;
                        $('#'+box_show).show();
                    }
                }
                
                // ADD ALL SAVED COMMENTS
                if(comments != null){
                    var comments_val = "";
                    var comments_target = "";
                    var date_create = "";
                    
                    var the_cooments = "";
                    
                  
                    for(var a = 0; a < comments.length; a++){
                        
                        comments_target = 'text_'+comments[a].target;
                        comments_val = comments[a].target_value;
                        date_create = comments[a].date_create;
                        id = comments[a].id;
                        
                        the_cooments += '<ul id="ul_'+comments_target+'_'+id+'" class="mt-4 mb-4">';
                        
                        
                        the_cooments += '<li >'+comments_val+'<br><small>'+date_create+'</small><h6 id="'+comments_target+'@'+id+'" class="remove_comment_line" style="right: 0px;position: absolute;margin-top: -25px;margin-right: 10px;font-weight: 800;border-radius: 50%;padding: 2px 8px 2px 8px;font-size: 14px;cursor:pointer;color: red;">X</h6></li>';
                        $('#'+comments_target).prepend(the_cooments);
                        the_cooments = "";
                        
                        the_cooments += '</ul>';
                    }
                    

                }
               
                
                // ADD ALL SAVED IMAGES
                if(images != null){
                    var src_img = "";
                    var target_img = "";
                    var the_images = ""; 
                    
                    for(var b = 0; b < images.length; b++){
                        src_img = images[b].src_img;
                        target_img = images[b].target_img;
                        target = images[b].target;
                        src_img = images[b].src_img;

                        console.log(target_img);
                        
                        
                        the_images += '<div class="col-3">'+
                            '<a style="cursor:pointer;" id="25-4" class="carregar_imagems" href="javascript:open_image(`'+src_img+'`)">'+
                            '<img id="image_form_25-4" src="'+src_img+'" alt="" class="img-fluid"></a>'+
                        '</div>';
                        
                        
                        $('#'+target).append(the_images);
                        the_images = "";
                        
                        
                        //$('#'+target_img).attr("src", src_img);
                    }
                }
                

                // ADD ALL SIGN
                var src_img_sign = "";
                var target_img_sign = "";
                for(var c = 0; c < img_sign.length; c++){
                    src_img_sign = img_sign[c].src_img;
                    target_img = img_sign[c].target_img;
                    fill_canvas(src_img_sign,target_img)
                }
            }
            
            

     

        }
    });

setTimeout(function(){

    $(".remove_comment_line").click(function(){ 
        var id = this.id;

        console.log(id)

        var res = id.split("@");


        
        var id_ = res[1];
        var element = res[0];

        console.log(id_)
        console.log(element)


       
        var imagem = 'images/nouser.png';
        information = '<div class="user-info">'+
                            '<div class="image"><a class="waves-effect waves-block"><img  style="width:120px;height:120px;border-radius:50%;" class="user_pic" src="'+imagem+'" alt="User"></a></div>'+
                            '<div class="detail">'+
                                '<h5>Você deseja remover este comentário ?</h5>'+
                                '<h4><strong>Olá</strong></h4>'+
                            '</div>'+
                        '</div>';
        
        swal({
            html: information,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, remover!',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            
            preConfirm: function() {
            return new Promise(function(resolve) {
                
                $.ajax({
                    url: 'includes/atividade/delete_comment',
                    type: 'POST',
                    dataType:"json",
                    data: {
                        id : id_
                    }
                })
                .done(function(response){
                    var json = response;
                    status = json.status;
                    status_txt = json.status_txt;
                    //swal('Removido!', status_txt, status);
                    swal.close(); 

                    console.log('#ul_'+element+'_'+id_)

                    // #ul_text_comment_25-1_25

                    $('#ul_'+element+'_'+id_).remove();
                    toastr.success(status_txt, 'Sucesso');  

                
                
                })
                .fail(function(){
                    swal('Oops...', 'Erro ao deletar!', 'error');
                });
            });
            },
            allowOutsideClick: false			  
        });	


        
    
    });




}, 500); 




}




function fill_canvas(img,target_img) {
    if(target_img == 'box_sig_colab'){
        var canvas = document.getElementById('signature-pad');
    } else {
        var canvas = document.getElementById('signature-pad-cli');
    }
    var context = canvas.getContext('2d');
    var imgPath = img;
    var imgObj = new Image();
    imgObj.src = imgPath;
    var x = 0;
    var y = 0;

    imgObj.onload = function(){
        context.drawImage(imgObj, x, y);
    } 
}

}, 200);


    </script>
</body>
</html>