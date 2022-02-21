<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: index.php");
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
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Página Inicial</title>
		<link rel="icon" type="image/png" href="img/ícones/livro_aberto.png">
		<link rel="stylesheet" href="css/estilo_home.css">
		<link rel="stylesheet" href="css/estilo_geral.css">
	
	</head>
    <body>
        <div class="menu">  
            <nav>  
				<iframe src="aba-pesquisa.php" height="100%" width="30%" scrolling="no" title="search"></iframe>
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
		<div style="background-color: rgb(20, 19, 19);">
			<div class="main_content">
				<iframe src="usuarios/perfis.php" height="100%" width="100%" scrolling="no" name="iframe_Principal"></iframe>
			</div>
		</div>
    </body>
</html>
