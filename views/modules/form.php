<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigo Secreto</title>
</head>
<body>
    
    <h1>CADASTRO DE PESSOAS</h1>
    <fieldset>
        <legend>Cadastro de Pessoa</legend>

        <form method="post" action="/form/save">
            <input type="hidden" name="id" value="<?= isset($pessoa) ? $pessoa->id : '' ?>">
            
            <label for="nome">Nome:</label>
            <input id="nome" name="nome" value="<?= isset($pessoa) ? $pessoa->nome : '' ?>" type="text" required>

            <label for="email">E-mail:</label>
            <input id="email" name="email" value="<?= isset($pessoa) ? $pessoa->email : '' ?>" type="email" required>

            <button type="submit">Salvar</button>
        </form>

    </fieldset>
    
</body>
</html>