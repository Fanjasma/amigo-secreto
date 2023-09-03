<?php

class PessoaController
{
    private static function atualizarPessoaExistente($dados)
    {
        include_once 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        $id = (int) $_GET['id'];
        $pessoaExistente = $dao->obterPessoaPorID($id);

        if ($pessoaExistente) {
            if ($dados['email'] !== $pessoaExistente->email) {
                // Verifique se o novo email já existe no banco de dados
                $emailExistente = $dao->obterPessoaPorEmail($dados['email']);

                if ($emailExistente) {
                    $_SESSION['status'] = "ERRO! Este endereço de e-mail já foi cadastrado.";
                    header("Location: /form");
                    exit;
                }
            }
            $pessoaExistente->inicializarPessoa($dados);

            return $dao->atualizarPessoa($pessoaExistente);
        }
        // Retorna falso se não existir a pessoa procurada
        return false;
    }

    private static function criarNovaPessoa($dados)
    {
        include_once 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        $emailExistente = $dao->obterPessoaPorEmail($dados['email']);

        // Verifica se o email já existe no banco de dados
        if ($emailExistente) {
            $_SESSION['status'] = "ERRO! Este endereço de e-mail já foi cadastrado.";
            header("Location: /form");
            exit;
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
            $pessoas = $dao->obterTodasAsPessoas();
        else
            // Mostra as pessoas que têm nome ou email iguais à pesquisa
            $pessoas = $dao->obterPessoasPorNomeOuEmail($pesquisa);

        include 'views/modules/home.php';
    }

    public static function form()
    {
        include 'models/PessoaDAO.php';

        session_start();

        $dao = new PessoaDAO();

        $nomeForm = $emailForm = $idForm = '';

        // Se há um 'id' na URL e se este id existe no banco de dados... 
        if (isset($_GET['id']) && ($pessoa = $dao->obterPessoaPorID((int)$_GET['id']))) {
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

    public static function salvar()
    {
        session_start();

        $_SESSION['dados_formulario'] = $_POST;

        // Verifica se há dados para inserir ou atualizar
        if (!isset($_POST['nome']) || !isset($_POST['email'])) {
            $_SESSION['status'] = "ERRO! Não foram encontrados dados para inserir/atualizar.";
            header("Location: /");
            exit;
        }

        // Verifica se algum campo do formulário não foi preenchido
        if (empty($_POST['nome']) || empty($_POST['email'])) {
            $_SESSION['status'] = "ERRO! Todos os campos são obrigatórios.";
            header("Location: /form");
            exit;
        }

        // Verifica se o email é válido
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

        // Verifica se a operação de inserção/atualização teve êxito
        if ($resultado)
            $_SESSION['status'] = "Dados inseridos com sucesso.";
        else
            $_SESSION['status'] = "Ocorreu um erro ao inserir os dados.";

        header("Location: /");
    }

    public static function deletar()
    {
        include 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        $dao->deletarPessoa((int)$_GET['id']);

        header("Location: /");
    }

}
