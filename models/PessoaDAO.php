<?php
class PessoaDAO
{
    private  $conexao;

    public function __construct()
    {
        $dsn = "mysql:host=localhost:3306;dbname=db_amigo_oculto";

        $this->conexao = new PDO($dsn, 'root');
    }

    public function salvarPessoa(PessoaModel $pessoa)
    {
        $sql = "INSERT INTO pessoa(nome, email) VALUES(?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $pessoa->nome);
        $stmt->bindValue(2, $pessoa->email);
        return $stmt->execute();
    }

    public function atualizarPessoa(PessoaModel $pessoa)
    {
        $sql = "UPDATE pessoa SET nome=?, email=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $pessoa->nome);
        $stmt->bindValue(2, $pessoa->email);
        $stmt->bindValue(3, $pessoa->id);
        return $stmt->execute();
    }

    public function deletarPessoa(int $id) 
    {
        $sql = "DELETE FROM pessoa WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    public function obterTodasAsPessoas()
    {
        $sql = "SELECT * FROM pessoa";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        //Tentar depois com fetchObject?
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function obterPessoaPorID(int $id)
    {
        include_once 'models/PessoaModel.php';

        $sql = "SELECT * FROM pessoa where id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $pessoa = $stmt->fetchObject("PessoaModel");

        if (!$pessoa)
            return null;
        return $pessoa;
    }

    public function obterPessoaPorEmail(string $email)
    {
        include_once 'models/PessoaModel.php';

        $sql = "SELECT * FROM pessoa where email = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();

        $pessoa = $stmt->fetchObject("PessoaModel");

        if (!$pessoa)
            return null;
        return $pessoa;
    }

    public function obterPessoasPorNomeOuEmail(string $pesquisa)
    {
        include_once 'models/PessoaModel.php';

        // Aplicar esse método de bindValue para os outros metodos da classe?
        $sql = "SELECT * FROM pessoa WHERE nome LIKE :termo OR email LIKE :termo";

        $stmt = $this->conexao->prepare($sql);
        $pesquisa = '%' . $pesquisa . '%';
        $stmt->bindValue(':termo', $pesquisa);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'PessoaModel');
    }
}
