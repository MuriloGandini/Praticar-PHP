<?php
require_once '../db.php';
session_start();
if(isset($_SESSION['id'])){
    header("Location: index.html");
    exit;
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];
    if(empty($password) || empty($username) || empty($rePassword)){
        echo "<script>alert('Preencha todos os campos')</script>";
    }elseif(strlen($password)<8 || strlen($rePassword)<8 ){
        echo "<script>alert('Senhas devem ter 8 caracteres no minimo')</script>";
    }elseif($password!==$rePassword){
        echo "<script>alert('Senhas devem ser iguais!')</script>";
    }else{
        $stmt = $pdo->prepare("INSERT INTO users (username, senha_hash) VALUES (?, ?)");
        $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id']=$id;
        $_SESSION['username']=$username;
        header("Location: index.php");
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
    <form action="signin.php" method="POST">
        <label for="username">Nome de usuário: </label>
        <input type="text" name="username" required><br>
        <label for="password">Senha: </label>
        <input type="password" name="password" required><br>
        <label for="rePassword">Confirme sua senha: </label>
        <input type="password" name="rePassword" required><br>
        <button>Criar conta</button>
    </form>
</body>
</html>