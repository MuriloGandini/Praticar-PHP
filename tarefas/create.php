<?php
require_once 'db.php';
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $titulo=$_POST['titulo'];
    if(!empty($titulo)){
        $stmt = $pdo->prepare("INSERT INTO tarefas (titulo) VALUES (?)");
        $stmt->execute([$titulo]);

        header("Location: index.php");
        exit;
    }else{
        header("Location: create.php?erro=titulo_vazio");
        exit;
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_GET['erro'])): ?>
            <p style="color:red;">Título não pode estar vazio</p>
    <?php endif; ?>

    <form action="create.php" method="POST">
        <label for="titulo">Nome da tarefa</label>
        <input type="text" name="titulo">
        <button>CRIAR TAREFA</button>
    </form>
</body>
</html>