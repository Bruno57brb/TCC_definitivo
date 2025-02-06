<?php
require_once "../conexao/conexao.php";
$conexao = conectar();

if (isset($_POST['CPF'])) {
    $cpf = $_POST['CPF'];
    $sql = "DELETE FROM alunos WHERE CPF = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $cpf);

    if ($stmt->execute()) {
        // Alerta de sucesso
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Aluno excluído com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../alunos.php?excluido=1';
                    }
                });
            </script>
        </body>
        </html>
        ";
    } else {
        // Alerta de erro
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao excluir o aluno: " . addslashes($stmt->error) . "',
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
?>
