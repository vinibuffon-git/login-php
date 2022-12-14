<?php

if (isset($_SESSION['logado'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }

        input {
            border-radius: 15px !important;
            padding: 5px !important;

        }
    </style>
    <?php include('components/js.php'); ?>
</head>

<body>
    <div class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Por favor preencha o seu Usuário e Senha!</p>

                                <form method="POST" action="actions/actions_login.php">

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="usuario" name="usuario" placeholder="Usuário">
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="senha" name="senha" placeholder="Senha">
                                    </div>

                                    <?php
                                    if (isset($_SESSION['erro'])) {
                                        echo "<script>mensagem_erro('" . $_SESSION['erro'] . "')</script>";
                                        unset($_SESSION['erro']);
                                    }
                                    ?>

                                    <div>
                                        <button class="btn btn-outline-light btn-lg px-5" type="submit">ENTRAR</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>