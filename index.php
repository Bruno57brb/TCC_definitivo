<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="img/user.png">
    <link href="css/bootstrap.css" rel="stylesheet">

    <title>LOGIN</title>
    <style>
<?php
include_once"css/index.css";
?>
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="header-text">
                <h1>SIGAE</h1>
                <p>Sistema Integrado de Gerenciamento da Assistência Estudantil</p>
            </div>
            <div class="header-logo">
                <img class="right" src="img/assistencia_estudantil.png" alt="Logo da Assistência Estudantil">
            </div>
        </div>
    </header>

    <div class="login-container">
        <div class="login-box">
            <!-- Formulário de Login -->
            <div id="login-form">
                <div class="col s12 m8 offset-m2 l6 offset-l3">
                    <form action="login.php" method="POST">
                        <h5 class="center-align">LOGIN</h5>

                        <div class="input-field">
                            <input type="text" id="SIAPE" name="SIAPE" class="validate" required autofocus>
                            <label for="SIAPE">SIAPE</label>
                        </div>

                        <div class="input-field senha-container">
                            <input type="password" id="senha" name="senha" class="validate" required>
                            <label for="senha">SENHA</label>
                            <img id="olho" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABDUlEQVQ4jd2SvW3DMBBGbwQVKlyo4BGC4FKFS4+TATKCNxAggkeoSpHSRQbwAB7AA7hQoUKFLH6E2qQQHfgHdpo0yQHX8T3exyPR/ytlQ8kOhgV7FvSx9+xglA3lM3DBgh0LPn/onbJhcQ0bv2SHlgVgQa/suFHVkCg7bm5gzB2OyvjlDFdDcoa19etZMN8Qp7oUDPEM2KFV1ZAQO2zPMBERO7Ra4JQNpRa4K4FDS0R0IdneCbQLb4/zh/c7QdH4NL40tPXrovFpjHQr6PJ6yr5hQV80PiUiIm1OKxZ0LICS8TWvpyyOf2DBQQtcXk8Zi3+JcKfNafVsjZ0WfGgJlZZQxZjdwzX+ykf6u/UF0Fwo5Apfcq8AAAAASUVORK5CYII=" />
                        </div>

                        <button class="btn waves-effect waves-light green" type="submit">Logar</button>

                        <div class="row">
                           
                            <div class="col s12">
                                <a href="recuperar/form-recuperar-senha.php" class="btn waves-effect waves-light orange">Recuperar senha</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>        </div>
           

    <?php include_once "footer.php"; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>


        $(document).ready(function() {
            $('#olho').click(function(e) {
                e.preventDefault();
                var senha = $('#senha');

                if (senha.attr('type') === 'password') {
                    senha.attr('type', 'text');
                    $(this).css('opacity', '0.8');
                } else {
                    senha.attr('type', 'password');
                    $(this).css('opacity', '0.6');
                }
            });

           
            $('select').formSelect();
        });
    </script>
</body>

</html>