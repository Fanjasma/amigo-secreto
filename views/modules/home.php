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
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/form"> Cadastrar</a>
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
    session_start();
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
            <h1 class="text-center mb-3">Sistema do Amigo Secreto</h1>
            <div class="container-fluid card col-md-6 offset-md-3">
                <div class="card-body">
                    <div class="container-fluid mt-3 mb-2">
                        <form class="input-group" method="post" action="/">
                            <input class="form-control" type="search" id="pesquisa" name="pesquisa" placeholder="Digite um nome ou email">
                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                        </form>
                    </div>

                    <div class="container-fluid">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>E-MAIL</th>
                                <th>AÇÕES</th>
                            </tr>
                            </tr>

                            <?php foreach ($pessoas as $item) : ?>
                                <tr>
                                    <td> <?= $item->id ?> </td>
                                    <td>
                                        <a href="/form?id=<?= $item->id ?>"><?= $item->nome ?></a>
                                    </td>
                                    <td><?= $item->email ?></td>

                                    <td>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacao">
                                            Deletar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmacao" tabindex="-1" aria-labelledby="confirmacaoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirmacaoLabel">Deseja excluir os dados desta pessoa?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Esta ação é irreversível e removerá permanentemente todas as informações relacionadas a esta pessoa do sistema.
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="/deletar?id=<?= $item->id ?>">
                        <button type="button" class="btn btn-danger">Deletar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>