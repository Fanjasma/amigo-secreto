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

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        }
        
        public function delete(int $id){
            $sql = "DELETE FROM pessoa where id = ?";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
        }
    }
    
?>