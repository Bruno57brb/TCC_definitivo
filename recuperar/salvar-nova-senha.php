<?php
require_once "conexao.php";

// Exibe erros de PHP para depuração (remover em produção)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verifica se as senhas foram enviadas
if (!isset($_POST['senha'], $_POST['repetirSenha'], $_POST['email'], $_POST['token'])) {
    die("Dados incompletos!");
}

$email = $_POST['email'];
$token = $_POST['token'];
$senha = $_POST['senha'];
$repetirSenha = $_POST['repetirSenha'];

// Valida se as senhas são iguais
if ($senha !== $repetirSenha) {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'As senhas não coincidem. Tente novamente.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.history.back();
        });
    </script>";
    exit(); 
}

// Verifica o token no banco
$conexao = conectar();
$sql = "SELECT * FROM recuperar_senha WHERE email=? AND token=? AND usado=0";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ss", $email, $token);
$stmt->execute();
$resultado = $stmt->get_result();
$recuperar = $resultado->fetch_assoc();

if (!$recuperar) {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Token inválido ou já utilizado.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
    exit(); 
}

// Gera o hash da nova senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
error_log("Hashed Password: " . $senha_hash); 
// Atualiza a senha no banco
$sql = "UPDATE usuario SET senha=? WHERE email=?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ss", $senha_hash, $email);
if (!$stmt->execute()) {
    error_log("SQL Error: " . $stmt->error); 
    echo "Erro ao atualizar a senha."; 
    exit();
}

// Marca o token como usado
$sql2 = "UPDATE recuperar_senha SET usado=1 WHERE email=? AND token=?";
$stmt2 = $conexao->prepare($sql2);
$stmt2->bind_param("ss", $email, $token);
$stmt2->execute();

// Verifique se a operação foi bem-sucedida antes de redirecionar
if ($stmt2->affected_rows > 0) {
    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Sua senha foi alterada com sucesso.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
} else {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Ocorreu um erro ao marcar o token como utilizado.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
}
exit(); // Garante que o script não continue executando depois do redirecionamento
?>
