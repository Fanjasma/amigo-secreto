<?php

class PessoaController
{
    public static function index()
    {
        include 'models/PessoaModel.php';

        $pessoas = GerenciaDados::getLinhasDePessoa();

        include 'views/modules/home.php';
    }

    public static function form()
    {
        include 'models/PessoaModel.php';

        if(isset($_GET['id']))
        {
            $id = (int) $_GET['id'];
            $pessoa = GerenciaDados::getPessoaPorID($id);
        }
        
        include 'views/modules/form.php';
    }

    // NOTA: refletir se algumas operações aqui não poderiam estar na camada model
    public static function save()
    {
        include 'models/PessoaModel.php';

        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email']
        ];

        // NOTA: solução não é boa o suficiente, é provisória
        if (!empty($_POST['id'])) {
            // Atualização de pessoa existente
            $id = (int) $_POST['id'];
            $pessoaExistente = GerenciaDados::getPessoaPorID($id);
            
            if ($pessoaExistente) {
                $pessoaExistente->inicializarPessoa($dados);
                GerenciaDados::atualizarPessoa($pessoaExistente);
            }
        } else {
            // Inserção de nova pessoa
            $novaPessoa = new PessoaModel();
            $novaPessoa->inicializarPessoa($dados);
            GerenciaDados::salvarPessoa($novaPessoa);
        }

        header("Location: /");
    }

    public static function delete()
    {
        include 'models/PessoaModel.php';

        GerenciaDados::deletarPessoa((int)$_GET['id']);

        header("Location: /");
    }
}
