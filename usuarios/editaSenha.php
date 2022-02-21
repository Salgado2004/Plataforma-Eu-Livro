<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: ../index.php");
	}
    if (isset($_POST['oldSenha']) and isset($_POST['newSenha'])) {
		$conexao = mysqli_connect("localhost:3306", "usuario", "senha");
        mysqli_set_charset($conexao, "utf8");
        if (!$conexao) {
            die("Impossível conectar: " . mysqli_connect_error($conexao));
        }
        mysqli_select_db($conexao, "meus_livros");
		$oldSenha = mysqli_real_escape_string($conexao, $_POST['oldSenha']);
		$newSenha = mysqli_real_escape_string($conexao, $_POST['newSenha']);
		$oldSenha = md5(trim($oldSenha));
		$newSenha = md5(trim($newSenha));
		if ($oldSenha != "" and $newSenha != "") {
			$query = "SELECT senha FROM usuarios WHERE id = '".$_SESSION['id_usuario']."'";
			$conj_resultados = mysqli_query($conexao, $query);
			$dados = mysqli_fetch_array($conj_resultados);				
			if (strcmp($oldSenha, $dados['senha']) == 0) {
				$query = "UPDATE `meus_livros`.`usuarios` SET `senha` = '$newSenha' WHERE id='".$_SESSION['id_usuario']."';";
                $resultado = mysqli_query($conexao, $query);
                if (!$resultado) {
                    echo "<script>alert('Algo deu errado :/')</script>";
                } else {
                    echo "<script>alert('Senha alterada com sucesso!')</script>";
                }
			} else {
				echo "<script>alert('Senha incorreta!')</script>";
			}
		} else {
			echo "<script>alert('Dados informados de maneira incorreta!')</script>";
		}
        mysqli_close($conexao);
	}
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Edita senha</title>
        <link rel="stylesheet" href="../css/estilo-config.css">

    </head>
    <body>
        <div class="conteúdo"> 
            <div class="config-perfil">
                <p class="cabeçalho">Alterar senha: </p>
                <form action="editaSenha.php" method="post">
                    <div class='box'>
                        <p>Senha atual</p>
                        <div>
                            <input type='password' class='texto' autocomplete='off' name='oldSenha' id='oldSenha' placeholder='Senha atual'>
                        </div>
                    </div>
                    <div class='box'>
                        <p>Nova senha</p>
                        <div>
                            <input type='password' class='texto' autocomplete='off' name='newSenha' id='newSenha' placeholder='Nova senha'>
                        </div>
                    </div>
                    <div class='box'>
                        <a href="../config.php" class='btnVoltar' target="_parent">Voltar</a>
                        <button class='btnImg' type='submit'>Salvar Alteração</button>
                    </div> 
                </form>
            </div>
        </div>
    </body>
</html>
