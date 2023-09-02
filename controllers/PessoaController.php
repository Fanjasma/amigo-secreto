<?php

class PessoaController
{
    public static function home()
    {
        include 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';

        if (empty($pesquisa))
            // Mostra todas as pessoas no banco de dados
            $pessoas = $dao->getLinhasDePessoa();
        else
            // Mostra as pessoas que têm nome ou email iguais à pesquisa
            $pessoas = $dao->getLinhasDePessoaPorNomeOuEmail($pesquisa);

        include 'views/modules/home.php';
    }

    public static function form()
    {
        include 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $pessoa = $dao->getPessoaPorID($id);
        }

        include 'views/modules/form.php';
    }

    public static function save()
    {
        include 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email']
        ];

        // NOTA: solução não é boa o suficiente, é provisória
        if (!empty($_POST['id'])) {
            // Atualização de pessoa existente
            $id = (int) $_POST['id'];
            $pessoaExistente = $dao->getPessoaPorID($id);

            if ($pessoaExistente) {
                if ($dados['email'] !== $pessoaExistente->email) {
                    // Verifique se o novo email já existe no banco de dados
                    $emailExistente = $dao->getPessoaPorEmail($dados['email']);

                    if ($emailExistente) {
                        echo "O email já está em uso por outra pessoa.";
                        return;
                    }
                }
                $pessoaExistente->inicializarPessoa($dados);
                $dao->atualizarPessoa($pessoaExistente);
            }
        } else {
            $emailExistente = $dao->getPessoaPorEmail($dados['email']);

            if ($emailExistente) {
                echo "O email já está em uso por outra pessoa.";
                return;
            }
            $novaPessoa = new PessoaModel();
            $novaPessoa->inicializarPessoa($dados);
            $dao->salvarPessoa($novaPessoa);
        }

        header("Location: /");
    }

    public static function delete()
    {
        include 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        $dao->deletarPessoa((int)$_GET['id']);

        header("Location: /");
    }

    public static function sorteio() //Controller a parte pra isso?
    {
        include 'models/PessoaDAO.php';
        
        $dao = new PessoaDAO();

        $pessoas = $dao->getLinhasDePessoa();
        $qntdPessoas = count($pessoas);

        shuffle($pessoas);

        for ($i = 0; $i < $qntdPessoas; $i++) {
            $primeiraPessoa = $pessoas[$i]->nome;
            $segundaPessoa = ($i == $qntdPessoas - 1) ? $pessoas[0]->nome : $pessoas[$i + 1]->nome;

            echo $primeiraPessoa . ' saiu com ' . $segundaPessoa . ' 🎁 ';
        }
    }
}
