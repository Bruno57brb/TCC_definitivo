<?php

require_once "../conexao/conexao.php";
$conexao = conectar();

if (isset($_POST['SIAPE'])) { 
    $siape = $_POST['SIAPE'];
    $sql = "DELETE FROM usuario WHERE SIAPE = ?"; 
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $siape); 

    if ($stmt->execute()) {
        // Exibe alerta de sucesso e redireciona
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Usuário excluído com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'editar-perfil-usuario.php?excluido=1';
                    }
                });
            </script>
        </body>
        </html>
        ";
    } else {
        // Exibe alerta de erro com a mensagem do banco
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao excluir usuário: " . addslashes($stmt->error) . "',
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
