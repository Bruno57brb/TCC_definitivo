<?php
require_once "../conexao/conexao.php";
$conexao = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = mysqli_real_escape_string($conexao, $_POST['CPF']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $matricula = mysqli_real_escape_string($conexao, $_POST['matricula']);
    $turma = mysqli_real_escape_string($conexao, $_POST['turma']);
    $dataNasc = mysqli_real_escape_string($conexao, $_POST['dataNasc']);

    $sql = "UPDATE alunos SET 
                nome = '$nome', 
                email = '$email', 
                matricula = '$matricula', 
                turma = '$turma', 
                dataNasc = '$dataNasc' 
            WHERE CPF = '$cpf'";

    if (mysqli_query($conexao, $sql)) {
        // Alerta de sucesso com redirecionamento
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Aluno atualizado com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../alunos.php';
                    }
                });
            </script>
        </body>
        </html>
        ";
    } else {
        
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao atualizar aluno: " . addslashes(mysqli_error($conexao)) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back();
                    }
                });
            </script>
        </body>
        </html>
        ";
    }
}

mysqli_close($conexao);
?>
