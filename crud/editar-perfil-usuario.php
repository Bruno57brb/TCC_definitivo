<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<div id="app">
    <?php
    session_start();
    include_once "../header2.php";
    require_once "../conexao/conexao.php";
    $conexao = conectar();
    ?>
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



    <main class="container">
        <h1>Servidores</h1>
        <a href='cadastrar_servidor.php' class="green waves-effect waves-light btn">
            <i class="material-icons right">add</i>Inserir
        </a>
        <a href='../main.php' class="red 3 waves-effect waves-light btn right">
            <i class="material-icons right">arrow_back</i>Voltar
        </a>
        <table class="highlight">
            <thead>
            <tr class="tabela">
                <tr>
                    <th>SIAPE</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Operação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT SIAPE, nome, email FROM usuario ORDER BY nome ASC";
                $resultado = mysqli_query($conexao, $sql);

                if ($resultado) {
                    while ($linha = mysqli_fetch_assoc($resultado)) {
                        ?>
                         <tr class="tabela">
                            <td><?php echo $linha['SIAPE']; ?></td>
                            <td><?php echo $linha['nome']; ?></td>
                            <td><?php echo $linha['email']; ?></td>
                            <td>
                                
                                <!-- Botão para excluir -->
                                <a href="#modalExcluir<?php echo $linha['SIAPE']; ?>" class="btn-floating btn-small waves-effect waves-light red modal-trigger">
                                    <i class="material-icons">delete</i>
                                </a>
                                <!-- Modal de Exclusão -->
                                <div id="modalExcluir<?php echo $linha['SIAPE']; ?>" class="modal">
                                    <div class="modal-content">
                                        <h4>Atenção!</h4>
                                        <p>Você confirma a exclusão do servidor: <strong><?php echo $linha['nome']; ?></strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="excluir-servidor.php" method="POST">
                                            <input type="hidden" name="SIAPE" value="<?php echo $linha['SIAPE']; ?>">
                                            <button type="submit" name="btn-excluir" class="modal-action modal-close waves-effect waves-light btn red darken-1">Excluir</button>
                                            <a href="#!" class="modal-close waves-effect waves-light btn green">Cancelar</a>
                                        </form>
                                    </div>
                                </div>

                                <!-- Botão para editar -->
                                <a href="#editModal<?php echo $linha['SIAPE']; ?>" class="btn-floating btn-small waves-effect waves-light blue modal-trigger">
                                    <i class="material-icons">edit</i>
                                </a>
                                <!-- Modal de Edição -->
                                <div id="editModal<?php echo $linha['SIAPE']; ?>" class="modal">
                                    <div class="modal-content">
                                        <h4>Editar Servidor</h4>
                                        <form action="editar-servidor.php" method="POST">
                                            <div class="input-field">
                                                <input type="text" id="editNome<?php echo $linha['SIAPE']; ?>" name="nome" value="<?php echo $linha['nome']; ?>" required>
                                                <label for="editNome<?php echo $linha['SIAPE']; ?>">Nome</label>
                                            </div>
                                            <div class="input-field">
                                                <input type="email" id="editEmail<?php echo $linha['SIAPE']; ?>" name="email" value="<?php echo $linha['email']; ?>" required>
                                                <label for="editEmail<?php echo $linha['SIAPE']; ?>">Email</label>
                                            </div>
                                            <div class="input-field">
                                                <input type="text" id="editSIAPE<?php echo $linha['SIAPE']; ?>" name="SIAPE" value="<?php echo $linha['SIAPE']; ?>" readonly>
                                                <label for="editSIAPE<?php echo $linha['SIAPE']; ?>">SIAPE</label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn waves-effect waves-light green">Salvar</button>
                                                <a href="#!" class="modal-close btn waves-effect waves-light red">Cancelar</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>Erro ao buscar dados: " . mysqli_error($conexao) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>

     
    </main>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #4caf50;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style><br><br><br><br><br>
    <?php include_once "../footer2.php"; ?>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
           
            
            var elems = document.querySelectorAll('.modal');
            M.Modal.init(elems, {
                opacity: 0.7,
                inDuration: 100,
                outDuration: 120,
                dismissible: true,
                startingTop: '10%',
                endingTop: '15%'
            });
        });
    </script>
</body>
</html>
