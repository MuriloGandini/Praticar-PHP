<?php
require_once '../db.php';
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $foto = $_FILES['foto'];

    if($foto['error']===0){
        $extensao = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $nomeUnico = uniqid() . '.' . $extensao;
        move_uploaded_file($foto['tmp_name'],'uploads/' . $nomeUnico);

        $stmt = $pdo->prepare('INSERT INTO fotos (nome) VALUES (?)');
        $stmt->execute([$nomeUnico]);
        header("Location: index.php");
        exit;
    }    
}
$stmt = $pdo->query("SELECT * FROM fotos");
$fotos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="foto">
        <button>Enviar</button>
    </form>
    <?php foreach($fotos as $foto):?>
        <img src="uploads/<?=htmlspecialchars($foto['nome'])?>" width="200">
    <?php endforeach?>
</body>
</html>