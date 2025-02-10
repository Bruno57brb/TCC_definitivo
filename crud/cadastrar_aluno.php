<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="../img/user.png">
    <link href="../css/bootstrap.css" rel="stylesheet">

    <title>LOGIN</title>
    <div id="app">
    <style>   
 <?php
     include_once"../css/cadastrar_servidor.css";
   ?>
   </style>
</s>

<style>
      <?php
      include "../css/tema.css";
      ?>
    </style>

<div class="switch-container">
  <div class="cord" id="cord"></div>
  <div id="toggle-theme" class="switch" onclick="toggleTheme()">
    <span id="themeIcon"><i class="fas fa-sun"></i></span> <!-- Ícone do sol -->
  </div>
</div>

<!-- Script para alternar o tema -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const themeButton = document.getElementById('toggle-theme');
    const appContainer = document.getElementById('app'); // Contêiner principal
    const cord = document.getElementById('cord');       // Elemento da corda (se existir)
    const themeIcon = document.getElementById('themeIcon'); // Elemento que contém o ícone

    // Verifica o tema salvo no localStorage
    const savedTheme = localStorage.getItem('theme');

    // Aplica o tema salvo ou o tema padrão (light)
    if (savedTheme === 'dark') {
        appContainer.classList.add('dark-theme');
        themeButton.classList.add('dark', 'active');
        themeIcon.innerHTML = '<i class="fas fa-moon"></i>'; // Ícone da lua para modo escuro
    } else {
        appContainer.classList.add('light-theme');
        themeButton.classList.add('light');
        themeIcon.innerHTML = '<i class="fas fa-sun"></i>'; // Ícone do sol para modo claro
    }

    // Alternar tema ao clicar no botão
    themeButton.addEventListener('click', function () {
        // Efeito de corda alongada ao puxar (se o elemento cord existir)
        if (cord) {
            cord.style.height = '50px'; // Aumenta a corda
            setTimeout(() => {
                cord.style.height = '20px'; // Volta ao tamanho original
            }, 300);
        }

        // Alternar o tema e atualizar localStorage
        if (appContainer.classList.contains('dark-theme')) {
            appContainer.classList.replace('dark-theme', 'light-theme');
            themeButton.classList.replace('dark', 'light');
            localStorage.setItem('theme', 'light');
            themeIcon.innerHTML = '<i class="fas fa-sun"></i>';
        } else {
            appContainer.classList.replace('light-theme', 'dark-theme');
            themeButton.classList.replace('light', 'dark');
            localStorage.setItem('theme', 'dark');
            themeIcon.innerHTML = '<i class="fas fa-moon"></i>';
        }
        themeButton.classList.toggle('active');
    });
});
</script>
<body>
    <header>
        <div class="header-container">
            <div class="header-text">
                <h1>SIGAE</h1>
                <p class="sigae">
               Sistema Integrado de Gerenciamento da Assistência Estudantil
                </p>
            </div>
            <div class="header-logo">
                <img class="right" src="../img/assistencia_estudantil.png" alt="Logo da Assistência Estudantil">
            </div>
        </div>
    </header>
       <!-- Formulário de Cadastro -->
    <div class="cad-container">
        <div class="cad-box">
               
                <div class="col s12 m8 offset-m2 l6 offset-l3">
                    <form action="cadastrar-aluno.php" method="POST">
                           <h5 class="titulo"
                    class="center-align">CADASTRARO DE ALUNO</h5>

                        <div class="input-field">
                            <input type="text" id="nome" name="Nome" class="validate" required autofocus>
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field">
                            <input type="text" id="matricula" name="matricula" class="validate" required>
                            <label for="matricula">Matricula</label>
                        </div>

                        <div class="input-field">
                            <input type="Email" id="Email" name="Email" class="validate" required>
                            <label for="Email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="text" id="turma" name="turma" class="validate" required>
                            <label for="turma">Turma</label>
                        </div>
                        <div class="input-field">
                            <input type="text" id="CPF" name="CPF" class="validate" required>
                            <label for="CPF">CPF</label>
                        </div>
                        <div class="input-field">
                            <input type="date" id="dataNasc" name="dataNasc" class="validate" required>
                            <label for="dataNasc">Data de nascimento</label>
                        </div>
              

                        <div class="row">
                            <div class="col s12">
                                <button type="submit" class="btn waves-effect waves-light blue">Cadastrar</button>
                            </div>
                            <div class="col s12">
                                <a href="../alunos.php" class="btn waves-effect waves-light green" onclick="showLogin()">voltar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
 
    
<?php

$conexao = mysqli_connect("localhost", "root", "", "assistencia");

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $nome = mysqli_real_escape_string($conexao, $_POST['Nome']);
    $matricula = mysqli_real_escape_string($conexao, $_POST['matricula']);
    $email = mysqli_real_escape_string($conexao, $_POST['Email']);
    $turma = mysqli_real_escape_string($conexao, $_POST['turma']);
    $CPF = mysqli_real_escape_string($conexao, $_POST['CPF']);




    
    $sql = "INSERT INTO usuario (Nome, matricula, Email, turma, CPF) VALUES ('{$nome}', '{$matricula}', '{$email}', '{$turma}', '{$CPF}')";
    
    if (mysqli_query($conexao, $sql)) {
        echo "Usuário registrado com sucesso!";
    } else {
        echo "Erro ao registrar usuário: " . mysqli_error($conexao);
    }
}

// Fecha a conexão
mysqli_close($conexao);
?>

    <?php include_once "../footer2.php"; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  
</body>

</html>

