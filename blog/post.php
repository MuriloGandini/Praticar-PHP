<?php
require_once '../db.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $capa = $_FILES['capa'];
    $slug = strtolower(str_replace(' ',  '-', $titulo));
    $slug = preg_replace('/[^a-z0-9-]/',  '', $slug);
    $categoria = $_POST['categoria'];
    $extensao = pathinfo($capa['name'], PATHINFO_EXTENSION);
    $extensoes = ['png', 'jpeg', 'jpg', 'webp'];
    if($capa['error']===0 && in_array($extensao, $extensoes)){
        $nomeUnico = uniqid() . '.' . $extensao;
        move_uploaded_file($capa['tmp_name'],'uploads/' . $nomeUnico);
    }else{
        echo("Imagem inserida com extensão não permitida. Use uma imagem jpg, jpeg, png, ou webp");
    }
    if($categoria === '-'){
        echo "Escolhe uma categoria!";
        exit;
    }
    $stmt = $pdo->prepare("INSERT INTO posts (titulo, conteudo, capa, slug, categoria) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$titulo, $conteudo, $nomeUnico, $slug, $categoria]);
    
    header("Location: all.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="post.php" id="postar">Postar</a>
        <div>
            <a href="all.php">Todos</a>
            <a href="recipes.php">Receitas</a>
            <a href="decorations.php">Decorações</a>
            <a href="diy.php">DIY</a>
        </div>
    </header> 
    <hr>
    <form action="post.php" method="POST" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo"><br>
        <label for="conteudo">Conteúdo:</label><br>
        <input type="text" name="conteudo" id='conteudo'><br>
        <label for="capa">Imagem de capa:</label>
        <input type="file" name="capa"><br>
        <select name="categoria">
            <option value="-" disabled selected>Escolha uma categoria!</option>
            <option value="DIY">DIY</option>
            <option value="DECORACAO">Decoração</option>
            <option value="RECEITA">Receita</option>
        </select>
        <button>Postar</button>
    </form>
</body>
</html>