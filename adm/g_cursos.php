<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();
    $hoje = date('y/m/d');

    $adm_id = $_SESSION['adm'];

    $cursosql = "SELECT * FROM cursos_tb WHERE estado = '1'";
    $curso_query = $conexao2->query($cursosql) or die($conexao2->error);
    $curso = $curso_query->fetch_assoc();
    $total = $curso_query->num_rows;

    if(isset($_POST['publicar'])){
    
            foreach($_POST as $chave => $valor)
            $_SESSION[$chave] = $valor;

            $erro = false;

            if(strlen($_SESSION['nome_curso']) == 0)
            $erro = "Preencha o nome do curso.";
    
            if(!isset($_SESSION['descricao_curso']))
            $erro = "Preencha a descrição do curso.";
    
            if(!isset($_SESSION['preco_in_curso']))
            $erro = 'Selecione o preço da inscrição do curso ';
    
            if(!isset($_SESSION['preco_curso']))
            $erro = 'Digite o preço do curso';   

            $ref= password_hash($_SESSION['nome_curso'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
    
            if($erro){
                echo "<script language ='javascript' type='text/javascript'>
                alert('$erro'), window.location = 'g_cursos.php'
                </script>";
            }else{
                $nome = addslashes($_SESSION['nome_curso']);
                $descricao = addslashes($_SESSION['descricao_curso']);
                   $publicar = "INSERT INTO `cursos_tb`(`nome`, `descricao`, `estado`, `prc_in`, `prc`, `data_pub`, `ref`) VALUES ('$nome','$descricao','2','$_SESSION[preco_in_curso]','$_SESSION[preco_curso]','$hoje','$ref')";
                    $confirmar = $conexao2->query($publicar) or die($conexao2->error);
                }
                    if($confirmar){
                            echo "<script language ='javascript' type='text/javascript'>
                            window.location = 'nxt_curso.php?ref=$ref'
                            </script>";
                        }else{
                            echo "<script language ='javascript' type='text/javascript'>
                            alert('Não foi possível publicar o curso.'), window.location = 'g_cursos.php'
                            </script>";
                        }
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
                    <a href="arq_curso.php">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Ver cursos arquivados
                    </li></a>
                </ul>
                <br>
                <form action="" method="post">
                    <h1>Registrar novo curso</h1>
                    <div class="form-row">
                        <div class="col">
                          <input type="text" class="form-control" name="nome_curso" placeholder="Digite aqui o nome do curso" required>
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="col">
                          <input type="number" class="form-control" name="preco_in_curso" placeholder="Digite aqui o preço de incrição do curso" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                          <input type="number" class="form-control" name="preco_curso" placeholder="Digite aqui o preço de incrição do curso" required>
                        </div>
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Descreva o curso.</span>
                        </div>
                        <textarea class="form-control" name="descricao_curso" aria-label="With textarea" required></textarea>
                      </div>
                      <br>
                      <input class="btn btn-primary" type="submit" name="publicar" value="Avançar">
                </form>
            </div>
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
                        do{
                    ?>
                    <tr>
                        <th scope="row"><?php echo $curso['curso_id'] ?></th>
                        <td><?php echo $curso['nome'] ?></td>
                        <td><?php echo $curso['data_pub'] ?></td>
                        <td><a href="javascript: if(confirm('Tem certeza que pretende apagar <?php echo addslashes($curso['nome'])?>? Este curso deixará de aparecer para o público'))
                        location.href='acao_curso.php?cursoid=<?php echo $curso['curso_id'];?>&acao=1'" class="lixo"><ion-icon name="trash-outline"></ion-icon></a>
                        <a href="edit_curso.php?cursoid=<?php echo $curso['curso_id'];?>" class="edit"><ion-icon name="create-outline"></ion-icon></a>
                        <a href="javascript: if(confirm('Tem certeza que pretende arquivar <?php echo addslashes($curso['nome'])?>? Este curso deixará de aparecer para o público, mas pode ser recuperado.'))
                        location.href='acao_curso.php?cursoid=<?php echo $curso['curso_id'];?>&acao=2'" class="arquivar"><ion-icon name="archive-outline"></ion-icon></a></td>
                    </tr>

                    <?php
                        }while($curso = $curso_query->fetch_assoc());
                    ?>
                </tbody>
              </table>
            
        </div>
    <script src="../js/menu_script.js"></script>
</body>
</html>