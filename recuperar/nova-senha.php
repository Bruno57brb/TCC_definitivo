<?php

// verificar o email e o token
$email = $_GET['email'];
$token = $_GET['token'];

require_once "conexao.php";
$conexao = conectar();
$sql = "SELECT * FROM `recuperar_senha` WHERE email='$email' AND token='$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);

if ($recuperar == null) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Email ou token incorreto. Tente fazer um novo pedido de recuperação de senha.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.location.href = '/tcc/login.php';
        });
    </script>";
    die();
} else {
    // verificar a validade do pedido (data_criacao) e se já foi usado
    date_default_timezone_set('America/Sao_Paulo');
    $agora = new DateTime('now');
    $data_criacao = DateTime::createFromFormat('Y-m-d H:i:s', $recuperar['data_criacao']);
    $umDia = DateInterval::createFromDateString('1 day');
    $dataExpiracao = date_add($data_criacao, $umDia);

    if ($agora > $dataExpiracao) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Link expirado!',
                text: 'Essa solicitação de recuperação de senha expirou! Faça um novo pedido de recuperação de senha.',
                confirmButtonText: 'Ok'
            }).then(() => {
                window.location.href = '../index.php';
            });
        </script>";
        die();
    }

    if ($recuperar['usado'] == 1) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Link já utilizado!',
                text: 'Esse pedido de recuperação de senha já foi utilizado anteriormente! Para recuperar a senha faça um novo pedido de recuperação de senha.',
                confirmButtonText: 'Ok'
            }).then(() => {
                window.location.href = '../index.php';
            });
        </script>";
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Senha</title>
    <!-- Importando o Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Ícones do Materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="green lighten-4">
    <div class="container">
        <div class="row center-align" style="margin-top: 50px;">
            <div class="col s12 m6 offset-m3">
                <div class="card z-depth-3">
                    <div class="card-content">
                        <span class="card-title green-text text-darken-3">Criar Nova Senha</span>
                        <p>Preencha os campos abaixo para definir uma nova senha.</p>
                        <form action="salvar-nova-senha.php" method="post" style="margin-top: 20px;">
                            <input type="hidden" name="email" value="<?= $email ?>">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <div class="input-field">
                                <i class="material-icons prefix">email</i>
                                <input id="email" type="email" value="<?= $email ?>" disabled>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">lock</i>
                                <input id="senha" type="password" name="senha" required>
                                <label for="senha">Senha</label>
                            </div>
                            <div class="input-field">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="repetirSenha" type="password" name="repetirSenha" required>
                                <label for="repetirSenha">Repita a Senha</label>
                            </div>
                            <div class="center-align">
                                <button class="btn waves-effect waves-light green darken-2" type="submit">
                                    Salvar nova senha
                                    <i class="material-icons right">save</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Importando o Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
