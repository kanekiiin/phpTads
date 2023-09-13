<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once("persistencia.php");
$titulo ="";
$genero ="";
$duracao ="";
$autor = "";
$erro ="";
$s = "selected";
$songs = buscarDados();

function validarNumeroDecimal($duracao) {
    // Use uma expressão regular para verificar se o valor corresponde a um número decimal
    // O padrão regex permite dígitos (0-9) e uma vírgula (,) opcional, seguida por dígitos opcionais
    $padrao = '/^\d+(,\d+)?$/';

    // Use a função preg_match para verificar se o valor corresponde ao padrão regex
    if (preg_match($padrao, $duracao)) {
        return true; // É um número decimal válido
    } else {
        return false; // Não é um número decimal válido
    }
}

if(isset($_POST['submetido'])) {
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $duracao = $_POST['duracao'];
    $autor = $_POST['autor'];
    
    if(! trim($titulo)){
        $erro = "Titulo Invalido!";
    }elseif(! trim($genero)){
        $erro = "Genero Invalido!";
    }elseif (! trim($duracao)||validarNumeroDecimal($duracao)==false) {
        //valida se foi inserido um numero valido
        $erro = "Duracao Invalida!";
    }elseif (! trim($autor)) {
        $erro = "Autor Invalido!";
    }else{

        $id = vsprintf( '%s%s-%s-%s-%s-%s%s%s',
                str_split(bin2hex(random_bytes(16)), 4) );

        $song = array('id' => $id,
                    'titulo' => $titulo,
                    'genero' => $genero,
                    'duracao' => $duracao,
                    'autor' => $autor);
        array_push($songs, $song);

        //Persistir o array songs no arquivo
        salvarDados($songs);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie Sua playlist</title>
</head>
<body>
<div style="display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: lightgrey">
    <h1>Cadastrar musica</h1>

    <h4 style="color: red;"><?=$erro?></h4>
    <form action="" method="POST">
        <input type="text" name="titulo" 
            placeholder="Informe o título" value="<?=$titulo?>"/>
        
        <br><br>

        <select name="genero">
        <option value="">---Selecione o gênero---</option>
            <option value="A" <?php echo ($genero == "A" ? 'selected':'') ?>>Rock</option>
            <option value="B" <?php echo ($genero == "B" ? 'selected':'') ?>>Funk</option>
            <option value="C" <?php echo ($genero == "C" ? 'selected':'') ?>>Indie</option>
            <option value="D" <?php echo ($genero == "D" ? 'selected':'') ?>>Pop</option>
        </select>

        <br><br>

        <input type="text" name="duracao" placeholder="0,00 Duracao" value="<?=$duracao?>"/>

        <br><br>

        <input type="text" name="autor" 
            placeholder="Informe o autor" value="<?=$autor?>"/>

        <br><br>

        <input type="hidden" name="submetido" value="1" />

        <button type="submit">Gravar</button>
        <button type="reset">Limpar</button>
    </form>

    <h3>Sua Playlist</h3>
    <table border="1">
        <tr>
            <td>Título</td>
            <td>Gênero</td>
            <td>Duracao</td>
            <td>Autor</td>
            <td></td>
        </tr>

        <?php foreach($songs as $l): ?>
            <tr>
                <td><?= $l['titulo'] ?></td>
                <td><?php 
                    switch($l['genero']) {
                        case 'A':
                            echo 'Rock';
                            break;
                        
                        case 'B':
                            echo 'Funk';
                            break;

                        case 'C':
                            echo 'Indie';
                            break;

                        case 'D':
                            echo 'Pop';
                            break;

                        default:
                            echo $l['genero'];
                    } 
                ?></td>
                <td><?= $l['duracao'] ?></td>
                <td><?= $l['autor'] ?></td>
                <td><a href="songs_del.php?id=<?= $l['id'] ?>" 
                        onclick="return confirm('Excluir musica da playlist?');">
                        Excluir</a></td>
            </tr>   
        <?php endforeach; ?>

    </table>
</div>
</body>
</html>