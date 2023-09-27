<?php

require_once("bdConnection.php");

$id = 0;
if(isset($_GET['id'])) //verifica se o id existe
    $id = $_GET['id'];

if(!$id) { // verifica se o id é valido
    echo "ID inválido!<br>";
    echo "<button> <a href='listProduto.php'>Voltar</a> </button>";
    exit;
}

$conn = Connection::getConnection();

$sql = "DELETE FROM produtos WHERE id = ?"; // consulta o sql pra deletar o item correspondente ao id
$stm = $conn->prepare($sql);
$stm->execute([$id]); // executa a ação (excluir com o parâmetro id)

header("Location: listProduto.php"); //redireciona o usuário de volta a página de listagem