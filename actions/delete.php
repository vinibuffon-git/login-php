<?php
session_start();

$conexao = require('../database/config.php');

if (isset($_GET['tabela']) == false) {
    header('Location: ../index.php');
    exit();
}
$tabela = $_GET['tabela'];
$id = $_GET['id'];
try {
    if ($tabela == 'cidades') {
        $sql = "DELETE FROM cidades WHERE idcidades = ?";
        $stmt = $conexao->prepare($sql);
        $return = $stmt->execute([$id]);
        if ($return) {
            $_SESSION['sucesso'] = "Registro excluído com sucesso!";
            header('location: ../index.php');
            exit();
        }
    } else if ($tabela == 'clientes') {
        $sql = "DELETE FROM clientes WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $return = $stmt->execute([$id]);
        if ($return) {
            $_SESSION['sucesso'] = "Registro excluído com sucesso!";
            header('location: ../index.php');
            exit();
        }
    }
} catch (\Exception $err) {
    echo $err;
    exit();
}
