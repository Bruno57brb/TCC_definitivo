<?php
include '../conexao/conexao.php';

$conexao = conectar();

$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

// Obter a data atual 
$dataAtual = date('Y-m-d');

// Montar a consulta
$sql = "SELECT alunos.nome, alunos.matricula, alunos.turma, registros.tipo, registros.data, registros.horario, registros.motivo 
        FROM registros 
        inner join alunos on alunos.cpf = registros.cpf_aluno
        WHERE data = '$dataAtual'"; 
if (!empty($busca)) {
    $sql .= " AND (alunos.nome LIKE '%$busca%' OR alunos.matricula LIKE '%$busca%' OR alunos.turma LIKE '%$busca%')";
}
$sql .= " ORDER BY alunos.nome ASC"; 


$resultado = mysqli_query($conexao, $sql);

// Verificar erro
if (!$resultado) {
    echo json_encode(['erro' => mysqli_error($conexao)]);
    exit;
}

// Retornar os dados
$dados = [];
while ($linha = mysqli_fetch_assoc($resultado)) {
    $dados[] = $linha;
}
echo json_encode($dados);
