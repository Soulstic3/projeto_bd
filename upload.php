<?php
    require_once("mysql_connect.php");

    $nomeUsuario = $_POST['nomeUsuario'];
    $imagem = $_FILES['imagem']['tmp_name'];
    $tamanho = $_FILES['imagem']['size'];
    $tipo = $_FILES['imagem']['type'];
    $nome = $_FILES['imagem']['name'];


    if ($imagem != "none")
    {

        $conteudo = file_get_contents($imagem);
        $conteudo = mysqli_real_escape_string($conn, $conteudo); // Para evitar problemas com caracteres especiais

        
        $queryInsercao = "INSERT INTO dados (nomeUsuario, imagem) VALUES ('$nomeUsuario', '$conteudo')";

        if (mysqli_query($conn, $queryInsercao)) {
            $_SESSION['mensagem'] = "Dados enviados corretamente.";
        } else {
            $_SESSION['mensagem'] = "Erro ao enviar os dados. Por favor, tente novamente.";
        }
        header('Location: index.html');
        exit;
    }

?>