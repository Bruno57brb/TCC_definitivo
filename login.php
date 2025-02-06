<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <!-- SweetAlert CSS e JS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<?php
session_start();
require_once "conexao/conexao.php";
$conexao = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SIAPE = mysqli_real_escape_string($conexao, $_POST['SIAPE']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // Consulta ao banco de dados
    $sql = "SELECT * FROM usuario WHERE SIAPE = '{$SIAPE}'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);

        // Verifica a senha usando password_verify
        if (password_verify($senha, $dados['senha'])) {
            $_SESSION['SIAPE'] = $SIAPE;
            $_SESSION['id_usuario'] = $dados['id_usuario'];
            $_SESSION['Nome'] = $dados['nome'];
            $_SESSION['Perfil'] = $dados['Perfil'];

            // Exibir mensagem de sucesso
            $_SESSION['login'] = [
                "icon" => 'success',
                "title" => 'Seja bem-vindo, ' . $dados['nome'],
                "showConfirmButton" => false,
                "timer" => 1500
            ];

            // Redirecionar para a página principal
            header("Location: main.php");
            exit();
        } else {
            // Exibir alerta de erro com SweetAlert2
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Credenciais inválidas',
                    text: 'SIAPE ou senha incorretos. Por favor, tente novamente.',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                }).then(() => {
                    location.href='index.php';
                });
            </script>";
        }
    } else {
        // Exibir alerta de erro com SweetAlert2
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Credenciais inválidas',
                text: 'SIAPE ou senha incorretos. Por favor, tente novamente.',
                showConfirmButton: true,
                confirmButtonText: 'Ok'
            }).then(() => {
                location.href='index.php';
            });
        </script>";
    }

    
    mysqli_close($conexao);
}
?>