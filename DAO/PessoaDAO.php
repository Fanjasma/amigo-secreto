<?php

    class PessoaDAO{
        private  $conexao;
        
        public function __construct(){
            $dsn = "mysql:host=localhost:3306;dbname=db_amigo_oculto";

            $this->conexao = new PDO($dsn, 'root');
        }

        public function insert(PessoaModel $model){
            $sql = "INSERT INTO pessoa(nome, email) VALUES(?, ?)";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->nome);
            $stmt->bindValue(2, $model->email);
            $stmt->execute();
        }

        public function update(PessoaModel $model){
            $sql = "UPDATE pessoa SET nome=?, email=? WHERE id=?";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $model->nome);
            $stmt->bindValue(2, $model->email);
            $stmt->bindValue(3, $model->id);
            $stmt->execute();
        }

        public function select(){
            $sql = "SELECT * FROM pessoa";

            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            //Tentar depois com fetchObject?
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        }
        
        public function delete(int $id){
            $sql = "DELETE FROM pessoa WHERE id = ?";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
        }

        public function selectByID(int $id){
            include_once 'models/PessoaModel.php';

            $sql = "SELECT * FROM pessoa where id = ?";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();

            $pessoa = $stmt->fetchObject("PessoaModel");

            if(!$pessoa) 
                return null;
            return $pessoa;
        }

        public function selectByNameAndEmail($pesquisa)
        {
            // Aplicar esse método de bindValue para os outros metodos da classe?
            $sql = "SELECT * FROM pessoa WHERE nome LIKE :termo OR email LIKE :termo";

            $stmt = $this->conexao->prepare($sql);
            $pesquisa = '%' . $pesquisa . '%';
            $stmt->bindValue(':termo', $pesquisa);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, 'PessoaModel');
        }
    }
    
?>