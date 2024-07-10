<?php 
    include ("../config/conexao.php");
    include ("../config/protect.php");
    session_start();
    protecao_adm();

    $curso_ref = $_GET['ref'];

    $cursosql = "SELECT * FROM cursos_tb WHERE ref = '$curso_ref'";
    $curso_query = $conexao2->query($cursosql) or die($conexao2->error);
    $curso = $curso_query->fetch_assoc();

    if(isset($_POST['publicar'])){  
        if(isset($_FILES['foto_curso'])){
            $fotocurso = $_FILES['foto_curso']; 
            $pasta = "./assets/img/";
            $nomeFT = $fotocurso['name'];
            $novonomeFT = "PropositusPanda_". uniqid();
            $extensao = strtolower(pathinfo($nomeFT,PATHINFO_EXTENSION));

            $newpath =  $pasta . $novonomeFT . "." . $extensao;
            $mover = move_uploaded_file($fotocurso['tmp_name'],".".$newpath);

            if($mover){

                $ftcrs_query = $conexao2->query("INSERT INTO `fotos_tb`(`nome`,`estado`,`tipo`, `path`, `curso_id`) VALUES ('$nomeFT','1','1','$newpath','$curso[curso_id]')");
                
                if($ftcrs_query){
                    
                        $update_query = $conexao2->query("UPDATE `cursos_tb` SET `estado`= '1' WHERE ref = '$curso_ref'");
                        echo "<script language ='javascript' type='text/javascript'>
                        alert('Curso Publicado!'), window.location = 'g_cursos.php'
                        </script>";

                    }else{
                        echo "<script language ='javascript' type='text/javascript'>
                        alert('Não foi possível publicar o curso.'), window.location = 'g_cursos.php'
                        </script>";
                    }
                }else{
                    echo "<script language ='javascript' type='text/javascript'>
                    alert('Não foi possível publicar o curso.'), window.location = 'g_cursos.php'
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
                    <h1>Curso registrado</h1>
                    <p class="nome"><?php echo $curso['nome'];?></p>
                    <p class="preco_incr"><?php echo $curso['prc_in'];?></p>
                    <p class="preco"><?php echo $curso['prc'];?></p>
                    <p class="descricao"><?php echo $curso['descricao'];?></p>

                      <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*"  name="foto_curso" id="customFile" required>
                        <label class="custom-file-label" for="customFile">Escolha uma capa para o curso</label>
                      </div>
                      <br><br>
                      <input class="btn btn-primary" type="submit" name="publicar" value="Avançar">
                </form>
            </div>
            <br>
            
        </div>
    <script src="../assets/js/menu_script.js"></script>
</body>
</html>