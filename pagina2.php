<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: index.php");
	}
    if (!isset($_GET['action'])){
        header("Location: home.php");
    }
	$conexao = mysqli_connect("localhost:3306", "usuario", "senha");
	mysqli_set_charset($conexao, "utf8");
	if (!$conexao) {
		die("Impossível conectar: " . mysqli_connect_error($conexao));
	}
	mysqli_select_db($conexao, "meus_livros");
	$consulta = "SELECT imgPerfil FROM usuarios WHERE id = '".$_SESSION['id_usuario']."'";
	$conj_resultados = mysqli_query($conexao, $consulta);
	$linha = mysqli_fetch_array($conj_resultados, MYSQLI_ASSOC);
	$imgPerfil = $linha['imgPerfil'];
	mysqli_close($conexao);
    $action = $_GET['action'];
    $array_action = explode ("66", $action);
    $page = $array_action[0];
    $idAction = $array_action[1];
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Eu livro</title>
		<link rel="icon" type="image/png" href="img/ícones/livro_aberto.png">
		<link rel="stylesheet" href="css/estilo_geral.css">
        <link rel="stylesheet" href="css/estilo_home.css">
	</head>
    <body>
        <div class="menu">
            <nav>  
                <a href="home.php" title="voltar" class="voltar"><img src="img/ícones/voltar.png"> Voltar </a>
                <ul>  
					<li>
						<?php
							echo "<h3>".$_SESSION['nome_usuario']."</h3>";
						?>
					</li>
					<li>
						<?php
							if($imgPerfil == NULL){
								$perfil = "9";
							} else {
								$perfil = $imgPerfil;
							}
							echo "<img src='img/img-perfis/img$perfil.png'>";
						?>
					</li>
                    <li>
						<?php
						$id = $_SESSION['id_usuario'];
						echo("<a href='pagina2.php?action=0166$id' id='menu_link'>Minha lista ▼</a> ");
						echo("<ul> ");
						echo("<li><a href='pagina2.php?action=0266$id' id='menu_link'>Meu perfil</a></li> ");
						echo("<li><a href='config.php' id='menu_link'>Configurações</a></li>");
						echo("<li><a href='logout.php' id='logout_link'>sair</a></li>");
						echo("</ul>");
						?>      
                    </li>
                </ul>  
            </nav>
        </div>
        <div class="coluna_botoes">
            <?php
                if($page == "01"){
                    echo("<iframe src='livros/adiciona.php' height='100%' width='100%' scrolling='no' title='right_side'></iframe>");
                } else if($page == '02'){
                    echo("<iframe src='usuarios/perfil_user.php?id=$idAction' height='100%' width='100%' scrolling='no' title='right_side'></iframe>");
                }
            ?>

        </div>
        <div class="coluna_lista">
            <?php
                echo("<iframe src='livros/lista.php?id=$idAction' height='100%' width='100%' scrolling='no' title='left_side'></iframe>");
            ?>
        </div>
    </body>
</html>
