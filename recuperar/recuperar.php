<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="">
    <title>Recuperação de Senha</title>
</head>

<body>

</body>

</html>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "conexao.php";
$conexao = conectar();

$email = $_POST['email'];
$sql = "SELECT * FROM usuario WHERE email='$email'";
$resultado = executarSQL($conexao, $sql);

$usuario = mysqli_fetch_assoc($resultado);

if ($usuario == null) {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Email não cadastrado!',
            text: 'Faça o cadastro e em seguida realize o login.',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../index.php';
            }
        });
    </script>";
    die();
}

// Gerar um token único
$token = bin2hex(random_bytes(50));

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';
include 'config_.php';

$mail = new PHPMailer(true);

try {
    // Configurações do PHPMailer
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setLanguage('br');
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $config['email'];
    $mail->Password = $config['senha_email'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Configuração do destinatário e do conteúdo
    $mail->setFrom($config['email'], 'Sistema');
    $mail->addAddress($usuario['email'], $usuario['nome']);
    $mail->addReplyTo($config['email'], 'sistema');

    $mail->isHTML(true);
    $mail->Subject = 'Recuperação de Senha do Sistema';
    $mail->Body = 'Olá!<br>
        Você solicitou a recuperação da sua conta no nosso sistema.
        Para isso, clique no link abaixo para realizar a troca de senha:<br>
        <a href="' . $_SERVER['SERVER_NAME'] . '/tcc/recuperar/nova-senha.php?email='
        . $usuario['email'] . '&token=' . $token . 
        '">Clique aqui para recuperar o acesso à sua conta!</a><br><br>
        Atenciosamente<br>
        Equipe do sistema...';

    $mail->send();

    // Registrar o token no banco
    date_default_timezone_set('America/Sao_Paulo');
    $data = new DateTime('now');
    $agora = $data->format('Y-m-d H:i:s');

    $sql2 = "INSERT INTO `recuperar_senha` 
             (email, token, data_criacao, usado)
             VALUES ('" . $usuario['email'] . "', '$token', 
             '$agora', 0)";
    executarSQL($conexao, $sql2);

    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Email enviado com sucesso!',
            text: 'Confira seu email para recuperar o acesso.',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../index.php';
            }
        });
    </script>";
} catch (Exception $e) {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro ao enviar o email!',
            text: 'Mailer Error: {$mail->ErrorInfo}',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../index.php';
            }
        });
    </script>";
}
?>
