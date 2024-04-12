<?php
require_once("mysql_connect.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "SELECT imagem FROM dados WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        header('Content-Type: image/jpeg');
        echo $row['imagem'];
    } else {
        echo 'imagem_nao_encontrada.jpg'; // Se a imagem não for encontrada, exibir uma imagem padrão
    }
} else {
    echo 'Erro: ID não foi recebido.';
}
?>
