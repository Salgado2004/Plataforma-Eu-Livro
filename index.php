<?php
	if (isset($_POST['logemail']) and isset($_POST['logsenha'])) {
		$conexao = mysqli_connect("localhost:3306", "usuario", "senha");
        mysqli_set_charset($conexao, "utf8");
        if (!$conexao) {
            die("Impossível conectar: " . mysqli_connect_error($conexao));
        }
        mysqli_select_db($conexao, "meus_livros");
		$email = mysqli_real_escape_string($conexao, $_POST['logemail']);
		$senha = mysqli_real_escape_string($conexao, $_POST['logsenha']);
		$email = trim($email);
		$senha = md5(trim($senha));
		if ($email != "" and $senha != "") {
			$query = "SELECT * FROM usuarios WHERE email = '$email'";
			$conj_resultados = mysqli_query($conexao, $query);
			$qtd_usarios = mysqli_num_rows($conj_resultados);
			if ($qtd_usarios > 0) {
				$dados = mysqli_fetch_array($conj_resultados);
				if (strcmp($senha, $dados['senha']) == 0) {
					session_start();
					$_SESSION['id_usuario'] = $dados['id'];
					$_SESSION['nome_usuario'] = $dados['nome'];
					header("Location: home.php");
				} else {
					echo "<script>alert('Senha incorreta!')</script>";
				}
			} else {
				echo "<script>alert('Login inexistente!')</script>";
			}
		} else {
			echo "<script>alert('Digite o login e senha!')</script>";
		}
		mysqli_close($conexao);
	}
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Eu Livro</title>
		<link rel="icon" type="image/png" href="img/ícones/livro_aberto.png">
        <link rel="stylesheet" href="css/estilo_geral.css">
    </head>
    <body>
		<h1 class="tituloSite">Eu <span class="estiloLegal">Li</span>vro </h1>
        <div class="coluna_mostra">
            <iframe src="usuarios/slider.html" height="100%" width="100%" scrolling="no" title="mostra"></iframe>
        </div>
        <div class="coluna_login">
            <iframe src="usuarios/log in sign up.html" height="100%" width="100%" scrolling="no" title="login"></iframe>
        </div>

    </body>
</html>
