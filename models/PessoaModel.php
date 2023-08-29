<?php
class PessoaModel
{
    public $id, $nome, $email;

    public $rows;

    public function save()
    {
        include 'DAO/PessoaDAO.php';

        $dao = new PessoaDAO();

        $dao->insert($this);
    }

    public function initializePessoa($data) 
    {
        $this->nome = $data['nome'] ?? null;
        $this->email = $data['email'] ?? null;
    }

    public function getAllRows()
    {
        include 'DAO/PessoaDAO.php';

        $dao = new PessoaDAO();

        $this->rows = $dao->select();
    }
    
}

?>