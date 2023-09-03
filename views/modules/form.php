<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigo Secreto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <!-- Alertas -->
    <?php
    if (isset($_SESSION['status'])) {
    ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['status'] ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php
    }
    unset($_SESSION['status']);
    ?>

    <h1>CADASTRO DE PESSOAS</h1>
    <fieldset>
        <legend>Cadastro de Pessoa</legend>

        <form method="post" action="/form/save<?= $idForm ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="nome" name="nome" class="form-control" id="nome" value="<?= $nomeForm ?>" type="email" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" name="email" class="form-control" id="email" value="<?= $emailForm ?>" type="email" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>

    </fieldset>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>