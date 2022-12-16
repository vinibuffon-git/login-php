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
if ($tipo == 'clientes') {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $dtnasc = $_POST["dtnasc"];
    $idcidades = $_POST["idcidades"];

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
    if (!isset($idcidades) || $idcidades == '') {
        $_SESSION['erro'] = "Informe uma cidade para o cliente";
        header('Location: ../clientes.php');
        exit();
    }
    if (isset($id) && $id != '') {
        $sql = "UPDATE clientes SET nome = ?, email = ?, telefone = ?, dtnasc = ?, idcidades = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $return = $stmt->execute([$nome, $email, $telefone, $dtnasc, $idcidades, $id]);

        if ($return) {
            $_SESSION['sucesso'] = "Cliente alterado com sucesso!";
            header('Location: ../clientes_lista.php');
            exit();
        }
    } else {
        $sql = "INSERT INTO clientes (nome, email, telefone, dtnasc, idcidades) VALUES(?,?,?,?,?)";
        $stmt = $conexao->prepare($sql);
        $return = $stmt->execute([$nome, $email, $telefone, $dtnasc, $idcidades]);

        if ($return) {
            $_SESSION['sucesso'] = "Cliente incluído com sucesso!";
            header('Location: ../clientes_lista.php');
            exit();
        }
    }
} else if ($tipo == 'cidades') {

    $id = $_POST["idcidades"];
    $nome = $_POST["nome"];
    $uf = $_POST["uf"];

    if (!isset($nome) || $nome == '') {
        $_SESSION['erro'] = "Informe um nome para a cidade";
        header('Location: ../cidades.php');
        exit();
    }

    if (!isset($uf) || $uf == '') {
        $_SESSION['erro'] = "Informe am UF da cidade";
        header('Location: ../cidades.php');
        exit();
    }

    if (isset($id) && $id != '') {
        $sql = "UPDATE cidades SET nome = ?, uf = ? WHERE idcidades = ?";
        $stmt = $conexao->prepare($sql);
        $return = $stmt->execute([$nome, $uf, $id]);

        if ($return) {
            $_SESSION['sucesso'] = "Cidade alterada com sucesso!";
            header('Location: ../cidades_lista.php');
            exit();
        }
    } else {
        $sql = "INSERT INTO cidades (nome, uf) VALUES(?,?)";
        $stmt = $conexao->prepare($sql);
        $return = $stmt->execute([$nome, $uf]);

        if ($return) {
            $_SESSION['sucesso'] = "Cidade incluída com sucesso!";
            header('Location: ../cidades_lista.php');
            exit();
        }
    }
} else {
    header('Location: ../index.php');
    exit();
}
