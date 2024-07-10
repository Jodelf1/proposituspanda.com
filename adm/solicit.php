<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();
    $hoje = date('y/m/d');

    $adm_id = $_SESSION['adm'];


    $sql_query_solicit = $conexao2->query("SELECT * FROM solicitacoes_tb WHERE estado = '2' ORDER BY solicitacao_id DESC") or die($conexao2->error);
    $solicitacao = $sql_query_solicit->fetch_assoc();
    $total_solicit = $sql_query_solicit->num_rows;

    ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/ppstyle.css">
    <title>Gerir Serviços - Propositus Panda</title>
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
                    <li class="item_lateral ativo">
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
                <button id="logout_btn">
                    <ion-icon id="logout_btn_icon "name="log-out-outline"></ion-icon>
                    <span class="adm_description">
                        Terminar sessão
                    </span>
                </button>
            </div> 
        </nav>

        

        <div class="adm_main">
            <div class="cabecalho">
                <img src="../images/logo.jpg" alt="" class="logo">
            </div>
            <div class="novoservico">
                    <h1>Ver as solicitações de serviço</h1>
            </div>
            <br>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Serviço</th>
                    <th scope="col">Data</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        while($solicitacao = $sql_query_solicit->fetch_assoc()){

                            $servicosql = "SELECT nome FROM servicos_tb WHERE servico_id = $solicitacao[servico_id]";
                            $servico_query = $conexao2->query($servicosql) or die($conexao2->error);
                            $servico = $servico_query->fetch_assoc();

                            if ($solicitacao['visto']==0) {
                                ?>
                            
                    <tr>
                        <th class="bg-primary"><?php echo $solicitacao['solicitacao_id'] ?></th>
                        <td class="bg-primary"><?php echo $servico['nome']?></td>
                        <td class="bg-primary"><?php echo $solicitacao['data_solicitacao']?></td>
                        <td class="bg-primary"><a href="solicit_indiv.php?solicit_id=<?php echo $solicitacao['solicitacao_id'] ?>">Ver detalhes</a></td>
                    </tr>

                                <?php
                            }else {
                    ?>

                    <tr>
                        <th scope="row"><?php echo $solicitacao['solicitacao_id'] ?></th>
                        <td><?php echo $servico['nome'] ?></td>
                        <td><?php echo $solicitacao['data_solicitacao']?></td>
                        <td><a href="solicit_indiv.php?solicit_id=<?php echo $solicitacao['solicitacao_id'] ?>">Ver detalhes</a></td>
                    </tr>

                    <?php
                        }
                    }
                    ?>

                </tbody>
              </table>
            
        </div>
    <script src="../js/menu_script.js"></script>
</body>
</html>