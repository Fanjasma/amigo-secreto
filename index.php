<?php
    include 'controllers/PessoaController.php';

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch($url)
    {
        case '/':
            PessoaController::home();
        break;

        case '/form':
            PessoaController::form();
        break;

        case '/form/save':
            PessoaController::save();
        break;

        case '/delete':
            PessoaController::delete();
        break;

        case '/sorteio':
            PessoaController::sorteio();
        break;

        default:
            echo 'Erro 404';
        break;

    }

?>