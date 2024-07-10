<?php 
    include("./config/conexao.php");
    session_start();

    $fotosql = "SELECT * FROM fotos_tb WHERE estado = '1' AND tipo = '5' OR estado = '1' AND tipo = '2'";
    $foto_query = $conexao2->query($fotosql) or die($conexao2->error);
    $foto = $foto_query->fetch_assoc();

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
    <title>Página Inicial - Propositus Panda</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/ppstyle.css">
    
</head>

<body>
    <header class="topo">
        <div class="wtspace">
            <img src="./images/logo.jpg" class="logo" alt="Logotipo da propositus Panda">
        </div>
        <div class="blspace">
            <ul class="menu">
                <a href="./servicos.php"><li class="item">Serviços</li></a>
                <a href="./cursos.php"><li class="item">Cursos</li></a>
                <a href="./galeria.php"><li class="item">Galeria de fotos</li></a>
                <a href="./index.php"><li class="item ativo">Quem somos?</li></a>
            </ul>
        </div>
    </header>

    <main>
    <div class="main_g">
        <div class="intro">
            <p>Nesta página poderá ver fotos de alguns serviços prestados pela <strong>Propositus Panda</strong>
            </p>
        </div>
        <div class="gallery-container">
                <?php while ($foto = $foto_query->fetch_assoc()): ?>
                <a href="<?php echo $foto['path'] ?>" class="gallery-items">
                    <img src="<?php echo $foto['path'] ?>" alt="">
                </a>
            <?php endwhile; ?>
        </div>
        <br>
        <div class="tbm"><p>Se estiver interessado em <strong>nossos serviços</strong> <a href="servicos.php">Clique aqui</a>.</p></div>
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
                    <a href="./index.php"><li class="item">Quem somos?</li></a>
                    <a href="./servicos.php"><li class="item">Serviços</li></a>
                    <a href="./cursos.php"><li class="item">Cursos</li></a>
                    <a href="./login.php"><li class="item ativo">Login</li></a>
                </ul>
            </div>
            <div class="ft3">
                <p>Contacte-nos</p>
                <p>+244 997 340 583</p>
            </div>
            <div class="cdts">© Propositus Panda 2024 | <strong>Desenvolvido por <a href="https://www.linkedin.com/in/jodelf1/">Jodelfi Marimba</a></strong></div>
        </div>
    </footer>
</body>
</html>