<?php
    /**
     * Autor: Felipe Santos
     * Date: 09/03/2017
     * Time: 11:06
     */
    require_once '../model/Endereco.php';
    require_once '../persistencia/PersistenciaEndereco.php';
    //Caso a classe utilize o Asaas: dar include em seu respectivo arquivo e seguir o exemplo para respectiva ação
    //Classes que utilizarão o Asaas: Usuario,Pagamento,Parcela
    class GerenciadorEndereco {
        private $persistencia;

        function __construct(){
            $this->persistencia = new PersistenciaEndereco();
        }

        function adicionar(Endereco $Endereco){
            return $this->persistencia->inserir($Endereco);
        }

        function atualizar(Endereco $Endereco){
            return $this->persistencia->atualizar($Endereco);
        }

        function remover(Endereco $Endereco){
            return $this->persistencia->remover($Endereco);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obterPorId($IdEndereco){
            return $this->persistencia->obterById($IdEndereco);
        }

    }
?>