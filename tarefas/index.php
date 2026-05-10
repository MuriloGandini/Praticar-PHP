<?php
require_once "db.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["deletar"])){
    $stmt= $pdo->prepare('DELETE FROM tarefas WHERE id=?');
    $stmt->execute([$_POST["id"]]);
    header("Location: index.php");
    exit;
}


$stmt = $pdo->query('SELECT * FROM tarefas');
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    
    <ul>
        <?php foreach ($tarefas as $tarefa): ?>
            <li><?= htmlspecialchars($tarefa["titulo"]) ?></li>
            <form method="POST" action="index.php">
                <input type="hidden" name="id" value="<?=$tarefa['id']?>">
                <?php if($tarefa['feita']): ?>
                    <i style="color:lime;" class="fa-solid fa-check"></i>
                <?php endif; ?>
                <?php if(!$tarefa['feita']): ?>
                    <i style="color:red;" class="fa-solid fa-x"></i>
                <?php endif; ?>
                <button type="submit" name="deletar">Deletar</button>
                <a href="editar.php?id=<?=$tarefa['id']?>&titulo=<?=urlencode($tarefa['titulo'])?>&feita=<?=$tarefa['feita']===true ? 'true' : 'false'?>">Editar</a>
            </form>
        <?php endforeach; ?>
    </ul>
    <a href="create.php">Criar uma tarefa</a>
</body>
</html>