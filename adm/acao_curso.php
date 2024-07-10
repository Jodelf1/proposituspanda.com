<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();

    $acao = $_GET['acao'];
    $curso_id = $_GET['cursoid'];

    if($acao==1){
        $update_query = $conexao2->query("UPDATE `cursos_tb` SET `estado`= '3' WHERE curso_id = '$curso_id'");
        if($update_query){
            echo "<script language ='javascript' type='text/javascript'>
            alert('Curso Eliminado!'), window.location = 'g_cursos.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possível Eliminar o curso.'), window.location = 'g_cursos.php'
            </script>";
            }
    }elseif ($acao==2) {
        $update_query = $conexao2->query("UPDATE `cursos_tb` SET `estado`= '2' WHERE curso_id = '$curso_id'");
        if($update_query){
            echo "<script language ='javascript' type='text/javascript'>
            alert('Curso Arquivado!'), window.location = 'g_cursos.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possível arquivar o curso.'), window.location = 'g_cursos.php'
            </script>";
            }
    }elseif ($acao==3) {
        $update_query = $conexao2->query("UPDATE `cursos_tb` SET `estado`= '1' WHERE curso_id = '$curso_id'");
        if($update_query){
            echo "<script language ='javascript' type='text/javascript'>
            alert('Curso Desarquivado!'), window.location = 'g_cursos.php'
            </script>";
            }else{
            echo "<script language ='javascript' type='text/javascript'>
            alert('Não foi possível desarquivar o curso.'), window.location = 'g_cursos.php'
            </script>";
            }
    }

?>