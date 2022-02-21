<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: ../index.php");
	}
    if (isset($_POST['confirmation'])) {
		$conexao = mysqli_connect("localhost:3306", "usuario", "senha");
        mysqli_set_charset($conexao, "utf8");
        if (!$conexao) {
            die("Impossível conectar: " . mysqli_connect_error($conexao));
        }
        mysqli_select_db($conexao, "meus_livros");
		$senha = mysqli_real_escape_string($conexao, $_POST['confirmation']);
		$senha = md5(trim($senha));
		if ($senha != "") {
			$query = "SELECT senha FROM usuarios WHERE id = '".$_SESSION['id_usuario']."'";
            $id = $_SESSION['id_usuario'];
			$conj_resultados = mysqli_query($conexao, $query);
			$dados = mysqli_fetch_array($conj_resultados);				
			if (strcmp($senha, $dados['senha']) == 0) {
                $query = "SET FOREIGN_KEY_CHECKS= 0;";
                mysqli_query($conexao, $query);
				$query = "DELETE usuarios, livro FROM usuarios JOIN livro WHERE usuarios.id = '$id' AND livro.idUsuario = '$id' ";
                $resultado = mysqli_query($conexao, $query);
                if (!$resultado) {
                    $msg = 'Algo deu errado :/';
                    header("Location: ../config.php?msg=$msg");
                } else {
                    session_destroy();
		            header("Location: ../index.php");
                }
			} else {
				$msg = 'Senha incorreta!';
                header("Location: ../config.php?msg=$msg");
			}
		} else {
            $msg = 'Senha não informada!';
            header("Location: ../config.php?msg=$msg");
		}
        mysqli_close($conexao);
	}
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Deletar perfil</title>
        <link rel="stylesheet" href="../css/estilo-config.css">

    </head>
    <body>
        <div class="conteúdo"> 
            <div class="config-perfil">
                <p class="cabeçalho">Atenção: </p>
                <div class='box'>
                    <p class="cabeçalho" style="font-size: 30px;"> Ao deletar este perfil não será mais possível recuperar os dados</p>
                </div>
                <form action="deletarPerfil.php" method="post" target="_parent">
                    <div class='box'>
                        <p>Digite sua senha para prosseguir</p>
                        <div>
                            <input type='password' class='texto' autocomplete='off' name='confirmation' id='confirmation' placeholder='Senha'>
                        </div>
                    </div>
                    <div class='box'>
                        <a href="../config.php" class='btnVoltar' target='_parent'>Voltar</a>
                        <button class='btnImg' type='submit'>Confirmar</button>
                    </div> 
                </form>
            </div>
        </div>
    </body>
</html>
