<?php
require_once "db.php";
$feita=$_GET['feita'];
$id=$_GET['id'];
$titulo=$_GET['titulo'];
if ($_SERVER["REQUEST_METHOD"]==="POST"){
    $tituloNovo = $_POST['titulo'];
    $feita = $_POST['feito'];
    $stmt =$pdo->prepare("UPDATE tarefas SET titulo=?, feita=? WHERE id= ?");
    $stmt->execute([$tituloNovo, $feita, $id]);
    header("Location:index.php");
    exit;
}
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
    <form action="editar.php?id=<?=$id?>&titulo=<?=$titulo?>&feita=<?=$feita?>" method="POST">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" value="<?=$titulo?>">
        <select name="feito">
            <option value="TRUE" <?= $feita === 'true' ? 'selected' : '' ?>>Feito</option>
            <option value="FALSE" <?= $feita === 'false' ? 'selected' : '' ?>>Não feito</option>
        </select>
        <button>Salvar mudancas</button>
    </form>
</body>
</html>