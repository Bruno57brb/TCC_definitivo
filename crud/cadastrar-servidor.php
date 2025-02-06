<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
</body>
</html>

<?php

if (isset($_POST['Nome'], $_POST['SIAPE'], $_POST['Email'], $_POST['Senha'], $_POST['Perfil'])) {
    
    $Nome = $_POST['Nome'];
    $SIAPE = $_POST['SIAPE'];
    $Email = $_POST['Email'];
    $Senha = $_POST['Senha'];
    $Perfil = $_POST['Perfil'];

    
    require_once "../conexao/conexao.php";
    $conexao = conectar();

    
    $stmt = $conexao->prepare("SELECT * FROM usuario WHERE SIAPE = ?");
    $stmt->bind_param("s", $SIAPE); 
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário já existe
    if ($result->num_rows > 0) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro! Usuário ja existe',
                text: 'Falha ao cadastrar.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = 'cadastrar_servidor.php';
            });
            </script>";
    } else {
        // Hash da senha
        $senha_hash = password_hash($Senha, PASSWORD_DEFAULT);

        
        $stmt = $conexao->prepare("INSERT INTO usuario (Nome, SIAPE, Email, senha, Perfil) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $Nome, $SIAPE, $Email, $senha_hash, $Perfil); // 's' indica que todos os parâmetros são strings

        // Executar a inserção
        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso! Usuário Cadastrado',
                text: 'Pessoa cadastrada com sucesso.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '../main.php';
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao cadastrar',
                text: 'Falha ao cadastrar.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '../cadastrar_usuario.php'; // Redireciona de volta para o formulário
            });
            </script>";
        }
    }

  
    $stmt->close();
  
    $conexao->close();
} 
?>