
<?php
include '../conexao/conexao.php'; // Inclua sua conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
  
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $motivo = $_POST['motivo'];
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];


    
    $conexao = conectar();

 
    $stmt = $conexao->prepare("INSERT INTO registros ( data, horario,   motivo, cpf_aluno, tipo ) VALUES (?, ?, ?, ?, ? )");
    if ($stmt === false) {
        die('Erro ao preparar a query: ' . $conexao->error);
    }

    $stmt->bind_param('sssss',  $data, $horario,   $motivo, $cpf, $tipo); 


    if ($stmt->execute()) {
        echo "Entrada registrada com sucesso!";
    } else {
        echo "Erro ao registrar entrada: " . $stmt->error;
    }

  
    $stmt->close();
    $conexao->close();
}
?>
