<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";
$conexao = conectar();

// Consulta SQL para buscar os dados da tabela alunos
$sql = "SELECT cpf, nome, email, matricula, turma, dataNasc FROM alunos ORDER BY nome ASC";
$result = $conexao->query($sql);

// Verifica se há registros na tabela alunos
if ($result->num_rows > 0) {
    // Inicia a construção do HTML para o PDF com CSS incorporado
    $html = "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Relatório de Alunos</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            h2 {
                text-align: center;
                color: #2e7d32;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 1px solid #ccc;
            }
            th, td {
                padding: 8px 12px;
                text-align: left;
            }
            th {
                background-color: #4caf50;
                color: #ffffff;
            }
            td {
                color: #1b5e20;
            }
            tr:nth-child(even) {
                background-color: #c8e6c9;
            }
        </style>
    </head>
    <body>
        <h2>Relatório de Alunos</h2>
        <table>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Matrícula</th>
                <th>Turma</th>
                <th>Data de Nascimento</th>
            </tr>";

    // Loop para percorrer os resultados e gerar as linhas da tabela
    while ($dados = $result->fetch_assoc()) {
        $html .= "
        <tr>
            <td>" . $dados['cpf'] . "</td>
            <td>" . $dados['nome'] . "</td>
            <td>" . $dados['email'] . "</td>
            <td>" . $dados['matricula'] . "</td>
            <td>" . $dados['turma'] . "</td>
            <td>" . date('d/m/Y', strtotime($dados['dataNasc'])) . "</td>
        </tr>";
    }

    $html .= "</table></body></html>";
} else {
    // Caso não haja registros na tabela alunos
    $html = "<p style='text-align: center; font-size: 18px; color: red;'>Nenhum aluno cadastrado.</p>";
}

// Carrega a biblioteca Dompdf
use Dompdf\Dompdf;
require_once 'dompdf/autoload.inc.php';

// Inicializa o objeto Dompdf
$PDF = new Dompdf(['enable_remote' => true]);

// Carrega o HTML gerado para o PDF
$PDF->loadHtml($html);

// Define o tamanho e a orientação do papel
$PDF->setPaper('A3', 'portrait');

// Renderiza o PDF
$PDF->render();

// Exibe o PDF no navegador
$PDF->stream("relatorio_alunos_" . date('Y-m-d') . ".pdf");
?>
