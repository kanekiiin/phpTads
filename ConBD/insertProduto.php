<?php

include_once("bdConnection.php");

if(! isset ($_GET['descricao']) ||! isset($_GET['un_medida'])){
    echo "Informe a descrição e unidade de medida";
    exit;
}
$descricao = $_GET['descricao'];
$un_medida = $_GET['un_medida'];

$conn = Connection::getConnection();


$sql = "INSERT INTO produtos (descricao, un_medida) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $descricao, PDO::PARAM_STR, 50);
$stmt->bindParam(2, $un_medida, PDO::PARAM_STR, 50);

$result = $stmt->execute();

echo "<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Produtos</title>
<link rel='stylesheet' href='produtoStyles.css'>
</head>
<body>
<div class='container'>";
if ($result) {
    echo "<h3> Produto cadastrado com sucesso! <br> ID: " . $conn->lastInsertId(). "</h3><br>";
} else {
    echo "Erro ao cadastrar o produto.";
}
echo "<div class='buttons'> <a href='index.php'><button class='btn' > Voltar </button></a></div> </div>";