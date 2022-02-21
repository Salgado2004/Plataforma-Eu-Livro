<?php

$titulo = $_POST['titulo'];
$genero = $_POST['genero'];
$autor = $_POST['autor'];
$nPaginas = $_POST['pgn'];
$finalizado = $_POST['finalizado'];
$rating = $_POST['feedback'];
$descricao = $_POST['texto'];
$usuario = $_POST['user'];
$action = $_POST['action'];

if ($titulo != NULL && $genero != NULL && $autor != NULL && $nPaginas != NULL && $finalizado != NULL && $rating != NULL && $descricao != NULL && $usuario != NULL) {
    $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
    mysqli_set_charset($conexao, "utf8");
    if (!$conexao) {
        die("Impossível conectar: " . mysqli_connect_error($conexao));
        }
    mysqli_select_db($conexao, "meus_livros");
    $query = "INSERT INTO livro (titulo, genero, autor, nPaginas, finalizado, descricao, avaliacao, idUsuario) VALUES ('$titulo', '$genero', '$autor', '$nPaginas', '$finalizado', '$descricao', '$rating', '$usuario')";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
        header("Location: ../pagina2.php?action=$action");
    } else {
        header("Location: ../pagina2.php?action=$action");
    }
    mysqli_close($conexao);
} else {
    die("Os dados não foram informados corretamente");
    
}

?>
