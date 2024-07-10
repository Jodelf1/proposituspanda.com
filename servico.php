<?php 
    include("./config/conexao.php");
    session_start();

    // Obter e sanitizar o ID do serviço
    $servico_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $hoje = date('Y-m-d');

    if ($servico_id == 0) {
        die('Serviço inválido.');
    }

    // Consulta os detalhes do serviço
    $servicosql = $conexao2->prepare("SELECT * FROM servicos_tb WHERE servico_id = ?");
    $servicosql->bind_param("i", $servico_id);
    $servicosql->execute();
    $servico = $servicosql->get_result()->fetch_assoc();

    // Consulta as fotos do serviço
    $fotocapa_sql = $conexao2->prepare("SELECT * FROM fotos_tb WHERE servico_id = ? AND tipo = '1' LIMIT 3");
    $fotocapa_sql->bind_param("i", $servico_id);
    $fotocapa_sql->execute();
    $foto_query = $fotocapa_sql->get_result();

    // Consulta as fotos da galeria do serviço
    $galeria_sql = $conexao2->prepare("SELECT * FROM fotos_tb WHERE servico_id = ? AND tipo = '2'");
    $galeria_sql->bind_param("i", $servico_id);
    $galeria_sql->execute();
    $galeria_query = $galeria_sql->get_result();

    if(isset($_POST['enviarsolicitacao'])){

        // Sanitização das entradas do usuário
        foreach($_POST as $chave => $valor) {
            $_SESSION[$chave] = $conexao2->real_escape_string($valor);
        }

        // Validação dos campos do formulário
        if(empty($_SESSION['nome_s'])) $erro = "Digite o seu nome por favor!";
        if(empty($_SESSION['email_s'])) $erro = "Digite o email por favor";
        if(empty($_SESSION['numero_s'])) $erro = "Digite o seu número por favor!";
        if(empty($_SESSION['descricao_s'])) $erro = "Digite a descrição por favor";

        // Verificação de duplicidade do NIF
        /*$sql_code_NIF = $conexao2->prepare("SELECT cliente_id FROM clientes_tb WHERE NIF = ?");
        $sql_code_NIF->bind_param("s", $_SESSION['NIF']);
        $sql_code_NIF->execute();
        $total_NIF = $sql_code_NIF->get_result()->num_rows;
        if($total_NIF != 0) $erro = 'Este NIF já foi cadastrado';*/

        if(!isset($erro)){
            // Verificação de duplicidade do email
            $sql_code_user = $conexao2->prepare("SELECT cliente_id FROM clientes_tb WHERE email = ?");
            $sql_code_user->bind_param("s", $_SESSION['email_s']);
            $sql_code_user->execute();
            $total_user = $sql_code_user->get_result()->num_rows;

            if ($total_user == 0) {
                $nome = $_SESSION['nome_s'];
                $ref = password_hash($_SESSION['nome_s'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
                $hash = password_hash($_SESSION['senha_s'], PASSWORD_DEFAULT);

                // Inserir novo cliente
                $sql_insert_cliente = $conexao2->prepare("INSERT INTO clientes_tb (nome, email, senha, tel_num, NIF, estado, ref) VALUES (?, ?, ?, ?, ?, '2', ?)");
                $sql_insert_cliente->bind_param("ssssss", $nome, $_SESSION['email_s'], $hash, $_SESSION['numero_s'], $_SESSION['NIF'], $ref);
                $sql_insert_cliente->execute();

                if($sql_insert_cliente){
                    // Inserir nova solicitação
                    $descricao = $_SESSION['descricao_s'];
                    $sql_query_cliente = $conexao2->prepare("SELECT cliente_id FROM clientes_tb WHERE ref = ?");
                    $sql_query_cliente->bind_param("s", $ref);
                    $sql_query_cliente->execute();
                    $cliente = $sql_query_cliente->get_result()->fetch_assoc();

                    $ref_s = password_hash($_SESSION['descricao_s'] . date("Y-m-d H:i:s") . $servico_id, PASSWORD_DEFAULT);
                    $sql_insert_solicit = $conexao2->prepare("INSERT INTO solicitacoes_tb (servico_id, cliente_id, estado, descricao, data_solicitacao, ref) VALUES (?, ?, '2', ?, ?, ?)");
                    $sql_insert_solicit->bind_param("iisss", $servico_id, $cliente['cliente_id'], $descricao, $hoje, $ref_s);
                    $sql_insert_solicit->execute();

                    if ($sql_insert_solicit) {
                        echo "<script>alert('Solicitação enviada!'); window.location = 'servicos.php';</script>";
                    } else {
                        echo "<script>alert('Não foi possível fazer a solicitação!'); window.location = 'servicos.php';</script>";
                    }
                } else {
                    echo "<script>alert('Não foi possível fazer a solicitação!'); window.location = 'servicos.php';</script>";
                }
            } else {
                echo "<script>alert('Este e-mail já está cadastrado!'); window.location = 'servicos.php';</script>";
            }
        } else {
            echo "<script>alert('$erro');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $servico['descricao'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title><?php echo htmlspecialchars($servico['nome']);?> - Propositus Panda</title>
    <link rel="stylesheet" href="./css/ppstyle.css">
</head>
<body>
    <header class="topo">
        <div class="wtspace">
            <img src="./images/logo.jpg" class="logo" alt="Logotipo da Propositus Panda">
        </div>
        <div class="blspace">
            <ul class="menu">
                <a href="./servicos.php"><li class="item ativo">Serviços</li></a>
                <a href="./cursos.php"><li class="item">Cursos</li></a>
                <a href="./galeria.php"><li class="item">Galeria de fotos</li></a>
                <a href="./index.php"><li>Quem somos?</li></a>
            </ul>
        </div>
    </header>
    <main>
        <div class="servico_div">
            <div class="serv_imgs">
                <?php while($fotos = $foto_query->fetch_assoc()): ?>
                    <img src="<?php echo htmlspecialchars($fotos['path']); ?>" alt="">
                <?php endwhile; ?>
            </div>
            <h1><?php echo htmlspecialchars($servico['nome']);?></h1>
            <p><?php echo htmlspecialchars($servico['descricao']);?></p>

            <div class="galeriadoservico">
                <?php while($fotos = $galeria_query->fetch_assoc()): ?>
                    <a href="<?php echo htmlspecialchars($fotos['path']); ?>">
                        <img src="<?php echo htmlspecialchars($fotos['path']); ?>" alt="">
                    </a>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="solicit_form">
            <h1>Solicitar serviço</h1>
            <p>Digite corretamente as informações pedidas abaixo</p>
            <form action="" method="post">
                <label for="nome">Nome</label><br>
                <input type="text" name="nome_s" id="nome" placeholder="Digite o seu nome" maxlength="60" required>
                
                <label for="email">Email</label><br>
                <input type="email" name="email_s" id="email" placeholder="exemplo@123.com" required> 
                
                <label for="numero">Número</label><br>
                <input type="number" name="numero_s" id="numero" placeholder="Digite seu número de telefone" required>

                <label for="nif">NIF</label><br>
                <input type="text" name="NIF" id="nif" placeholder="Digite o seu número de identificação Fiscal">

                <label for="senha">Palavra Passe</label><br>
                <input type="password" name="senha_s" id="senha" placeholder="Digite aqui a sua senha" required>

                <label for="descricao"> Descreva brevemente as suas necessidades</label>
                <textarea name="descricao_s" id="descricao" cols="30" rows="10" required></textarea>

                <input type="submit" name="enviarsolicitacao" value="Solicitar Serviço">
            </form>
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
