<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();

    $acao = $_GET['acao'];
    $solicitacao_id = $_GET['id'];
    $cliente_id = $_GET['cliente_id'];

    if($acao==1){
        $update_query = $conexao2->query("UPDATE `solicitacoes_tb` SET `estado`= '1' WHERE solicitacao_id = '$solicitacao_id'");
        if($update_query){
            $update_query_cliente = $conexao2->query("UPDATE `clientes_tb` SET `estado`= '1' WHERE cliente_id = '$cliente_id'");
            echo "<script language ='javascript' type='text/javascript'>
            alert('Solicitação aprovada!'), window.location = 'solicit.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possível executar a operação.'), window.location = 'solicit.php'
            </script>";
            }
    }elseif ($acao==2) {
        $update_query = $conexao2->query("UPDATE `solicitacoes_tb` SET `estado`= '3' WHERE solicitacao_id = '$solicitacao_id'");
        if($update_query){
            echo "<script language ='javascript' type='text/javascript'>
            alert('Solicitação Rejeitada'), window.location = 'solicit.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possível executar a operação'), window.location = 'solicit.php'
            </script>";
            }
    }

?>