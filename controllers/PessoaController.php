<?php

class PessoaController
{
    public static function index()
    {
        include 'models/PessoaModel.php';

        $model = new PessoaModel();
        $model->getAllRows();

        include 'views/modules/home.php';
    }

    public static function form()
    {
        include 'views/modules/form.php';
    }

    public static function save()
    {
        include 'models/PessoaModel.php';

        $model = new PessoaModel();

        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email']
        ];
        $model->initializePessoa($dados);
        
        $model->save();

        header("Location: /");
    }
}
