<?php
    $resultado;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $numero1=$_POST["numero1"];
        $numero2 = $_POST["numero2"];
        $select = $_POST["operacao"];
    }
    switch($select){
        case "":
            $resultado =  "Isso ta errado dog! Seleciona uma ai";
            break;
        case "multiplicar":
            $resultado = $numero1 * $numero2;
            break;
        case "dividir":
            $resultado = $numero1 / $numero2;
            break;
        case "somar":
            $resultado = $numero1 + $numero2;
            break;
        case "subtrair":
            $resultado = $numero1 - $numero2;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
</head>
<body>
    <h1>Formulário de calculadora</h1>
    <form method="POST" action="main.php">
        <label for="numero1">Número 1:</label>
        <input type="text" name="numero1">
        <select name="operacao">
            <option selected disabled value="">Escolha uma operação</option>
            <option value="multiplicar">Multiplicar</option>
            <option value="dividir">Dividir</option>
            <option value="somar">Somar</option>
            <option value="subtrair">Subtrair</option>

        </select>
        <label for="numero2">Número 2:</label>
        <input type="text" name="numero2"><br>
        <button type="submit">Enviar</button>
    </form>
    <h1><?=$resultado?></h1>
</body>
</html>   