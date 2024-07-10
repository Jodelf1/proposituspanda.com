<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();

    $acao = $_GET['acao'];
    $cliente_id = $_GET['cliente_id'];

    if($acao==1){
        $update_query = $conexao2->query("UPDATE `clientes_tb` SET `estado`= '3' WHERE clientes_id = '$cliente_id'");
        if($update_query){
            echo "<script language ='javascript' type='text/javascript'>
            alert('Cliente Removido!'), window.location = 'g_galeria.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possive remover o cliente!'), window.location = 'g_galeria.php'
            </script>";
            }
    }
?>