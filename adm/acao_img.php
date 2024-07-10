<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();

    $acao = $_GET['acao'];
    $img_id = $_GET['imgid'];

    if($acao==1){
        $update_query = $conexao2->query("UPDATE `fotos_tb` SET `estado`= '3' WHERE ft_id = '$img_id'");
        if($update_query){
            echo "<script language ='javascript' type='text/javascript'>
            alert('Imagem Eliminada!'), window.location = 'g_galeria.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possível Eliminar a imagem.'), window.location = 'g_galeria.php'
            </script>";
            }
    }
?>