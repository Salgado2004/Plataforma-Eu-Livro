<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: ../index.php");
	}
    $idUsuario = $_SESSION['id_usuario'];
?>
<?php
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
        $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
        mysqli_set_charset($conexao, "utf8");
        if (!$conexao) {
            die("Impossível conectar: " . mysqli_connect_error($conexao));
            }
        mysqli_select_db($conexao, "meus_livros");
        $query = "DELETE FROM livro WHERE id='$id'";
        $resultado = mysqli_query($conexao, $query);
        mysqli_close($conexao);
        header("location: lista.php?id=$idUsuario");
	}
?>
