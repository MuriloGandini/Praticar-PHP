<?php
require_once '../db.php';
$slug = $_GET['slug'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = ?");
$stmt->execute([$slug]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <h1><?=$post['titulo']?></h1>
    <img src="uploads/<?=$post['capa']?>" alt="<?=$post['titulo']?>">
    <p><?=$post['conteudo']?></p>

</body>
</html>