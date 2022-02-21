<?php

if (isset($_POST['cademail']) and isset($_POST['cadsenha']) and isset($_POST['cadnome'])) {
    $nome = $_POST["cadnome"];
    $email = $_POST["cademail"];
    $senha = md5($_POST["cadsenha"]);
    $conexao = mysqli_connect("localhost:3306", "usuario", "senha");
    mysqli_set_charset($conexao, "utf8");
    if (!$conexao) {
        die("Impossível conectar: " . mysqli_connect_error($conexao));
    }
    mysqli_select_db($conexao, "meus_livros");
    $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome','$email','$senha')";
    $conj_resultados = mysqli_query($conexao, $query);
    if (!$conj_resultados) {
        echo("<script>alert('Erro no cadastro!')</script>");
    }
    mysqli_close($conexao);
    header("Location: ../index.php");
}

?>
