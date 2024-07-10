<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();

    $servico_ref = $_GET['ref'];

    $servicosql = "SELECT * FROM servicos_tb WHERE ref = '$servico_ref'";
    $servico_query = $conexao2->query($servicosql) or die($conexao2->error);
    $servico = $servico_query->fetch_assoc();

    $fotosql = "SELECT * FROM fotos_tb WHERE estado = '1' AND  tipo = '2' AND servico_id='$servico[servico_id]'";
    $foto_query = $conexao2->query($fotosql) or die($conexao2->error);
    $foto = $foto_query->fetch_assoc();
    $total = $foto_query->num_rows;

    if(isset($_POST['publicar'])){  
        if(isset($_FILES['foto_serv'])){
            $foto = $_FILES['foto_serv']; 
            $pasta = "./assets/img/";
            $nomeFT = $foto['name'];
            $novonomeFT = "PropositusPanda_". uniqid();
            $extensao = strtolower(pathinfo($nomeFT,PATHINFO_EXTENSION));

            $newpath =  $pasta . $novonomeFT . "." . $extensao;
            $mover = move_uploaded_file($foto['tmp_name'],".".$newpath);

            if($mover){

                $ftcrs_query = $conexao2->query("INSERT INTO `fotos_tb`(`nome`,`estado`,`tipo`, `path`, `servico_id`) VALUES ('$nomeFT','1','2','$newpath','$servico[servico_id]')");
                
                if($ftcrs_query){

                        echo "<script language ='javascript' type='text/javascript'>
                        alert('Imagem Publicada!'), window.location = 'g_galeria.php'
                        </script>";

                    }else{
                        echo "<script language ='javascript' type='text/javascript'>
                        alert('Não foi possível publicar a imagem.'), window.location = 'g_galeria.php'
                        </script>";
                    }
                }else{
                    echo "<script language ='javascript' type='text/javascript'>
                    alert('Não foi possível publicar a imagem.'), window.location = 'g_cursos.php'
                    </script>";
                } 
                }
                    }   
        ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/ppstyle.css">
    <link rel="stylesheet" href="../assets/css/style.css">
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
                <img src="../assets/img/logo.jpg" alt="" class="logo">
            </div>
            <div class="novocurso">
                <form action="" method="post" enctype="multipart/form-data">
                    <h1 class="nome"><?php echo $servico['nome'];?></h1>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*"  name="foto_serv" id="customFile" required>
                        <label class="custom-file-label" for="customFile">Escolha uma foto para o serviço</label>
                      </div>
                      <br><br>
                      <input class="btn btn-primary" type="submit" name="publicar" value="Avançar">
                </form>
            </div>
            <br>
            <div class="gallery-container">
            <?php while ($foto = $foto_query->fetch_assoc()): ?>
                <div class="gallery-items">
                    <a href=".<?php echo $foto['path'] ?>">
                    <img src=".<?php echo $foto['path'] ?>" alt="">
                    </a>
                    <a href="javascript: if(confirm('Tem certeza que pretende apagar esta imagem?'))
                        location.href='acao_img.php?imgid=<?php echo $foto['ft_id'];?>&acao=1'" class="lixo"><ion-icon name="trash-outline"></ion-icon></a>
            </div>
                
            <?php endwhile; ?>
            </div>
        </div>
    <script src="../assets/js/menu_script.js"></script>
</body>
</html>