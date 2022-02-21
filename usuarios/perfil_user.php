<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: ../index.php");
	}
    $idPerfil = $_GET['id'];
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Perfil do usuario</title>
		<link rel="stylesheet" href="../css/estilo-usuario.css">
	</head>
	<body>
		<div class="container">
			<div class="perfil">
				<br>
				<?php
					$conexao = mysqli_connect("localhost:3306", "usuario", "senha");
					mysqli_set_charset($conexao, "utf8");
					if (!$conexao) {
						die("Impossível conectar: " . mysqli_connect_error($conexao));
						}
					mysqli_select_db($conexao, "meus_livros");
					$consulta = "SELECT * FROM usuarios WHERE id = '$idPerfil';";
					$conj_resultados = mysqli_query($conexao, $consulta);
					$linha = mysqli_fetch_array($conj_resultados, MYSQLI_ASSOC);
					$nome = $linha['nome'];
					$privado = $linha['privado'];
					if($linha['imgPerfil'] == NULL){
						$perfil = "9";
					} else {
						$perfil = $linha['imgPerfil'];
					}
					if($linha['livro_favorito'] == NULL){
						$favebook = "Não informado";
					} else {
						$favebook = $linha['livro_favorito'];
					}
					if($linha['descricao'] == NULL){
						$status = '"Olá! Estou usando a plataforma Eu Livro"';
					} else {
						$status = ' "'. $linha['descricao'] .'" ' ;
					}
					$consulta = "SELECT COUNT(*) AS 'quantidadeLivros' FROM livro WHERE idUsuario = '$idPerfil';";
					$conj_resultados = mysqli_query($conexao, $consulta);
					$linha = mysqli_fetch_array($conj_resultados, MYSQLI_ASSOC);
					$qtdLivros = $linha['quantidadeLivros'];
					mysqli_close($conexao);
					if($idPerfil == $_SESSION['id_usuario']){
						echo("<a href='../config.php' id='edit' target='_parent'><img src='../img/ícones/editar.png' title='editar'>Editar perfil</a><br>");
					}
					echo("<img id='imgPerfil' src='../img/img-perfis/img$perfil.png'><br>");
					echo("<h2>$nome</h2><br>");
					echo("<div class='organiza'>");
					echo("<h3>Livros: </h3>");
					echo("<h3> $qtdLivros </h3>");
					echo("</div>");
					if ($privado == NULL or $privado == "1" or $idPerfil == $_SESSION['id_usuario']){
						echo("<br><div class='organiza'>");
						echo("<h3>Livro favorito: </h3>");
						echo("<h3> $favebook</h3>");
						echo("</div><br>");
						echo("<h3>$status</h3><br>");
					} else{
						echo("<br><h3>Este perfil é privado</h3><br>");
						echo("<img id='lock' src='../img/ícones/privado.png'>");
					}
				?>
			</div>
		</div>
	</body>
</html>
