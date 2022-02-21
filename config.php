<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: index.php");
	}
	if (isset($_GET['msg'])) {
		echo "<script>alert('".$_GET['msg']."')</script>";
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

        <title>Configurações</title>
		<link rel="icon" type="image/png" href="img/ícones/livro_aberto.png">
		<link rel="stylesheet" href="css/estilo_geral.css">
        <link rel="stylesheet" href="css/estilo_home.css">
        <link rel="stylesheet" href="css/estilo-config.css">
		<link rel="stylesheet" href="css/estilo-usuario.css">

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
            <iframe src='usuarios/editaPerfil.php' height='100%' width='100%' scrolling='no' title='editFrame'></iframe>
        </div>
        <div class="coluna_lista">
			<div class="container">
				<div class="perfil">
					<h1>Sobre a plataforma:</h1><br>
					<p>A plataforma <b>Eu <span class="estiloLegal">Li</span>vro</b> foi desenvolvida para a disciplina de Desenvolvimento Web do 3º ano do ensino médio técnico, na Instituição Federal do Paraná Campus Pinhais, sob orientação do professor Rodolfo Pereira.</p><br>
					<p>Com objetivo de testar conhecimentos em banco de dados e php foi proposto o sistema de registro e avaliação de livros por usuários diversos.</p><br>
					<p>As tecnologias utilizadas incluem: Html, Css, Javascript, PHP e MySQL</p><br>
					<p>Partes do código foram desenvolvidas com base em projetos do site <a href="https://www.codewithrandom.com/" target="_blank">Code With Random</a> </p> <br>
					<footer>&copy Leonardo Salgado</footer>
				</div>
			</div>
        </div>
    </body>
</html>
