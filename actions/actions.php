<?php
session_start();
//abrir uma conexão com o banco de dados
$conexao = require('../database/config.php');

//verifica se o tipo não está definido
if (isset($_GET['tipo']) == false) {
    header('Location: ../index.php');
    exit();
}

$tipo = $_GET['tipo'];

//CADASTRO DE CLIENTES
if ($tipo == 'cliente') {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $dtnasc = $_POST["dtnasc"];
    //telefone
    //data nascimento

    if (!isset($nome) || $nome == '') {
        $_SESSION['erro'] = "Informe um nome para o cliente";
        header('Location: ../clientes.php');
        exit();
    }

    if (!isset($email) || $email == '') {
        $_SESSION['erro'] = "Informe um e-mail para o cliente";
        header('Location: ../clientes.php');
        exit();
    }
    if (!isset($telefone) || $telefone == '') {
        $_SESSION['erro'] = "Informe um telefone para o cliente";
        header('Location: ../clientes.php');
        exit();
    }
    if (!isset($dtnasc) || $dtnasc == '') {
        $_SESSION['erro'] = "Informe uma data de nascimento para o cliente";
        header('Location: ../clientes.php');
        exit();
    }

    if (isset($id) && $id != '') {
        $sql = "UPDATE clientes SET nome = ?, email = ?, telefone = ?, dtnasc = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $return = $stmt->execute([$nome, $email, $telefone, $dtnasc, $id]);

        if ($return) {
            $_SESSION['sucesso'] = "Cliente alterado com sucesso!";
            header('Location: ../clientes_lista.php');
            exit();
        }
    } else {
        $sql = "INSERT INTO clientes (nome, email, telefone, dtnasc) VALUES(?,?,?,?)";
        $stmt = $conexao->prepare($sql);
        $return = $stmt->execute([$nome, $email, $telefone, $dtnasc]);

        if ($return) {
            $_SESSION['sucesso'] = "Cliente incluído com sucesso!";
            header('Location: ../clientes_lista.php');
            exit();
        }
    }

} else {
    header('Location: ../index.php');
    exit();
}
