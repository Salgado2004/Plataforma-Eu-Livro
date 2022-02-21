<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: ../index.php");
	}
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/estilo-adiciona.css">

        <title>Adiciona</title>
        <link rel="icon" type="image/png" href="../ícones/icone.png">
        <script type="text/javascript" src="../js/function-Crud.js"></script>
    </head>
    <body>
        <div class="conteúdo"> 
            <div class="cadastro">
                <form action="registra.php" method="post" target="_parent">
                    <p class="cabeçalho">Novo livro:</p>
                    <div class="box">
                        <p>Título</p>
                        <div>
                            <input type="text" class="texto" autocomplete="off" name="titulo" id="titulo-livro" placeholder="Título">
                        </div>
                    </div>
                    <div class="box">
                        <p>Gênero</p>
                        <div>
                            <input type="text" class="texto" autocomplete="off" name="genero" id="genero" placeholder="Gênero">
                        </div>
                    </div>
                    <div class="box">
                        <p>Autor</p>
                        <div>
                            <input type="text" class="texto" autocomplete="off" name="autor" id="autor" placeholder="Autor">
                        </div>
                    </div>
                    <div class="organiza">
                        <div class="number">
                            <p>Páginas lidas</p>
                            <div>
                                <input type="number" name="pgn" id="pgn" placeholder="Nº páginas">
                            </div>
                        </div>
                        <div class="radio">
                            <p>Finalizado?</p>
                            <div>
                                <input type="radio" id="sim" name="finalizado" value="1">
                                <label for="sim">Sim</label>
                                <input type="radio" id="nao" name="finalizado" value="0">
                                <label for="nao">Não</label>
                            </div>
                        </div>
                    </div>
                    <div class="feedback">
                            <p>Avaliação:</p>
                            <div class="rating">
                                <input type="radio" name="feedback" id="rating-5" value="5">  
                                <label for="rating-5"></label>  
                                <input type="radio" name="feedback" id="rating-4" value="4">  
                                <label for="rating-4"></label>  
                                <input type="radio" name="feedback" id="rating-3" value="3">  
                                <label for="rating-3"></label>  
                                <input type="radio" name="feedback" id="rating-2" value="2">  
                                <label for="rating-2"></label>  
                                <input type="radio" name="feedback" id="rating-1" value="1">  
                                <label for="rating-1"></label> 
                            </div>
                        </div>
                    <div class="descricao">
                        <div>
                            <textarea name="texto" placeholder="O que estou achando..."></textarea>
                        </div>
                    </div>
                    <?php
                        $user = $_SESSION['id_usuario'];
                        echo("<input type='hidden' name='user' value='$user'/>");
                        echo("<input type='hidden' name='action' value='0166$user'/>");
                    ?>
                    <button class="btn" type="submit">Adicionar <img src="../img/ícones/adicionar.png"></button>
                </form>
            </div>
        </div>         
    </body>
</html>
