<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: ../index.php");
	}
    if (!isset($_GET['img'])){
        header("Location: editaPerfil.php");
    }
    if (isset($_POST['imgsPerfil'])){
        $newImg = $_POST['imgsPerfil'];
        $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
        mysqli_set_charset($conexao, "utf8");
        if (!$conexao) {
            die("Impossível conectar: " . mysqli_connect_error($conexao));
            }
        mysqli_select_db($conexao, "meus_livros");
        $query = "UPDATE `meus_livros`.`usuarios` SET `imgPerfil` = '$newImg' WHERE id='".$_SESSION['id_usuario']."';";
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            header("Location: ../config.php");
        } else {
            header("Location: ../config.php");
        }
        mysqli_close($conexao);
    }
?>
<html lang="pt-br" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
        <title>Edita img</title>
        <link rel="stylesheet" href="../css/estilo-config.css">
    </head>
    <body>
        <div class="conteúdo">
            <div class="config-perfil">
                <?php
                    $imgPerfil = $_GET['img'];
                    echo("<div class='organiza'>");
                        echo("<img src='../img/img-perfis/img$imgPerfil.png' class='imgsTroca'>");
                        echo(" <p class='cabeçalho'>Imagem atual</p> ");
                    echo("</div>");
                ?>
                
                    <div class="options">
                        <form action='editaImg.php' method='post' target="_parent">
                            <?php
                                for($img = 1; $img < 8; $img++){
                                        echo("<div class='imgRadio'>");
                                            echo("<input type='radio' id='img$img' name='imgsPerfil' value='$img'>");
                                            echo("<label for='img$img'><img src='../img/img-perfis/img$img.png' class='imgsTroca'></label>");
                                            $img++;
                                            echo("<input type='radio' id='img$img' name='imgsPerfil' value='$img'>");
                                            echo("<label for='img$img'><img src='../img/img-perfis/img$img.png' class='imgsTroca'></label>");
                                            $img++;
                                            echo("<input type='radio' id='img$img' name='imgsPerfil' value='$img'>");
                                            echo("<label for='img$img'><img src='../img/img-perfis/img$img.png' class='imgsTroca'></label>");
                                        echo("</div>");
                                }
                            ?>
                            <a href="../config.php"class="btnVoltar" target='_parent'> Voltar </a>
                            <button class="btnImg"> Alterar imagem </button>
                        </form>
                    </div>
                
            </div>
        </div>
    </body>
</html>


    
