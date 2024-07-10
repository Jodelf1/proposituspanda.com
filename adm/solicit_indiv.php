<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();

    $solicit_id = $_GET['solicit_id'];

    $adm_sql = "SELECT * FROM adm_tb WHERE adm_id = $_SESSION[adm]";
    $sql_query_adm = $conexao2->query($adm_sql) or die($conexao2->error);
    $adm = $sql_query_adm->fetch_assoc(); 

    $sql_query_solicit = $conexao2->query("SELECT * FROM solicitacoes_tb WHERE solicitacao_id = '$solicit_id'") or die($conexao2->error);
    $solicitacao = $sql_query_solicit->fetch_assoc();

    $sql_query_cliente = $conexao2->query("SELECT * FROM clientes_tb WHERE cliente_id = '$solicitacao[cliente_id]'") or die($conexao2->error);
    $cliente = $sql_query_cliente->fetch_assoc();

    if ($solicitacao['visto']==0) {
        $update_query = $conexao2->query("UPDATE `solicitacoes_tb` SET `visto`= '1' WHERE solicitacao_id = '$solicit_id'");
    }

    if(isset($_POST['publicar'])){  
        
    }   
        ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/ppstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Administrador - Propositus Panda</title>

</head>
<body>
    <div class="main_adm">
        
        <nav id="menu_lateral">
            <div id="menu_lateral_content">
                <div class="adm_user" id="adm_user">
                    <img src="../images/user.png" alt="" id="adm_avatar">
                    <p id="adm_infos">
                        <span class="adm_description">
                            <?php echo $adm['nome'];?>
                        </span>
                        <span class="adm_description">
                            <?php echo $adm['email'];?>
                        </span>
                    </p>
                </div>
                <ul id="itens_laterais">
                    <li class="item_lateral">
                        <a href="index.php">
                            <ion-icon name="home-outline"></ion-icon>
                            <span class="adm_description">
                                Início
                            </span>
                        </a>
                    </li>
                    <li class="item_lateral">
                        <a href="g_servicos.php">
                            <ion-icon name="build-outline"></ion-icon>
                            <span class="adm_description">
                                Serviços
                            </span>
                        </a>
                    </li>
                    <li class="item_lateral ativo">
                        <a href="g_cursos.php">
                            <ion-icon name="book-outline"></ion-icon>
                            <span class="adm_description">
                                Cursos
                            </span>
                        </a>
                    </li>
                    <li class="item_lateral ">
                        <a href="g_galeria.php">
                            <ion-icon name="images-outline"></ion-icon>
                            <span class="adm_description">
                                Galeria
                            </span>
                        </a>
                    </li>
                    <li class="item_lateral">
                        <a href="g_clientes.php">
                            <ion-icon name="people-outline"></ion-icon>
                            <span class="adm_description">
                                Clientes
                            </span>
                        </a>
                    </li>
                </ul>
        
                <button id="open_btn">
                    <ion-icon id="open_btn_icon" name="chevron-forward-outline"></ion-icon>
                </button>
            </div>   
            <div id="logout">
            <a href="../config/logout.php"><button id="logout_btn">
                    <ion-icon id="logout_btn_icon "name="log-out-outline"></ion-icon>
                    <span class="adm_description">
                        Terminar sessão
                    </span>
                </button></a>
            </div> 
        </nav>

        <div class="adm_main">
            <div class="cabecalho">
                <img src="../images/logo.jpg" alt="" class="logo">
            </div>
            <div class="novocurso">
            
                <form action="" method="post" enctype="multipart/form-data">
                    <h2>Informações do cliente</h2>
                    <p class="nome"><strong>Nome:</strong> <?php echo $cliente['nome'];?></p>
                    <p class="numero"><strong>Número:</strong> </strong><?php echo $cliente['tel_num'];?></p>
                    <p class="email"><strong>Email:</strong> <?php echo $cliente['email'];?></p>
                    <p class="email"><strong>NIF:</strong> <?php echo $cliente['NIF'];?></p>
                    <h2>Informações da solicitação</h2>

                    <p class="descricao"><strong>Descricão:</strong> <?php echo $solicitacao['descricao'];?></p>
                    <p><strong>Data:</strong> <?php echo $solicitacao['data_solicitacao'];?></p>

                    
                </form>
                <a href="javascript: if(confirm('Tem certeza que pretende aceitar esta solicitação?'))
                        location.href='acao_solicit.php?id=<?php echo $solicitacao['solicitacao_id'];?>&acao=1&cliente_id=<?php echo $cliente['cliente_id'];?>'"><button type="button" class="btn btn-success">Aceitar</button></a>
                <a href="javascript: if(confirm('Tem certeza que pretende rejeitar esta solicitação?'))
                        location.href='acao_solicit.php?id=<?php echo $solicitacao['solicitacao_id'];?>&acao=2&cliente_id=<?php echo $cliente['cliente_id'];?>'"><button type="button" class="btn btn-danger">Rejeitar</button></a>
            </div>
            <br>
            
        </div>
    <script src="../js/menu_script.js"></script>
</body>
</html>