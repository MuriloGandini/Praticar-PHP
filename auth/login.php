<?php
require_once '../db.php';
session_start();
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $username = $_POST['username'];
    $password =$_POST['password'];
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if($usuario && password_verify($password, $usuario['senha_hash'])){
        session_regenerate_id(true);
        $_SESSION['user_id']=$usuario['id'];
        $_SESSION['username'] = $usuario['username'];
        header("Location: index.php");
    }else{
        echo "<script>alert('Usuário ou senha errados')</script>";
    }
}
if(isset($_SESSION['user_id'])){
    header("Location: index.html");
    exit;
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
    <form action="login.php" method="POST">
        <label for="username">Nome de usuário: </label>    
        <input type="text" name="username" required><br>
        <label for="password">Senha: </label>
        <input type="password" name="password"><br>
        <button>Login</button>
    </form>
</body>
</html>