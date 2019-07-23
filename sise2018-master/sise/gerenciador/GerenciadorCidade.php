<?php
    /**
     * Autor: Everton Lima
     * Date: 10/03/2017
     * Time: 12:39
     */
    require_once '../model/Cidade.php';
    require_once '../persistencia/PersistenciaCidade.php';
    //Caso a classe utilize o Asaas: dar include em seu respectivo arquivo e seguir o exemplo para respectiva ação
    //Classes que utilizarão o Asaas: Usuario,Pagamento,Parcela
    class GerenciadorCidade {
        private $persistencia;

        function __construct(){
            $this->persistencia = new PersistenciaCidade();
        }

        function adicionar(Cidade $Cidade){
            return $this->persistencia->inserir($Cidade);
        }

        function atualizar(Cidade $Cidade){
            return $this->persistencia->atualizar($Cidade);
        }

        function remover(Cidade $Cidade){
            return $this->persistencia->remover($Cidade);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obter($idCidade){
            return $this->persistencia->obterById($idCidade);
        }
    }
?>