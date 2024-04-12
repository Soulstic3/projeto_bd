<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizador de Imagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-auto-rows: 280px;
            gap: 10px;
            padding: 30px;
        }
        .grid-item {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0f0957">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">
        <img src="/img/9192-thumbs-up.png" alt="logo" width="30" height="30">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">Cadastro</a>
           </li>
           <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="exibir.php">Lista</a>
           </li>
        </ul>
      </div>
    </div>
    </nav>
    <br>
  <div class="text-center">
      <form class="d-inline" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="order" value="asc">
        <button type="submit" class="btn btn-primary">Ordem Crescente</button>
      </form>
      
      <form class="d-inline" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="order" value="desc">
        <button type="submit" class="btn btn-primary">Ordem Decrescente</button>
      </form>
  </div>

<div class="grid">
    <?php 
        require_once("mysql_connect.php");

        // Verificar se o parâmetro 'order' foi enviado via GET
        $order = isset($_GET['order']) ? $_GET['order'] : '';

        // Preparar a consulta SQL com base no parâmetro 'order'
        $sql = "SELECT id, nomeUsuario, imagem FROM dados";

        if ($order == 'asc') {
            $sql .= " ORDER BY id ASC";
        } elseif ($order == 'desc') {
            $sql .= " ORDER BY id DESC";
        } else {
            // Caso nenhum parâmetro de ordenação seja especificado, ordenar por padrão em ordem decrescente
            $sql .= " ORDER BY id DESC";
        }

        $result = $conn->query($sql);

        while($data = mysqli_fetch_assoc($result)) {
            $id = $data['id'];
            $nomeUsuario = $data['nomeUsuario'];
            $imagemBase64 = base64_encode($data['imagem']);
            echo "<div class='grid-item'>";
            echo "<img src='data:image/jpeg;base64, $imagemBase64' alt='Imagem' />";
            echo "<p>ID: $id</p>";
            echo "<p>Nome de Usuário: $nomeUsuario</p>";
            echo "</div>";
        }
    ?>
</div>

<script>
    $(document).ready(function(){
        $('.grid').masonry({
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            gutter: 10
        });
    });
</script>
</body>
</html>