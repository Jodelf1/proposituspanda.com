<?php

/*try{
    $conexao = new PDO('msqly:host=localhost;dbname:propositus_panda_bd', 'root', '');
    $conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}*/

	$conexao2 = mysqli_connect('localhost','proposituspanda','PP65propositus.PANDA','proposituspanda_bd');
	if($conexao2 -> connect_error){
		die('Falha ao conectar.'.connect_error);
	}

?>