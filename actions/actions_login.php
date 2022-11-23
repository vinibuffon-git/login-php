<?php
session_start();

$conexao = require('../database/config.php');

$usuario = $_POST["usuario"];  

$senha = $_POST["senha"];

$sql = "SELECT * FROM usuarios WHERE login = :login AND senha = md5(md5(:senha))";

$stmt = $conexao -> prepare($sql);
$stmt -> bindValue(":login", $usuario);
$stmt -> bindValue(":senha", $senha);

$stmt -> execute();
$retorno = $stmt -> fetch(PDO::FETCH_ASSOC);
if($retorno){
    echo "Olá {$retorno["nome"]}, agradecemos seu retorno.";
    $_SESSION["erro"] = " ";
}else{
    $_SESSION["erro"] = "Dados de acesso Inválidos";
    header('Location: ../login.php');
};