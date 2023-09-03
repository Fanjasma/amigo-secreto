<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigo Secreto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Amigo Secreto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/form">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sorteio">Sorteio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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


    <div class="container-fluid mt-5">
        <div class="row">
            <h1 class="text-center mb-3">Cadastro de Pessoas</h1>
            <div class="container-fluid card col-md-4">
                <div class="card-body">

                    <fieldset>
                        <form method="post" action="/form/save<?= $idForm ?>">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="nome" name="nome" class="form-control" id="nome" value="<?= $nomeForm ?>" type="email">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="email" name="email" class="form-control" id="email" value="<?= $emailForm ?>" type="email" placeholder="email@exemplo.com"required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </fieldset>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>