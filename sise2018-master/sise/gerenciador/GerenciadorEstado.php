<?php
    /**
     * Autor: Paulo David Almeida da Silva (pdavidalmeida@hotmail.com)
     * Date: 10/03/2017
     * Time: 10:04
     */
    require_once '../model/Estado.php';
    require_once '../persistencia/PersistenciaEstado.php';
    //Caso a classe utilize o Asaas: dar include em seu respectivo arquivo e seguir o exemplo para respectiva ação
    //Classes que utilizarão o Asaas: Usuario,Pagamento,Parcela
    class GerenciadorEstado {

        private $persistencia;

        function __construct(){
            $this->persistencia = new PersistenciaEstado();
        }

        function adicionar(Estado $Estado){
            return $this->persistencia->inserir($Estado);
        }

        function atualizar(Estado $Estado){
            return $this->persistencia->atualizar($Estado);
        }

        function remover(Estado $Estado){
            return $this->persistencia->remover($Estado);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obter($idEstado){
            return $this->persistencia->obterById($idEstado);
        }
    }
?>