<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: index.php");
	}
    $idSession = $_SESSION['id_usuario'];
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Pesquisa</title>
        <link rel="stylesheet" href="css/estilo-pesquisa.css">
        <link rel="stylesheet" href="css/estilo-perfis.css">
    </head>
    <body>
        <?php
            if (isset($_POST['filtroText']) and isset($_POST['filtroRadio'])) {
                $filtro = $_POST['filtroText'];
                $table = $_POST['filtroRadio'];
                $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
                mysqli_set_charset($conexao, "utf8");
                if (!$conexao) {
                    die("Impossível conectar: " . mysqli_connect_error($conexao));
                }
                mysqli_select_db($conexao, "meus_livros");
                if($table == 1){
                    $consulta = "SELECT * FROM usuarios WHERE id <> '$idSession' AND nome LIKE '%$filtro%';";
                } else{
                    $consulta = "SELECT DISTINCT titulo, genero, autor FROM livro WHERE titulo LIKE '%$filtro%' OR autor LIKE '%$filtro%' OR genero LIKE '%$filtro%';";
                }
                $conj_resultados = mysqli_query($conexao, $consulta);
                $num = mysqli_num_rows($conj_resultados);
                if ($num > 0){
                    $loop = 1;
                    for ($i = 0; $i <3; $i++){
                        if($loop <= $num){
                            echo("<div class='swiper-container'>");
                                echo("<div class='slider-buttons'>");
                                    echo("<button class='swiper-button-prev'><img src='img/ícones/anterior.png' title='anterior'></button>");
                                echo("</div>");
                                echo("<div class='swiper-wrapper'> ");
                                for($j = 0; $j < 6; $j++){
                                    if($loop <= $num){
                                        echo("<div class='slider-item swiper-slide'>");
                                            echo("<div class='slider-item-content'> ");
                                                for($x = 0; $x < 6; $x++){
                                                    if($loop <= $num){
                                                        $linha = mysqli_fetch_array($conj_resultados, MYSQLI_ASSOC);
                                                        if($table == 1){
                                                            $id = $linha['id'];
                                                            if($linha['imgPerfil'] == NULL){
                                                                $img = "9";
                                                            } else {
                                                                $img = $linha['imgPerfil'];
                                                            }
                                                            $consulta2 = "SELECT COUNT(*) AS 'quantidadeLivros' FROM livro WHERE idUsuario = '$id';";
                                                            $qtdLivros = mysqli_query($conexao, $consulta2);
                                                            $number = mysqli_fetch_array($qtdLivros, MYSQLI_ASSOC);
                                                            echo("<div class='card card$img'>");
                                                                echo("<div class='border'>");
                                                                    echo("<h3>".$linha['nome']."</h3> ");
                                                                    echo("<div class='icons'>");
                                                                    echo("<p>Livros: ".$number['quantidadeLivros']."</p>");
                                                                    echo("<p><a href='pagina2.php?action=0266".$linha['id']."' target='_parent'>Ver perfil</a></p>");
                                                                    echo("</div>");
                                                                echo("</div>");
                                                            echo("</div>");
                                                        } else{
                                                            $caminho = '"livros/avaliacaoGeral.php?titulo='.$linha['titulo'].'"';
                                                            echo("<div class='card card10' onclick='window.location.replace($caminho);' style='cursor: pointer;'>");
                                                                echo("<div class='border'>");
                                                                    echo("<h3 id='tituloLivro'>".$linha['titulo']."</h3> ");
                                                                    echo("<h4>Autor: ".$linha['autor']."</h4>");
                                                                    echo("<h4>Gênero: ".$linha['genero']."</h4>");
                                                                echo("</div>");
                                                            echo("</div>");
                                                        } 
                                                        $loop++;
                                                    }     
                                                }  
                                            echo("</div>");
                                        echo("</div>");
                                    }
                                }
                                echo("</div>");
                                echo("<div class='slider-buttons'>");
                                    echo("<button class='swiper-button-next'><img src='img/ícones/proximo.png' title='proximo'></button>");
                                echo("</div>");
                            echo("</div>");
                        }
                    }
                } else{
                    echo("<h1 id='warning'>Nenhum resultado encontrado :(</h1>");
                }
            } else{
                header('Location: usuarios/perfis.php');
            }
            ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.5/swiper-bundle.min.js"></script>
        <script type="text/javascript" src="js/function-slider.js"></script>
    </body>
</html>
