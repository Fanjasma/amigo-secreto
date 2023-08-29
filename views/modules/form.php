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
            <label for="nome">Nome:</label>
            <input id="nome" name="nome" type="text">

            <label for="email">E-mail:</label>
            <input id="email" name="email" type="email">

            <button type="submit">Salvar</button>
        </form>
    </fieldset>
    
</body>
</html>