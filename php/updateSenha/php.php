<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
</head>
<body>

<form action="http://localhost/innotech/php/updateSenha/VerificaSenha.php" method="post">
    <label for="ID">ID do Usuário:</label>
    <input type="text" id="ID" name="ID" required>

    <label for="novaSenha">Nova Senha:</label>
    <input type="password" id="novaSenha" name="novaSenha" required>

    <button type="submit">Alterar Senha</button>
</form>

</body>
</html>
