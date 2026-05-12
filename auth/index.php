<?php
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    session_destroy();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>PABENS</p>
    <form action="index.php" method="POST">
        <button>Sair</button>
    </form>
</body>
</html>