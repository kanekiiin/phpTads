<?php

require_once("bdConnection.php");

$conn = Connection::getConnection();

$sql = "SELECT * FROM produtos";
if ($conn == null){ 
    echo "Sem dados Cadastrados!";
    exit;
}
$stm = $conn->prepare($sql);
$stm->execute(); 

$result = $stm->fetchAll(); 
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="produtoStyles.css">
    <title>Produtos Cadastrados</title>
</head>
<body>

<div class="container">
    <table border="1";>
        
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Unidade de medida</th>
        </tr>
        <?php foreach ($result as $r): ?>
            <tr>
                <td><?= $r["id"] ?></td>
                <td><?= $r["descricao"] ?></td>
                <td><?= $r["un_medida"] ?></td>
                <td><a href="excluirProduto.php?id=<?= $r["id"] ?>"  onclick="return confirm('Confirmar Exlusão?');">Excluir</a> </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class='buttons'> <a href='index.php'><button class='btn' > Voltar</button></a> </div>
</div>
</body>
</html>