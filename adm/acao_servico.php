<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();

    $acao = $_GET['acao'];
    $servico_id = $_GET['servicoid'];

    if($acao==1){
        $update_query = $conexao2->query("UPDATE `servicos_tb` SET `estado`= '3' WHERE servico_id = '$servico_id'");
        $update_img_query = $conexao2->query("UPDATE `fotos_tb` SET `estado`= '3' WHERE servico_id = '$servico_id'");

        if($update_query){
            echo "<script language ='javascript' type='text/javascript'>
            alert('Serviço Eliminado!'), window.location = 'g_servicos.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possível Eliminar o serviço.'), window.location = 'g_servicos.php'
            </script>";
            }
    }elseif ($acao==2) {
        $update_query = $conexao2->query("UPDATE `servicos_tb` SET `estado`= '2' WHERE servico_id = '$servico_id'");
        $update_img_query = $conexao2->query("UPDATE `fotos_tb` SET `estado`= '2' WHERE servico_id = '$servico_id'");
        if($update_query){
            echo "<script language ='javascript' type='text/javascript'>
            alert('Serviço Arquivado!'), window.location = 'g_servicos.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possível arquivar o serviço.'), window.location = 'g_servicos.php'
            </script>";
            }
    }elseif ($acao==2) {
        $update_query = $conexao2->query("UPDATE `servicos_tb` SET `estado`= '1' WHERE servico_id = '$servico_id'");
        $update_img_query = $conexao2->query("UPDATE `fotos_tb` SET `estado`= '1' WHERE servico_id = '$servico_id'");
        if($update_query){
            echo "<script language ='javascript' type='text/javascript'>
            alert('Serviço Desarquivado!'), window.location = 'g_servicos.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possível desarquivar o serviço.'), window.location = 'g_servicos.php'
            </script>";
            }
    }

?>