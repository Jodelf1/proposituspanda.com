<?php
    if(!function_exists("protecao_adm")){
        function protecao_adm(){
            if(!isset($_SESSION))
            session_start();
            if(!isset($_SESSION['adm']) || !is_numeric($_SESSION['adm']))
                header("Location: ../login.php");
            }
    }
?>