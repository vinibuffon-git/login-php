<?php
session_start();

$conexao = require('../database/config.php');

$tabela = $_GET['tabela'];
$chave = $_GET['chave'];

$sql = "UPDATE ". $tabela . " SET excluido = true WHERE id = ?";
$stmt = $conexao->prepare($sql);
$retur = $stmt->execute();

if ($return) {
    $_SESSION['sucesso'] = "Registro excluído com sucesso!";
    header('location: ../index.php');
    exit();
}