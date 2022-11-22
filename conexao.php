<?php

$conexao = require('./banco.php');

$usuario = $_POST["usuario"];  

$senha = $_POST["senha"];

$sql = "SELECT * FROM usuarios WHERE login = :login AND senha = md5(md5(:senha))";

$stmt = $conexao -> fetch(PDO::FETCH_ASSOC);
$stmt -> bindValue(":login", $usuario);
$stmt -> bindValue(":senha", $senha);

$stmt