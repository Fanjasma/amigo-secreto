<?php

class PessoaController
{
    private static function atualizarPessoaExistente($dados)
    {
        include_once 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        $id = (int) $_GET['id'];
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

            return $dao->atualizarPessoa($pessoaExistente);
        }
    }

    private static function criarNovaPessoa($dados)
    {
        include_once 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        $emailExistente = $dao->getPessoaPorEmail($dados['email']);

        if ($emailExistente) {
            echo "O email já está em uso por outra pessoa.";
            return;
        }

        $novaPessoa = new PessoaModel();
        $novaPessoa->inicializarPessoa($dados);

        return $dao->salvarPessoa($novaPessoa);
    }

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

        session_start();

        $dao = new PessoaDAO();

        $nomeForm = $emailForm = $idForm = '';

        // Se há um 'id' na URL e se este id existe no banco de dados... 
        if (isset($_GET['id']) && ($pessoa = $dao->getPessoaPorID((int)$_GET['id']))) {
            $nomeForm = $pessoa->nome;
            $emailForm = $pessoa->email;
            $idForm = '?id=' . $pessoa->id;

        // Se houver dados que foram digitados anteriormente no formulário... 
        } elseif (isset($_SESSION['dados_formulario'])) {
            $dadosFormulario = $_SESSION['dados_formulario'];
            unset($_SESSION['dados_formulario']); // Limpa os dados da sessão
            $nomeForm = $dadosFormulario['nome'];
            $emailForm = $dadosFormulario['email'];
        }

        include 'views/modules/form.php';
    }

    public static function save()
    {
        session_start();

        $_SESSION['dados_formulario'] = $_POST;

        if (!isset($_POST['nome']) || !isset($_POST['email'])) {
            $_SESSION['status'] = "ERRO! Não foram encontrados dados para inserir/atualizar";
            header("Location: /");
            exit;
        }

        if (empty($_POST['nome']) || empty($_POST['email'])) {
            $_SESSION['status'] = "ERRO! Todos os campos são obrigatórios.";
            header("Location: /form");
            exit;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['status'] = "ERRO! O endereço de email não é válido.";
            header("Location: /form");
            exit;
        }

        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email']
        ];

        if (isset($_GET['id'])) {
            // Tente atualizar uma pessoa existente 
            $resultado = PessoaController::atualizarPessoaExistente($dados);
        } else {
            // Tente criar uma nova pessoa
            $resultado = PessoaController::criarNovaPessoa($dados);
        }

        // Tratamento de exceção
        if ($resultado)
            $_SESSION['status'] = "Dados inseridos com sucesso.";
        else
            $_SESSION['status'] = "Ocorreu um erro ao inserir os dados.";

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
