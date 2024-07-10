<?php
    include("../config/conexao.php");
    session_start();
    include ("../config/protect.php");
    protecao_adm();

    $adm_sql = "SELECT * FROM adm_tb WHERE adm_id = $_SESSION[adm]";
    $sql_query_adm = $conexao2->query($adm_sql) or die($conexao2->error);
    $adm = $sql_query_adm->fetch_assoc(); 

    $sql_query_solicit = $conexao2->query("SELECT * FROM solicitacoes_tb WHERE visto = '0'") or die($conexao2->error);
    $total_solicit = $sql_query_solicit->num_rows;

    $sql_query_clientes = $conexao2->query("SELECT * FROM clientes_tb WHERE estado = '1'") or die($conexao2->error);
    $total_clientes = $sql_query_clientes->num_rows;

    $sql_query_visitas = $conexao2->query("SELECT * FROM visitas_tb") or die($conexao2->error);
    $total_visitas = $sql_query_visitas->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/ppstyle.css">
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
                    <img src="../assets/img/user.png" alt="" id="adm_avatar">
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
                    <li class="item_lateral ativo" class="ativo">
                        <a href="">
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
                    <li class="item_lateral">
                        <a href="g_cursos.php">
                            <ion-icon name="book-outline"></ion-icon>
                            <span class="adm_description">
                                Cursos
                            </span>
                        </a>
                    </li>
                    <li class="item_lateral">
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
                <img src="../assets/img/logo.jpg" alt="" class="logo">
            </div>
            <h1>Seja Bem-vindo <strong><?php echo $adm['nome']; ?></strong></h1>
            <div class="some_adm_mainpage_views">
                <div class="v_adm">
                    <ion-icon name="eye-outline"></ion-icon>
                    <div>
                        <p class="name_view">Visitas</p>
                        <p class="number_view"><?php echo $total_visitas;?></p>
                    </div>
                </div>
                <div class="v_adm">
                    <ion-icon name="mail-outline"></ion-icon>
                    <div>
                        <p class="name_view">Novas solicitações</p>
                        <p class="number_view"><?php echo $total_solicit;?></p>
                    </div>
                </div>
                <div class="v_adm">
                    <ion-icon name="briefcase-outline"></ion-icon>
                    <div>
                        <p class="name_view">Clientes</p>
                        <p class="number_view"><?php echo $total_clientes;?></p>
                    </div>
                </div>
            </div>

            <h2>Outras ações</h2>
            <div class="some_adm_mainpage_links">
                <a href="g_servicos.php"><div class="l_adm">
                    <ion-icon name="build-outline"></ion-icon>
                    <p>Gerir Serviços</p>
                </div></a>
                <a href="g_galeria.php"><div class="l_adm">
                    <ion-icon name="images-outline"></ion-icon>
                    <p>Gerir imagens</p>
                </div></a>
                <a href="g_clientes.php"><div class="l_adm">
                    <ion-icon name="people-outline"></ion-icon>
                    <p>Gerir Clientes</p>
                </div></a>
                <a href="g_cursos.php"><div class="l_adm">
                    <ion-icon name="book-outline"></ion-icon>
                    <p>Gerir Cursos</p>
                </div></a>
            </div>
    </div>
    <script src="../assets/js/menu_script.js"></script>
</body>
</html>