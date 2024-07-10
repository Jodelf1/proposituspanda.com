<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();

    $servico_ref = $_GET['ref'];

    $servicosql = "SELECT * FROM servicos_tb WHERE ref = '$servico_ref'";
    $servico_query = $conexao2->query($servicosql) or die($conexao2->error);
    $servico = $servico_query->fetch_assoc();

    if(isset($_POST['publicar'])){  

        if(isset($_FILES['foto_capa1'])){
            $foto_1 = $_FILES['foto_capa1']; 
            $foto_2 = $_FILES['foto_capa2']; 
            $foto_3 = $_FILES['foto_capa3']; 

            $pasta = "./assets/img/";

            $nomeFT = $foto_1['name'];
            $nomeFT2 = $foto_2['name'];
            $nomeFT3 = $foto_3['name'];

            $novonomeFT1 = "PropositusPanda_". uniqid();
            $novonomeFT2 = "PropositusPanda_". uniqid();
            $novonomeFT3 = "PropositusPanda_". uniqid();

            $extensao = strtolower(pathinfo($nomeFT,PATHINFO_EXTENSION));
            $extensao2 = strtolower(pathinfo($nomeFT2,PATHINFO_EXTENSION));
            $extensao3 = strtolower(pathinfo($nomeFT3,PATHINFO_EXTENSION));

            $newpath =  $pasta . $novonomeFT1 . "." . $extensao;
            $newpath2 =  $pasta . $novonomeFT2 . "." . $extensao2;
            $newpath3 =  $pasta . $novonomeFT3 . "." . $extensao3;

            $mover = move_uploaded_file($foto_1['tmp_name'],".".$newpath);
            $mover2 = move_uploaded_file($foto_2['tmp_name'],".".$newpath2);
            $mover3 = move_uploaded_file($foto_3['tmp_name'],".".$newpath3);

            if($mover && $mover2 && $mover3){
                $ftcrs_query = $conexao2->query("INSERT INTO `fotos_tb`(`nome`,`estado`,`tipo`, `path`, `servico_id`) VALUES ('$nomeFT','1','1','$newpath','$servico[servico_id]')");
                $ftcrs_query2 = $conexao2->query("INSERT INTO `fotos_tb`(`nome`,`estado`,`tipo`, `path`, `servico_id`) VALUES ('$nomeFT2','1','1','$newpath2','$servico[servico_id]')");
                $ftcrs_query3 = $conexao2->query("INSERT INTO `fotos_tb`(`nome`,`estado`,`tipo`, `path`, `servico_id`) VALUES ('$nomeFT3','1','1','$newpath3','$servico[servico_id]')");

                if($ftcrs_query && $ftcrs_query2 && $ftcrs_query3){
                        $update_query = $conexao2->query("UPDATE `servicos_tb` SET `estado`= '1' WHERE ref = '$servico_ref'");   
                       echo "<script language ='javascript' type='text/javascript'>
                        alert('Serviço Publicado!'), window.location = 'g_servicos.php'
                        </script>";
                    }else{
                        echo "<script language ='javascript' type='text/javascript'>
                        alert('Não foi possível publicar o serviço.'), window.location = 'g_servicos.php'
                        </script>";
                    }
                }else{
                    echo "<script language ='javascript' type='text/javascript'>
                    alert('Não foi possível publicar o serviço.'), window.location = 'g_servicos.php'
                    </script>";
            }
        }else{
                    echo "<script language ='javascript' type='text/javascript'>
                    alert('Não foi possível publicar o serviço.'), window.location = 'g_servicos.php'
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
                <form action="" method="post" enctype="multipart/form-data" id="servico_foto_form">
                    <h1>Serviço registrado</h1>
                    <div class="servico_div">
                        <div class="serv_imgs">

                            <div class="add_image" id="imagem">
                                <img src="../assets/img/gallery2.png" alt="" id="foto-servico1">
                                <input type = "file" id="foto_capa1" name = "foto_capa1" accept="image/*" required>
                            </div>
                            <div class="add_image" id="imagem">
                                <img src="../assets/img/gallery2.png" alt="" id="foto-servico2">
                                <input type = "file" id="foto_capa2" name = "foto_capa2" accept="image/*" required>
                            </div>
                            <div class="add_image" id="imagem">
                                <img src="../assets/img/gallery2.png" alt="" id="foto-servico3">
                                <input type = "file" id="foto_capa3" name = "foto_capa3" accept="image/*" required>
                
                                <script src="../assets/js/foto.js"></script>
                                <script src="../assets/js/foto2.js"></script>
                                <script src="../assets/js/foto3.js"></script>
                            </div>
                        </div>
                        <h4>Selecione as 3 fotos para a capa do serviço (fotos significativas)</h4>
                        <h1><?php echo $servico['nome']?></h1>
                        <p><?php echo $servico['descricao']?></p>
                    </div>
                    <br>
                    <input class="btn btn-primary" type="submit" name="publicar" value="Avançar">
                </form>
            </div>
            <br>
            
        </div>
    <script src="../assets/js/menu_script.js"></script>
</body>
</html>