<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: ../index.php");
	}
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['favorito']) && isset($_POST['texto']) && isset($_POST['privado'])){
        $newNome = $_POST['nome'];
        $newEmail = $_POST['email'];
        $newFavorito = $_POST['favorito'];
        $newRecado = $_POST['texto'];
        $newPrivado = $_POST['privado'];
        $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
        mysqli_set_charset($conexao, "utf8");
        if (!$conexao) {
            die("Impossível conectar: " . mysqli_connect_error($conexao));
            }
        mysqli_select_db($conexao, "meus_livros");
        $query = "UPDATE `meus_livros`.`usuarios` SET `nome` = '$newNome', `email` = '$newEmail', `livro_favorito` = '$newFavorito', `descricao` = '$newRecado', `privado` = '$newPrivado' WHERE id='".$_SESSION['id_usuario']."';";
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            echo('<script>alert("Algo deu errado :/")</script>');
        } else {
            echo('<script>alert("Dados alterados com sucesso!")</script>');
        }
        mysqli_close($conexao);
    }

?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Edita perfil</title>
        <link rel="stylesheet" href="../css/estilo-config.css">

    </head>
    <body>
    <div class="conteúdo"> 
        <div class="config-perfil">
            <?php
                    $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
					mysqli_set_charset($conexao, "utf8");
					if (!$conexao) {
						die("Impossível conectar: " . mysqli_connect_error($conexao));
						}
					mysqli_select_db($conexao, "meus_livros");
					$consulta = "SELECT * FROM usuarios WHERE id = '" .$_SESSION['id_usuario']. "';";
					$conj_resultados = mysqli_query($conexao, $consulta);
					$num = mysqli_num_rows($conj_resultados);
					$linha = mysqli_fetch_array($conj_resultados, MYSQLI_ASSOC);
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
                    if($linha['privado'] == NULL){
						$privado = "1";
					} else {
						$privado = $linha['privado'];
					}
					if($linha['descricao'] == NULL){
						$status = 'Olá! Estou usando a plataforma Eu Livro';
					} else {
						$status = $linha['descricao'];
					}
                    $nome = $linha['nome'];
                    $email = $linha['email'];
                    $placeholder = '"Olá! Estou usando a plataforma Eu Livro"';
                    echo("<div class='organiza'>");
                        echo(" <img src='../img/img-perfis/img$perfil.png' class='imgPerfil' > ");
                        echo(" <p class='cabeçalho'>Editar perfil:</p> ");
                    echo("</div>");
                    echo("<div class='box'>");
                        echo("<a href='editaImg.php?img=$perfil' class='editPerfil' target='_self'> <img src='../ícones/editar2.png' style='width: 15px;'> Editar foto de perfil</a>");
                    echo("</div>");
                    echo("</form>");
                    echo("<form action='editaPerfil.php' method='post'>");
                        echo("<div class='box'>");
                            echo("<p>Nome</p>");
                            echo("<div>");
                                echo("<input type='text' class='texto' autocomplete='off' name='nome' id='nome' placeholder='Nome' value='$nome'>");
                            echo("</div>");
                        echo("</div>");
                        echo("<div class='box'>");
                            echo("<p class='dica'>Ajude as pessoas a encontrar usando o nome pelo qual você é conhecido: seu nome completo, apelido ou nome comercial.</p>");
                        echo("</div>");
                        echo("<div class='box'>");
                            echo("<p>Email</p>");
                            echo("<div>");
                                echo("<input type='email' class='texto' autocomplete='off' name='email' id='email' placeholder='Email' value='$email'>");
                            echo("</div>");
                        echo("</div>");
                        echo("<div class='box'>");
                            echo("<p>Livro favorito</p>");
                            echo("<div>");
                                echo("<input type='text' class='texto' autocomplete='off' name='favorito' id='favorito' placeholder='Livro favorito' value='$favebook'>");
                            echo("</div>");
                        echo("</div>");
                        echo("<div class='descricao'>");
                            echo("<p>Recado</p>");
                            echo("<div>");
                                echo("<textarea name='texto' placeholder='$placeholder'>$status</textarea>");
                            echo("</div>");
                        echo("</div>");
                        echo("<div class='radio'>");
                            echo("<p>Perfil privado?</p>");
                            echo("<div>");
                                if($privado == "1"){
                                    echo("<input type='radio' id='sim' name='privado' value='2'>");
                                    echo("<label for='sim'>Sim</label>");
                                    echo("<input type='radio' id='nao' name='privado' value='1' checked>");
                                    echo("<label for='nao'>Não</label>");
                                } else{
                                    echo("<input type='radio' id='sim' name='privado' value='2' checked>");
                                    echo("<label for='sim'>Sim</label>");
                                    echo("<input type='radio' id='nao' name='privado' value='1'>");
                                    echo("<label for='nao'>Não</label>");
                                }
                            echo("</div>");
                        echo("</div>");
                        echo("<button class='btn' type='submit'>Salvar Alterações</button>");
                    echo("</form>");
                    echo("<div class='box'>");
                        echo("<a href='editaSenha.php' class='editPerfil' target='_self'> <img src='../ícones/editar2.png' style='width: 15px;'> Alterar senha</a>");
                        echo("<a href='deletarPerfil.php' class='editPerfil' target='_self'> <img src='../ícones/fechar2.png' style='width: 18px;'> Deletar perfil</a>");
                    echo("</div>");
                echo("</div>");
            ?>
        </div>
    </body>
</html>
