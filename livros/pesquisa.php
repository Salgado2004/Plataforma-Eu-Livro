<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: ../index.php");
	}
    $idLista = $_POST['id'];
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="../css/estilo-lista.css">

        <title>Atividade Avaliativa 3º Bimestre</title>
        <script type="text/javascript" src="../js/function-Crud.js"></script>
    </head>
    <body>
        <div class="conteúdo">
            <div class="container">
                <div class="column middle">
                <?php
                        $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
                        mysqli_set_charset($conexao, "utf8");
                        if (!$conexao) {
                            die("Impossível conectar: " . mysqli_connect_error($conexao));
                        }
                        mysqli_select_db($conexao, "meus_livros");
                        $consulta = "SELECT nome, privado FROM usuarios WHERE id = $idLista";
                        $conj_resultados = mysqli_query($conexao, $consulta);
                        $linha = mysqli_fetch_array($conj_resultados, MYSQLI_ASSOC);
                        $privado = $linha['privado'];
                        $nome = $linha['nome'];
                        mysqli_close($conexao);
                        if($idLista == $_SESSION['id_usuario']){
                            echo("<h2>Minha lista de livros</h2>");
                        } else{
                            echo("<h2>Lista de $nome</h2>");
                        }
                    ?>
                    <?php
                        echo("<button title='voltar' id='search' onclick='window.location.replace(`lista.php?id=$idLista`);'>Voltar <img src='../img/ícones/fechar.png'></button>");
                        $filtro = $_POST['filtro'];
                        echo("<form action='pesquisa.php' method='post' class='caixa'>");
                        echo("<input type='text' id='filtro' name='filtro' value='$filtro'>");
                        echo("<input type='hidden' name='id' value='$idLista'/>");
                        echo("<button type='submit' title='voltar' id='search'><img src='../img/ícones/pesquisar.png'></button>");
                        echo("</form>");
                    ?>
                </div>
                <div class="row">
                    <?php
                        if ($privado == NULL or $privado == "1" or $idLista == $_SESSION['id_usuario']){
                            if ($filtro != NULL){
                                echo("<script>document.getElementById(listaLivros).innerHTML = ' '</script>");
                                $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
                                mysqli_set_charset($conexao, "utf8");
                                if (!$conexao) {
                                    die("Impossível conectar: " . mysqli_connect_error($conexao));
                                    }
                                mysqli_select_db($conexao, "meus_livros");
                                $consulta = "SELECT * FROM livro where titulo LIKE '%$filtro%' AND idUsuario = '$idLista'";
                                $conj_resultados = mysqli_query($conexao, $consulta);
                                $num = mysqli_num_rows($conj_resultados);
                                if($num != 0 || $num != NULL){
                                    for ($i = 1; $i <= $num; $i ++){
                                        $linha = mysqli_fetch_array($conj_resultados, MYSQLI_ASSOC);
                                        $finalizado = $linha['finalizado'];
                                        $parametro = ''.$linha['id'].', "'.$linha['titulo'].'", "'.$linha['genero'].'", "'.$linha['autor'].'", '.$linha['nPaginas'].', '.$linha['finalizado'].', '.$linha['avaliacao'].', "'.$linha['descricao'].'"';
                                        $parametro2 = ''.$linha['id'].', "'.$linha['titulo'].'", "'.$linha['descricao'].'"';
                                        if ($finalizado == "1"){
                                            $icone = "<img src='../img/ícones/livro_fechado.png' title='Finalizado'>";
                                        } else {$icone = "<img src='../img/ícones/livro_aberto.png' title='Em andamento'>";}
                                        $isEven = $num % 2 == 0;
                                        if ($isEven){
                                            echo ("<div class='column left'>");
                                            echo ("<span  id='".$linha['id']."'>");
                                            echo ("<table>");
                                            echo ("<tr><td colspan='2'>$icone</td></tr>");
                                            echo ("<tr><td colspan='2'><h5>". $linha['titulo']."</h5></td></tr>");
                                            echo ("<tr><td colspan='2'><h6>Gênero: ".$linha['genero']."</h6></td></tr>");
                                            echo ("<tr><td colspan='2'><h6>Autor: ".$linha['autor']."</h6></td></tr>");
                                            echo ("<tr><td colspan='2'><h6>Páginas lidas: ".$linha['nPaginas']."</h6></td></tr>");
                                            echo ("<tr><td><h6>".$linha['avaliacao']." estrelas</h6></td><td><h6 id='estrela'></h6></td></tr>");
                                            echo ("<tr><td colspan='2'><button id='descricao' onclick='descricao($parametro2)'>Descrição</button></td></tr>");
                                            if($idLista == $_SESSION['id_usuario']){
                                                echo ("<tr><td><img src='../img/ícones/editar.png' class='acao' title='editar' onclick='editar($parametro)'></td><td><img src='../img/ícones/deletar.png' class='acao' title='deletar' onclick='apagar(".$linha['id'].")'></td></tr>");
                                            }
                                            echo ("</table>");
                                            echo ("</span>");
                                            echo ("</div>");
                                        } else{
                                            echo ("<div class='column right'>");
                                            echo ("<span  id='".$linha['id']."'>");
                                            echo ("<table>");
                                            echo ("<tr><td colspan='2'>$icone</td></tr>");
                                            echo ("<tr><td colspan='2'><h5>". $linha['titulo']."</h5></td></tr>");
                                            echo ("<tr><td colspan='2'><h6>Gênero: ".$linha['genero']."</h6></td></tr>");
                                            echo ("<tr><td colspan='2'><h6>Autor: ".$linha['autor']."</h6></td></tr>");
                                            echo ("<tr><td colspan='2'><h6>Páginas lidas: ".$linha['nPaginas']."</h6></td></tr>");
                                            echo ("<tr><td><h6>".$linha['avaliacao']." estrelas</h6></td><td><h6 id='estrela'></h6></td></tr>");
                                            echo ("<tr><td colspan='2'><button id='descricao' onclick='descricao($parametro2)'>Descrição</button></td></tr>");
                                            if($idLista == $_SESSION['id_usuario']){
                                                echo ("<tr><td><img src='../img/ícones/editar.png' class='acao' title='editar' onclick='editar($parametro)'></td><td><img src='../img/ícones/deletar.png' class='acao' title='deletar' onclick='apagar(".$linha['id'].")'></td></tr>");
                                            }
                                            echo ("</table>");
                                            echo ("</span>");
                                            echo ("</div>");
                                        }
                                    }
                                } else{
                                    echo('<div class="column middle">');
                                    echo('<h2>Nenhum resultado encontrado</h2>');
                                    echo('</div>');
                                }
                                mysqli_close($conexao);
                            } 
                        } else{
                            echo('<div class="column middle">');
                            echo('<img src="../img/ícones/privado.png">');
                            echo('<h2>Essa lista é privada</h2>');
                            echo('</div>');
                        }
                        
                    ?>
                </div> 
            </div> 
        </div>
    </body>
</html>
