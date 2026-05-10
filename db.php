<?php
$env = parse_ini_file(__DIR__ . "../.env");
$pdo = new PDO("pgsql:host=localhost;dbname=tarefas", $env['DB_USER'], $env['DB_PASSWORD']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>