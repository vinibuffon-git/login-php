<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
}
$conexao = require('database/config.php');

$cidades = null;
if (isset($_GET["id"])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM cidades WHERE idcidades = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(":id", $id);

    $stmt->execute();
    $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($retorno) {
        $cidades = $retorno;
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
            <div class="col-sm-12">

                <form method="post" action="actions/actions.php?tipo=cidades">

                    <input  type="hidden" class="form-control" name="idcidades" value="<?php echo ($cidades != null ? $cidades['idcidades'] : '') ?>">

                    <div class="row mb-3">
                        <div class="col-sm-9 col-md-4">
                            <label>Nome</label>
                            <input type="text" autofocus class="form-control" name="nome" placeholder="Nome" value="<?php echo ($cidades != null ? $cidades['nome'] : '') ?>">
                        </div>
                        <div class="col-sm-3 col-md-4">
                            <label>Sigla</label>
                            <input type="text" class="form-control" name="uf" placeholder="UF" value="<?php echo ($cidades != null ? $cidades['uf'] : '') ?>">
                        </div>
                    </div>
                    <input class="btn btn-warning" value="Limpar" type="reset">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </form>

            </div>
        </div>
</body>

</html>