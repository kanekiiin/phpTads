<?php 

include_once("persistencia.php");

//Caputura o ID do livro como parâmetro GET
$id = isset($_GET['id']) ? $_GET['id'] : null;
if(! $id) {
    echo "ID não encontrado!<br>";
    echo "<a href='songs.php'>Voltar</a>";
    exit;
}

//Carrega os songs já cadastrados
$songs = buscarDados();

//Busca o livro, recuprando seu ID
$index = -1;
for($i=0; $i<count($songs); $i++) {
    if($songs[$i]['id'] == $id) {
        $index = $i;
        break;
    }
}

if($index < 0) {
    echo "ID não encontrado!<br>";
    echo "<a href='songs.php'>Voltar</a>";
    exit;
}

//Exclui o livro do array
array_splice($songs, $index, 1);

//Persiste os dados no arquivo
salvarDados($songs, "playlist.json"); 

//Redireciona novamente para o formulário/listagem
header("location: songs.php");