<?php
    include 'controllers/PessoaController.php';
    include 'controllers/SorteioController.php';

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch($url)
    {
        case '/':
            PessoaController::home();
        break;

        case '/form':
            PessoaController::form();
        break;

        case '/form/salvar':
            PessoaController::salvar();
        break;

        case '/deletar':
            PessoaController::deletar();
        break;

        case '/sorteio':
            SorteioController::sorteio();
        break;

        default:
            echo 'Erro 404';
        break;

    }

?>