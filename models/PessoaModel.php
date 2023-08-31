<?php
class PessoaModel
{
    public $id, $nome, $email;

    public function inicializarPessoa($dados)
    {
        $this->nome = $dados['nome'] ?? null;
        $this->email = $dados['email'] ?? null;
    }
}

class GerenciaDados
{
    public static function salvarPessoa(PessoaModel $pessoa)
    {
        include 'DAO/PessoaDAO.php';
        $dao = new PessoaDAO();

        $dao->insert($pessoa);
    }

    public static function atualizarPessoa(PessoaModel $pessoa)
    {
        include_once 'DAO/PessoaDAO.php';
        $dao = new PessoaDAO();

        $dao->update($pessoa);
    }

    public static function deletarPessoa(int $id)
    {
        include_once 'DAO/PessoaDAO.php';
        $dao = new PessoaDAO();

        $dao->delete($id);
    }

    public static function getLinhasDePessoa()
    {
        include 'DAO/PessoaDAO.php';
        $dao = new PessoaDAO();

        return $dao->select();
    }

    public static function getPessoaPorID(int $id)
    {
        include 'DAO/PessoaDAO.php';
        $dao = new PessoaDAO();

        return $dao->selectByID($id);
    }

    public static function getLinhasDePessoaPorNomeOuEmail(string $pesquisa)
    {
        include 'DAO/PessoaDAO.php';
        $dao = new PessoaDAO();

        return $dao->selectByNameAndEmail($pesquisa);
    }
}
