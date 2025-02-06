<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <!-- Importando o Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Ícones do Materialize -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="green lighten-4">
    <div class="container">
        <div class="row center-align" style="margin-top: 50px;">
            <div class="col s12 m6 offset-m3">
                <div class="card z-depth-3">
                    <div class="card-content">
                        <span class="card-title green-text text-darken-3">Recuperação de Senha</span>
                        <p>Digite o seu email para criar uma nova senha. Você receberá um link de recuperação.</p>
                        <form action="recuperar.php" method="post" style="margin-top: 20px;">
                            <div class="input-field">
                                <i class="material-icons prefix">email</i>
                                <input id="email" type="email" name="email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="center-align">
                                <button class="btn waves-effect waves-light green darken-2" type="submit">
                                    Enviar email de recuperação
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Importando o Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>