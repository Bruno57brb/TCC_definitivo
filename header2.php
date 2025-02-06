<?php 

// Conectar ao banco de dados
require_once "conexao/conexao.php";
$conexao = conectar();

// Consulta SQL para selecionar todos os usuários
$sql = "SELECT * FROM usuario";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

// Fechar a conexão
mysqli_close($conexao);
?>

<link rel="stylesheet" href="css/materialize.css">

<!-- Barra de navegação superior -->
<nav class="green">
<div class="header-logo">
                <img class="right" src="../img/assistencia_estudantil.png" alt="Logo da Assistência Estudantil">
            </div>
  <div class="nav-wrapper">
    <!-- Botão de Hambúrguer/Seta -->
    <div class="toggle-btn" id="toggleBtn" onclick="toggleSidebar()">
      &#9776; <!-- Ícone de três barras inicialmente -->
    </div>

    <!-- Nome do usuário e imagem -->
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li>

      </li>
    </ul>
  </div>
</nav>

<!-- Sidebar (menu lateral) -->
<nav id="sidebar">
  <div class="navbar">
    <div class="logo">
      <img src="../img/user.jpg" alt="Logo">
      <h1><?php echo $row['nome']; ?></h1>
    </div>
    <ul>
  

<li><a href="crud/cadastrar_servidor.php" class="nav-link" 
   <?php if ($_SESSION['Perfil'] != 1) { echo 'onclick="event.preventDefault(); showPermissionAlert();"'; } ?>>
    <i class="fab fa-dochub"></i>
    <span class="nav-item">Cadastro do servidor</span>
</a></li>


<script>
    function showPermissionAlert() {
        Swal.fire({
            icon: 'error',
            title: 'Acesso negado',
            text: 'Você não tem permissão para acessar essa página.',
            confirmButtonText: 'OK'
        });
    }
</script>


      <li><a href="crud/cadastrar_aluno.php" class="nav-link">
          <i class="fab fa-dochub"></i>
          <span class="nav-item">Cadastro do discente</span>
        </a></li>



        <li><a href="crud/editar-perfil-usuario.php" class="nav-link" 
   <?php if ($_SESSION['Perfil'] != 1) { echo 'onclick="event.preventDefault(); showPermissionAlert();"'; } ?>>
    <i class="fas fa-cog"></i>
    <span class="nav-item">Editar perfil de usuário</span>
</a></li>


<script>
    function showPermissionAlert() {
        Swal.fire({
            icon: 'error',
            title: 'Acesso negado',
            text: 'Você não tem permissão para acessar essa página.',
            confirmButtonText: 'OK'
        });
    }
</script>







      <li><a href="../logout.php" class="nav-link logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Logout</span>
        </a></li>
    </ul>
  </div>

</nav>

<style>
  <?php include_once "css/header.css"  ?>
</style>

<script>

    
  // Função para alternar a visibilidade da sidebar
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleBtn');

    if (sidebar.style.left === '0px') {
      sidebar.style.left = '-280px'; // Fecha a sidebar
      toggleBtn.innerHTML = '&#9776;'; // Volta para ícone de hambúrguer
      toggleBtn.style.left = '15px'; // Reposiciona o botão para a esquerda
    } else {
      sidebar.style.left = '0px'; // Abre a sidebar
      toggleBtn.innerHTML = '&#8592;'; // Muda para ícone de seta
      toggleBtn.style.left = '300px'; // Reposiciona o botão após a sidebar
    }
  }
</script>


