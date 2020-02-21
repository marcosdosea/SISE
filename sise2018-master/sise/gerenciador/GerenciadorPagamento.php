<?php
    /**
     * Autor: Kaic
     * Date: 10/03/2017
     * Time: 11:48
     */
    require_once '../model/Pagamento.php';
    require_once '../persistencia/PersistenciaPagamento.php';
    //Caso a classe utilize o Asaas: dar include em seu respectivo arquivo e seguir o exemplo para respectiva ação
    //Classes que utilizarão o Asaas: Usuario,Pagamento,Parcela
    class GerenciadorPagamento {
        private $persistencia;

        function __construct(){
            $this->persistencia = new PersistenciaPagamento();
        }

        function adicionar(Pagamento $pagamento){
            return $this->persistencia->inserir($pagamento);
        }

        function atualizar(Pagamento $pagamento){
            return $this->persistencia->atualizar($pagamento);
        }

        function remover(Pagamento $pagamento){
            return $this->persistencia->remover($pagamento);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obter($idPagamento){
            return $this->persistencia->obterById($idPagamento);
        }

        function obterPorUsuarioEvento($idUsuario, $idEvento){
            return $this->persistencia->obterPeloUsuarioEvento($idUsuario,$idEvento);
        }

    }
?>