<?php
require_once "../conexao/conexao.php";
$conexao = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SIAPE = mysqli_real_escape_string($conexao, $_POST['SIAPE']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);

   
    $sql = "UPDATE usuario SET 
                nome = '$nome', 
                email = '$email' 
            WHERE SIAPE = '$SIAPE'";

    if (mysqli_query($conexao, $sql)) {
        // Exibe alerta de sucesso
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Usuário atualizado com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'editar-perfil-usuario.php?success=1';
                    }
                });
            </script>
        </body>
        </html>
        ";
    } else {
        // Exibe alerta de erro com mensagem do banco de dados
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao atualizar usuário: " . addslashes(mysqli_error($conexao)) . "',
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
