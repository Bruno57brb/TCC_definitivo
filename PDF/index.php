<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";
$conexao = conectar();

// Consulta SQL com JOIN para buscar dados das tabelas registros e alunos
$sql = "SELECT 
            registros.cpf_aluno, 
            alunos.nome, 
            alunos.matricula, 
            alunos.turma, 
            registros.motivo, 
            registros.tipo, 
            registros.data, 
            registros.horario
        FROM registros
        INNER JOIN alunos ON registros.cpf_aluno = alunos.cpf";
$result = $conexao->query($sql);

// Verifica se há registros cadastrados
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
    <h2>Relatório</h2>
    <table>
        <tr>
            <th>CPF</th>
            <th>Nome do Aluno</th>
            <th>Matrícula</th>
            <th>Turma</th>
           <th>Motivo</th>
          <th>Tipo</th>
          <th>Data</th>
          <th>Horário</th>
        </tr>";

    // Loop para percorrer os resultados e gerar as linhas da tabela
    while ($dados = $result->fetch_assoc()) {
        //Formatar a data
        $html .= "
    <tr>
        <td>" . $dados['cpf_aluno'] . "</td>
        <td>" . $dados['nome'] . "</td>
        <td>" . $dados['matricula'] . "</td>
        <td>" . $dados['turma'] . "</td>
        <td>" . $dados['motivo'] . "</td>
        <td>" . $dados['tipo'] . "</td>
        <td>" . date('d/m/Y', strtotime($dados['data'])) . "</td>
        <td>" . $dados['horario'] . "</td>
    </tr>";
    }

    $html .= "</table></body></html>";
} else {
    // Caso não haja registros cadastrados
    $html = "<p style='text-align: center; font-size: 18px; color: red;'>Nenhuma entrada ou saída registrada.</p>";
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
$PDF->stream("relatorio.pdf");