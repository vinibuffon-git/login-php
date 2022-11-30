<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
}
$conexao = require('database/config.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset=”UTF-8”>
    <title> Clientes </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <?php include('components/js.php')?>
    <?php include('styles/styles_forms.php') ?>
</head>

<body class="fundo">
    <div class="container">
        <?php include('menu.php') ?>
        <div id="nav-menu"></div>
        <h1>Clientes</h1>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $stmt = $conexao ->prepare("SELECT * FROM  clientes ORDER BY nome");
                            $stmt -> execute();
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo "<tr>
                                        <td>" . $row['nome'] . "</td> 
                                        <td> <a class='btn btn-md btn-success'
                                        href='clientes.php?id=". $row['id'] . "'>
                                        <i class='fa fa-edit'></i></a>
                                        <a class='btn btn-md btn-danger'>
                                        <i class='fa fa-trash'></i></a>
                                        </td>
                                    </tr>";
                            };
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2"></div>
        </div>
        <script src="JS/scripts.js"></script>
    </div>   
</body>

</html>