<?php
    include("./config/conexao.php");
    session_start();
    if(isset($_POST['email_l']) && strlen($_POST['email_l']) > 0){

        $_SESSION['email'] = $conexao2->escape_string($_POST['email_l']);
        $_SESSION['senha'] = ($_POST['senha_s']);
        
        
        $sql_adm = "SELECT senha, adm_id, sc FROM adm_tb WHERE email = '$_SESSION[email]'";
        $sql_query_adm = $conexao2->query($sql_adm) or die($conexao2->error);
        $dado_adm = $sql_query_adm->fetch_assoc();
        $total_adm = $sql_query_adm->num_rows;

            if($total_adm == 0){
                //se não existir o email na tabela dos adms -> verificar tabela de clientes

                $sql_cliente = "SELECT senha, cliente_id FROM clintes_tb WHERE email = '$_SESSION[email]'";
                $sql_query_clientes = $conexao2->query($sql_cliente) or die($conexao2->error);
                $dado_cliente = $sql_query_clientes->fetch_assoc();
                $total_cliente = $sql_query_clientes->num_rows;

                    if($total_cliente == 0){
                                    echo "AHAHAH";
                                    $erro[] = "Email ou Senha inválidos.";
                                
                                }elseif(password_verify($_SESSION['senha'],$dado_cliente['senha'])){
                                    //se existir o email na tabela das lojas:
                                    $_SESSION['cliente'] = $dado_loja['cliente_id'];
                                }else{
                                    //se a senha estiver errada [Loja]:
                                    echo "SOERRO";
                                    $erro[] = "Email ou Senha inválidos.";
                                }
                                if(!isset($erro)){
                                    echo "<script>
                                    location.href='./LJ/perfil.php';
                                    </script>";
                                }else{
                                    foreach($erro as $msg)
                                    echo "<script language ='javascript' type='text/javascript'>
                                    alert('$msg'), window.location = 'login.php'
                                    </script>";
                        }
        }else{
            if(password_verify($_SESSION['senha'],$dado_adm['senha'])){

                    $_SESSION['adm'] = $dado_adm['adm_id'];
                    $destino = "./adm/index.php";

            }else{
                echo "ERRODEMARD";
                $erro[] = "Email ou Senha inválidos.";
            }
        }
        if(!isset($erro)){
            echo "<script>
            location.href='$destino';
            </script>";
        }
        else{
           foreach($erro as $msg)
            echo "<script language ='javascript' type='text/javascript'>
            alert('$msg'), window.location = 'login.php'
            </script>";
        }
    }
//joestaar
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Login - Propositus Panda</title>
    <link rel="stylesheet" href="./css/ppstyle.css">
</head>
<body>
    <header class="topo">
        <div class="wtspace">
            <img src="./images/logo.jpg" class="logo" alt="Logotipo da propositus Panda">
        </div>
        <div class="blspace">
            <ul class="menu">
                <a href="./servicos.php"><li class="item ativo">Serviços</li></a>
                <a href="./cursos.php"><li class="item">Cursos</li></a>
                <a href="./galeria.php"><li class="item">Galeria de fotos</li></a>
                <a href="./index,.php"><li>Quem somos?</li></a>
            </ul>
        </div>
    </header>
    <div class="login_main">
        <br><br><br><br><br>
       
        <form action="" method="post" class="form_login">
            <img src="./images/login_elipse1.svg" alt="" class="login_elipse1">
            <img src="./images/login_elipse2.svg" alt="" class="login_elipse2">
            <div class="form_inputs">
                <h1>Entre em sua conta</h1>
                <br>
                <input type="email" name="email_l" id="" placeholder="Email " required>
                <input type="password" name="senha_s" id="" placeholder="Palavra-passe">
                <input type="submit" value="Entrar">
            </div>
            <div>
                <p>Ao entrar, terá acesso às solicitações que já enviou, e mais.</p>
            </div>
        </form>

    </div>
    </main>
<footer class="login_footer">
    <div class="cdts">© Propositus Panda 2024 | <strong>Desenvolvido por <a href="">Jodelfi Marimba</a></strong></div>
</footer>
</body>
</html>