<?php

class SorteioController 
{
    public static function sorteio() 
    {
        include 'models/PessoaDAO.php';

        $dao = new PessoaDAO();

        $pessoas = $dao->obterTodasAsPessoas();
        $qntdPessoas = count($pessoas);

        if($qntdPessoas <= 1){
            session_start();
            $_SESSION['status'] = "ERRO! Para realizar o sorteio, devem existir ao menos duas pessoas cadastradas.";
            header("Location: /");
            exit;
        }

        shuffle($pessoas);

        for ($i = 0; $i < $qntdPessoas; $i++) {
            $primeiraPessoa = $pessoas[$i]->nome;
            $segundaPessoa = ($i == $qntdPessoas - 1) ? $pessoas[0]->nome : $pessoas[$i + 1]->nome;

            $resultadoSorteio[$i] = $primeiraPessoa . ' saiu com ' . $segundaPessoa . ' 🎁 ';
        }

        include 'views/modules/sorteio.php';
    }
}
