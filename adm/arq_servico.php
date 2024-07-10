<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();
    $hoje = date('y/m/d');

    $adm_id = $_SESSION['adm'];

    $servicosql = "SELECT * FROM servicos_tb WHERE estado = '2'";
    $servico_query = $conexao2->query($servicosql) or die($conexao2->error);
    $servico = $servico_query->fetch_assoc();

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
            <div class="novocurso">
                <br>
                <ul class="list-group">
                    <a href="g_servicos.php">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Ver Serviços
                    </li></a>
                </ul>
                <br>
            
                <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Data de adição</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>

                    <?php
                        while($servico = $servico_query->fetch_assoc()){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $servico['servico_id'] ?></th>
                        <td><?php echo $servico['nome'] ?></td>
                        <td><?php echo $servico['data_pub'] ?></td>
                        <td><a href="javascript: if(confirm('Tem certeza que pretende apagar <?php echo addslashes($servico['nome'])?>? Este serviço deixará de aparecer para o público'))
                        location.href='acao_servico.php?servicoid=<?php echo $servico['servico_id'];?>&acao=1'" class="lixo"><ion-icon name="trash-outline"></ion-icon></a>
                        <a href="edit_curso.php?cursoid=<?php echo $servico['servico_id'];?>" class="edit"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="javascript: if(confirm('Tem certeza que pretende desarquivar <?php addslashes($servico['nome'])?>?'))
                        location.href='acao_servico.php?servicoid=<?php echo $servico['servico_id'];?>&acao=3'" class="arquivar"><ion-icon name="share-outline"></ion-icon></a></td>
                    </tr>

                    <?php
                        }
                    ?>

                </tbody>
              </table>
            
        </div>
    <script src="../js/menu_script.js"></script>
</body>
</html>