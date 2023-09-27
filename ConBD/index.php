<?php

require_once ("bdConnection.php");

function clean($input){
    $input = trim($input);
    $input = stripslashes($input);
    return htmlspecialchars($input);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["descricao"]) && isset($_GET["un_medida"])){
        $descricao = clean($_GET["descricao"]);
        $un_medidada = clean($_GET["un_medida"]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="produtoStyles.css">
</head>
<body>
    <div class="container">
        <h3 id="menu">Selecione a Opção</h3>

        <div class="buttons">
        <button id="mostrarFormInserir" type="button" class="btn" onclick="callForm()">Inserir produto</button><br>
        <button id="listBtn" type="button" class="btn" onclick="callList();">Listar Produtos</button>
        </div>

        <form action="insertProduto.php" method="GET" id="inserir" style="display: none;">

            <label for="descricao">Descricao:</label>
            <input type="text" name="descricao" id="descricao" required>
            <label for="un_medida">Unidade de medida:</label>
            <input type="text" name="un_medida" id="un_medida" required>
            <div class="buttons">
                <button type="submit" class="btn">Inserir produto</button>
            </div>
        </form>
    </div>
    <script>
        function callForm() {
            var botaoInserir = document.getElementById("mostrarFormInserir");
            botaoInserir.style.display = "none";
            var listBtn = document.getElementById("listBtn");
            listBtn.style.display = "none";
            var mostrar = document.getElementById("inserir");
            mostrar.style.display = (mostrar.style.display === "none") ? "block" : "none";
            var menu = document.getElementById("menu");
            menu.innerHTML = title;
        }
        function callList(){
            window.location.href = "listProduto.php";
        }

    </script>
</body>
</html>
