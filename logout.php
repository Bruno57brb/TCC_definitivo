<?php
sleep(1);

session_start();

session_destroy();

// Redireciona o usuário após a destruição da sessão
header("Location: index.php");

?>
