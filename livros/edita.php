<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: ../index.php");
	}
    $idUsuario = $_SESSION['id_usuario'];
?>
<?php 
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $autor = $_POST['autor'];
    $nPaginas = $_POST['nPaginas'];
    $finalizado = $_POST['finalizado_edit'];
    $rating = $_POST['feedback'];
    $descricao = $_POST['descricao'];
    $id = $_GET['id'];

    if ($titulo != NULL && $genero != NULL && $autor != NULL && $nPaginas != NULL && $finalizado != NULL && $rating != NULL && $descricao != NULL && $id != NULL) {
        $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
        mysqli_set_charset($conexao, "utf8");
        if (!$conexao) {
            die("Impossível conectar: " . mysqli_connect_error($conexao));
            }
        mysqli_select_db($conexao, "meus_livros");
        $query = "UPDATE `meus_livros`.`livro` SET `titulo` = '$titulo', `genero` = '$genero', `autor` = '$autor', `nPaginas` = '$nPaginas', `finalizado` = '$finalizado', `avaliacao` = '$rating', `descricao` = '$descricao' WHERE id='$id';";
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            header("Location: lista.php?id=$idUsuario");
        } else {
            header("Location: lista.php?id=$idUsuario");
        }
        mysqli_close($conexao);
    } else {
        die("Os dados não foram informados corretamente");
        
    }
?>
