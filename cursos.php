<?php 
    include("./config/conexao.php");
    session_start();

    $cursosql = "SELECT * FROM cursos_tb WHERE estado = '1'";
    $curso_query = $conexao2->query($cursosql) or die($conexao2->error);
    $curso = $curso_query->fetch_assoc();
    $total = $curso_query->num_rows;

    $destaquesql = "SELECT * FROM cursos_tb WHERE estado = '4' LIMIT 3";
    $destaque_query = $conexao2->query($destaquesql) or die($conexao2->error);
    $destaque = $destaque_query->fetch_assoc();

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
    <title>Cursos - Propositus Panda</title>
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
                <a href="./cursos.php"><li class="item ativo">Cursos</li></a>
                <a href="./galeria.php"><li class="item">Galeria de fotos</li></a>
                <a href="index.php#qsms"><li>Quem somos?</li></a>
            </ul>
        </div>
    </header>
    <main>
        <img src="./images/Rectangle 89.svg" class="recdir" alt="">
        <img src="./images/Rectangle 90.svg" class="recesq" alt="">

        <div class="intro">
            <p>Além de prestadora de serviços, a <strong>Propositus Panda</strong> também ministra cursos, <br>
                nesta página verá uma lista dos cursos disponíveis e mais informações. 
            </p>
        </div>

        <div class="recomendados">
            <h2>Recomendados</h2>
            <p>Estes cursos são os que tiveram o maior número de formandos nos ultimos meses:   </p>
            <div class="filhor">
                <div class="opc um"><img src="" alt=""><p>nome do curso</p></div>
                <div class="opc dois"><img src="" alt=""><p>Nome do curso 2</p></div>
                <div class="opc tres"><img src="" alt=""><p>Nome do curso 3</p></div>
            </div>
        </div>

        <div class="maiscursos">
            <h2>Mais cursos</h2>
            <div class="listac">
            <?php do{
                $ftcurso_sql = "SELECT * FROM fotos_tb WHERE curso_id = $curso[curso_id]";
                $ftcurso_query = $conexao2->query($ftcurso_sql) or die($conexao2->error);
                $ftp = $ftcurso_query->fetch_assoc();
                $cursolink = './curso.php?id=' . $curso['curso_id'];

                ?>
                <div><a href="<?php echo $cursolink; ?>">
                    <img src="<?php echo $ftp['path']; ?>" alt="">
                    <p class="nome"><?php echo $curso['nome']; ?></p>
                    <p class="preco"><?php echo $curso['prc']; ?> Kz</p></a>
                </div>

                <?php
                }while($curso = $curso_query->fetch_assoc());
            ?>
            </div>
            <a href="" class="vrms"> Ver mais</a>
        </div>

        <div class="tlvz">
            
            <h1>TALVEZ SE PERGUNTE...</h1>

            <div class="cada">
                <div class="tlvz_um">
                    <h2>"<strong>Como fazer</strong> um curso com a Propositus Panda?"</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum scelerisque sapien mollis sagittis. Nam id leo ac dolor s
                        ollicitudin pellentesque. Ut vitae ipsum eu mi pharetra feugiat ac ut orci. </p>

                </div >
                <div class="tlvz_dois">
                    <h2>"<strong>Porque fazer</strong> um curso com a Propositus Panda?"</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum scelerisque sapien mollis sagittis. Nam id leo ac dolor s
                        ollicitudin pellentesque. Ut vitae ipsum eu mi pharetra feugiat ac ut orci. </p>

                </div>
                <div class="tlvz_tres">
                    <h2>"<strong>Porque fazer</strong> um curso com a Propositus Panda?"</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum scelerisque sapien mollis sagittis. Nam id leo ac dolor s
                        ollicitudin pellentesque. Ut vitae ipsum eu mi pharetra feugiat ac ut orci. </p>

                </div>
            </div>
        </div>
        <div class="tbm"><p>Também somos uma <strong>prestadora de serviços</strong> <a href="servicos.php">veja aqui</a>.</p></div>
    
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

