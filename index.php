<?php 
include("./config/conexao.php");

// Realiza a consulta para obter os serviços ativos
$servcsql = "SELECT nome FROM servicos_tb WHERE estado = '1' LIMIT 6";
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
    <title>Página Inicial - Propositus Panda</title>
    <link rel="stylesheet" href="./assets/css/ppstyle.css">
    <link rel="stylesheet" href="./assets/css/pprespons.css">
</head>

<body>
    <header class="topo">
        <div class="wtspace">
            <img src="./assets/img/logo.jpg" class="logo" alt="Logotipo da Propositus Panda">
        </div>
        <div class="blspace">
            <ul class="menu">
                <a href="./servicos.php"><li class="item">Serviços</li></a>
                <a href="./cursos.php"><li class="item">Cursos</li></a>
                <a href="./galeria.php"><li class="item">Galeria de fotos</li></a>
                <a href="#qsms"><li class="item ativo">Quem somos?</li></a>
            </ul>
        </div>
    </header>

    <main>
        <div class="pri">
            <div class="wlcm">   
                <h1>Bem-vindo à <strong>Propositus Panda</strong></h1>
                <h2>Comércio Geral e Prestação de Serviços (SU) Lda</h2>
                <br><br><br>
                <p>Uma empresa Angolana de prestação de serviços comprometida com a excelência e satisfação do cliente...</p>
                <br>
                <a href="#qsms" class="vrms">Ver mais</a>
            </div>
        </div>

        <div class="sec">
            <div class="secback">
                <div class="info1">
                    <h1>EXPLORE OS NOSSOS...</h1>
                    <div class="infdiv">
                        <a href="cursos.php"><div>
                            <img src="" alt="">
                            <p>Cursos</p>
                        </div></a>

                        <a href="servicos.php"><div>
                            <img src="" alt="">
                            <p>Serviços</p>
                        </div></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="terc">
            <div id="qsms" class="info2">
                <div>
                    <h1>QUEM SOMOS?</h1>
                    <br><br>
                    <p>
                        Fundada em 2021, a <strong>Propositus Panda</strong> é uma empresa angolana comprometida com a excelência e satisfação do cliente. Sediada no município de Kilamba Kiaxi, na província de Luanda, temos o orgulho de oferecer serviços de <strong>alta qualidade e investimento humano 100% Nacional</strong>.
                    </p>
                    <br><br>
                    <p>
                        Contamos com uma equipa multidisciplinar de <strong>engenheiros, técnicos <br>e auxiliares de apoio</strong>, especializados em diversa áreas, desde administração e marketing até assistência técnica.
                    </p>
                    <br>
                    <p>
                        Zelamos pelo constante aperfeiçoamento de nosso pessoal, proporcionando formações de capacitação técnica para garantir o correto desempenho da empresa em todos os níveis.
                    </p>
                </div>
            </div>
        </div>

        <div class="info3">
            <h1>O QUE FAZEMOS?</h1>
            <br><br>
            <ul>
                <?php while($servico = $servc_query->fetch_assoc()) { ?>
                    <li><?php echo htmlspecialchars($servico['nome']); ?></li>
                <?php } ?>
            </ul>
            <br>
            <br>
            <a href="servicos.php" class="vrms">Ver mais</a>
        </div>

        <div class="penul">
            <div class="info4">
                <h1>Porque trabalhar com a Propositus Panda?</h1>

                <div class="mtv"><img src="./assets/img/alvo-de-dardos.png" alt="">
                    <div><h2>1. Nosso foco é...</h2>
                        <p>... fazer um trabalho de qualidade para preservar a nossa reputação e assim fidelizar os parceiros</p></div>
                </div>

                <div class="mtv midle"><img src="./assets/img/relogio-de-parede.png" alt="">
                    <div><h2>2. Nossa Missão é... </h2>
                        <p>... satisfazer as necessidades de nossos clientes, parceiros em tempo recorde e com alta qualidade.</p></div>
                </div>

                <div class="mtv"><img src="./assets/img/qualidade.png" alt="">
                    <div><h2>3. Profissionalismo</h2>
                        <p>... Nos comprometemos com o trabalho, oferecendo os serviços que nos propusemos a fornecer.</p></div>   
                </div>
            </div>
        </div>

        <div class="info5">
            <p>Na Propositus Panda, estamos empenhados em <strong>superar as expectativas e proporcionar soluções eficazes</strong> para as necessidades de nossos clientes. <br><br>
                Entre em contacto conosco para saber mais sobre como podemos ajudar a sua empresa a alcançar novos patamares de sucesso!
            </p>

            <div class="contact">
                <a href="tel:+244997340583" class="num"><ion-icon name="call-outline"></ion-icon> +244 997 340 583</a>
                <a href="https://wa.me/+244997340583" target="_blank" class="wts"><ion-icon name="logo-whatsapp"></ion-icon> +244 997 340 583</a>
            </div>

            <div class="links">
                <h2>Não esqueça de verificar</h2>
                <div class="filho">
                    <a href="servicos.php">
                        <div><img src="./assets/img/servico-tecnico.png" alt=""><p>Serviços</p></div></a>
                    <a href="cursos.php"><div><img src="./assets/img/diploma.png" alt=""><p>Cursos</p></div></a>
                </div>
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
