<?php 
    include("./config/conexao.php");
    session_start();

    // Consulta para buscar serviços ativos limitados a 8
    $servcsql = "SELECT * FROM servicos_tb WHERE estado = '1' LIMIT 8";
    $servc_query = $conexao2->query($servcsql) or die($conexao2->error);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="A Propositus Panda é uma empresa angolana que trabalha na área de TI, dispõe de vários serviços como instalação de câmeras de segurança, redes de computadores e mais, temos o orgulho de oferecer serviços de alta qualidade e investimento humano 100% Nacional">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Serviços - Propositus Panda</title>
    <link rel="stylesheet" href="./css/ppstyle.css">
</head>
<body>
    <header class="topo">
        <div class="wtspace">
            <img src="./images/logo.jpg" class="logo" alt="Logotipo da Propositus Panda">
        </div>
        <div class="blspace">
            <ul class="menu">
                <li class="item ativo"><a href="./servicos.php">Serviços</a></li>
                <li class="item"><a href="./cursos.php">Cursos</a></li>
                <li class="item"><a href="./galeria.php">Galeria de fotos</a></li>
                <li><a href="./index.php#qsms">Quem somos?</a></li>
            </ul>
        </div>
    </header>
    <main>
        <img class="eli1" src="./images/Ellipse 6.svg" alt="">
        <img class="eli2" src="./images/Ellipse 7.svg" alt="">

        <div class="intro">
            <p>Nesta página poderá ver os cursos prestados pela <strong>Propositus Panda</strong><br>
                Procure o que deseja!! 
            </p>
        </div>

        <div class="lista_servicos">
            <?php while ($servico = $servc_query->fetch_assoc()): ?>
                <?php 
                    $ftservico_sql = "SELECT * FROM fotos_tb WHERE servico_id = " . $servico['servico_id'] . " LIMIT 1";
                    $ftservico_query = $conexao2->query($ftservico_sql) or die($conexao2->error);
                    $fts = $ftservico_query->fetch_assoc();
                    $servicolink = './servico.php?id=' . $servico['servico_id'];
                ?>
                <div class="servico_indiv">
                    <img src="<?php echo $fts['path']; ?>" alt="Imagem do Serviço">
                    <div>
                        <h2><?php echo $servico['nome']; ?></h2>
                        <p><?php echo $servico['descricao']; ?></p>
                        <a href="<?php echo $servicolink; ?>" class="info_link">Mais info</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="tlvz">
            <h1>TALVEZ SE PERGUNTE...</h1>
            <div class="cada">
                <div class="tlvz_um">
                    <h2>"<strong>Como fazer</strong> um curso com a Propositus Panda?"</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum scelerisque sapien mollis sagittis. Nam id leo ac dolor sollicitudin pellentesque. Ut vitae ipsum eu mi pharetra feugiat ac ut orci.</p>
                </div>
                <div class="tlvz_dois">
                    <h2>"<strong>Porque fazer</strong> um curso com a Propositus Panda?"</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum scelerisque sapien mollis sagittis. Nam id leo ac dolor sollicitudin pellentesque. Ut vitae ipsum eu mi pharetra feugiat ac ut orci.</p>
                </div>
                <div class="tlvz_tres">
                    <h2>"<strong>Porque fazer</strong> um curso com a Propositus Panda?"</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum scelerisque sapien mollis sagittis. Nam id leo ac dolor sollicitudin pellentesque. Ut vitae ipsum eu mi pharetra feugiat ac ut orci.</p>
                </div>
            </div>
        </div>

        <div class="tbm"><p>Também <strong>ministramos cursos</strong> <a href="cursos.php">veja aqui</a>.</p></div>
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
