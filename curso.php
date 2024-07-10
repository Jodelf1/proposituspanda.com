<?php 
    include("./config/conexao.php");
    session_start();

    $curso_id = $_GET['id'];

    $cursosql = "SELECT * FROM cursos_tb WHERE curso_id = $curso_id";
    $curso_query = $conexao2->query($cursosql) or die($conexao2->error);
    $curso = $curso_query->fetch_assoc();

    $ftcurso_sql = "SELECT * FROM fotos_tb WHERE curso_id = $curso_id";
    $ftcurso_query = $conexao2->query($ftcurso_sql) or die($conexao2->error);
    $ftcurso = $ftcurso_query->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $curso['descricao'];?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title><?php echo $curso['nome'];?> - Propositus Panda</title>
    <link rel="stylesheet" href="./assets/css/ppstyle.css">
</head>
<body>
    <header class="topo">
        <div class="wtspace">
            <img src="./assets/img/logo.jpg" class="logo" alt="Logotipo da propositus Panda">
        </div>
        <div class="blspace">
            <ul class="menu">
                <a href="./servicos.php"><li class="item ativo">Serviços</li></a>
                <a href="./cursos.php"><li class="item">Cursos</li></a>
                <a href="./galeria.php"><li class="item">Galeria de fotos</li></a>
                <a href="#qsms"><li>Quem somos?</li></a>
            </ul>
        </div>
    </header>
    <main>
        <div class="maincurso">
            <div class="informa_curso">
                <img src="<?php echo $ftcurso['path']; ?>" alt="">
                <div>
                    <h1><?php echo $curso['nome'];?></h1>
                    <h2><?php echo $curso['prc'];?> kz</h2>
                    <h3>Sobre o curso</h3>
                    <p><?php echo $curso['descricao'];?></p>
                </div>
            </div>
            <div class="mais_cursos">
                <h2>Outros cursos</h2>
                <?php 
                $sugestao_sql = "SELECT * FROM cursos_tb WHERE curso_id != $curso_id and estado = 1 LIMIT 4";
                $sugestao_query = $conexao2->query($sugestao_sql) or die($conexao2->error);
                $sugestao = $sugestao_query->fetch_assoc();

                do{
                    $ftsug_sql = "SELECT * FROM fotos_tb WHERE curso_id = $sugestao[curso_id]";
                    $ftsug_query = $conexao2->query($ftsug_sql) or die($conexao2->error);
                    $fts = $ftsug_query->fetch_assoc();
                    ?>
                    <a href="curso.php?id=<?php echo $sugestao['curso_id'];?>">
                        <div class="curso_sugest">
                        <img src="<?php echo $fts['path'];?>" alt="">
                        <p><?php echo $sugestao['nome'];?></p>
                        </div>
                    </a>
                    <?php

                }while($sugestao = $sugestao_query->fetch_assoc());
                ?>
                
            </div>
        </div>
        
    </main>
    <footer>
        <div class="fim">
            <div class="ft1">
                <P>Siga-nos</P>
                <div>
                    <a href=""><ion-icon name="logo-facebook"></ion-icon></a>
                    <a href=""><ion-icon name="logo-instagram"></ion-icon></a>
                    <a href=""><ion-icon name="logo-tiktok"></ion-icon></a>
                    <a href=""><ion-icon name="logo-twitter"></ion-icon></a>
                </div>
            </div>
            <div class="ft2">
                <ul class="footer-menu">
                    <a href="#qsms"><li class="item">Quem somos?</li></a>
                    <a href="./cursos.php"><li class="item">Serviços</li></a>
                    <a href="./galeria.php"><li class="item">Cursos</li></a>
                    <a href=""><li class="item ativo">Login</li></a>
                </ul>
            </div>
            <div class="ft3">
                <p>Contacte-nos</p>

                <p>+244 997 340 583</p>

            </div>
            <div class="cdts">© Propositus Panda 2024 | <strong>Desenvolvido por <a href="">Jodelfi Marimba</a></strong>  </div>
        </div>
    </footer>
</body>
</html>
