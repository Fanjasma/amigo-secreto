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
?>