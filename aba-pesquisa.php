<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: index.php");
	}
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Pesquisa</title>
        <link rel="stylesheet" href="css/estilo-pesquisa.css">
        <link rel="stylesheet" href="css/estilo_home.css">
        <script type="text/javascript" src="js/function-button.js"></script>
    </head>
    <body>
        <div class='conteúdo'>
            <div class="caixa">
                <a href="home.php" title="voltar" class="voltar" id="voltarHome" target="_parent"><img src="img/ícones/fechar.png"> </a>
                <form action="resultado_pesquisa.php" method="post" target='iframe_Principal'>
                    <div class="radio">
                        <div>
                            <input type="radio" id="perfil" name="filtroRadio" value="1">
                            <label for="perfil">Perfil</label>
                            <input type="radio" id="livro" name="filtroRadio" value="2">
                            <label for="livro">Livro</label>
                        </div>
                    </div>
                    <div class="caixa">
                        <input type="text" id="filtro" name="filtroText" placeholder="Pesquisar">
                        <button type="submit" title="pesquisar" id="search"><img src="img/ícones/pesquisar.png" onclick="button()"></button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
