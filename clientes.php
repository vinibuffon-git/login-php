<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
}
$conexao = require('database/config.php');

$cliente = null;
if (isset($_GET["id"])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM clientes WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(":id", $id);

    $stmt->execute();
    $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($retorno) {
        $cliente = $retorno;
    };
}
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
    <?php include('components/js.php') ?>
    <?php include('styles/styles_forms.php') ?>
</head>

<body class="fundo">
    <div class="container">
        <?php include('menu.php') ?>
        <div class="row">
            <div class="col-sm-12 ">
                <form method="post" action="actions/actions.php?tipo=cliente">
                    <input type="hidden" class="form-control" name="id" value="<?php echo ($cliente != null ? $cliente['id'] : '') ?>">
                    <div class="row mb-3">
                        <div class="col-sm-6 col-md-4">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo ($cliente != null ? $cliente['nome'] : '') ?>">
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label>E-mail</label>
                            <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo ($cliente != null ? $cliente['email'] : '') ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 col-md-4">
                            <label>Telefone</label>
                            <input type="text" class="form-control" name="telefone" placeholder="Telefone" value="<?php echo ($cliente != null ? $cliente['telefone'] : '') ?>">
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <label>Data de Nascimento</label>
                            <input type="date" class="form-control" name="dtnasc" placeholder="Data de Nasc" value="<?php echo ($cliente != null ? $cliente['dtnasc'] : '') ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 col-md-4">
                            <label>Cidade</label>
                            <select type="text" class="form-control" name="idcidades">
                                <?php
                                $stmt = $conexao->prepare("SELECT idcidades, nome FROM cidades ORDER BY nome");
                                $stmt->execute();
                                echo "<option value = '0'> Selecione...</option>";
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    if ($cliente != null && $cliente['idcidades'] == $row['idcidades']) {
                                        echo "<option selected value = '" . $row['idcidades'] . "'>" . $row['nome'] .  "</option>";
                                    } else {
                                        echo "<option value='" . $row['idcidades'] . "'>" . $row['nome'] .  "</option>";
                                    }
                                }
                                ?>">
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <input class="btn btn-warning" value="Limpar" type="reset">
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</body>

</html>