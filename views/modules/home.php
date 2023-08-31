<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Amigo Secreto</title>
</head>
<body>
        
    <h1>PÁGINA PRINCIPAL/LISTAGEM DE PESSOAS</h1>
    
    <table>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
        </tr>

        <?php foreach($pessoas as $item): ?>
        <tr>
            <td><?= $item->id ?></td>
            <td>
                <a href="/form?id=<?= $item->id ?>"><?= $item->nome ?></a>
            </td>
            <td><?= $item->email ?></td>
            <td> <a href="/delete?id=<?= $item->id ?>">X</a></td>
        </tr>
        <?php endforeach ?>
    </table>


</body>
</html>