<?php
    /**
     * Autor: Amanda
     * Date: 10/03/2017
     * Time: 21:17
     */
    require_once '../model/InscricaoEvento.php';
    require_once '../persistencia/PersistenciaInscricaoEvento.php';
    //Caso a classe utilize o Asaas: dar include em seu respectivo arquivo e seguir o exemplo para respectiva ação
    //Classes que utilizarão o Asaas: Usuario,Pagamento,Parcela
    class GerenciadorInscricaoEvento {
        private $persistencia;

        function __construct(){
            $this->persistencia = new PersistenciaInscricaoEvento();
        }

        function adicionar(InscricaoEvento $InscricaoEvento){
            return $this->persistencia->inserir($InscricaoEvento);
        }

        function atualizar(InscricaoEvento $InscricaoEvento){
            return $this->persistencia->atualizar($InscricaoEvento);
        }

        function remover(InscricaoEvento $InscricaoEvento){
            return $this->persistencia->remover($InscricaoEvento);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obterTodosByIdUsuario($idUsuario){
            return $this->persistencia->obterTodosByIdUsuario($idUsuario);
        }

        function obterInscricao($idUsuario, $idEvento){
            return $this->persistencia->obterInscricao($idUsuario, $idEvento);
        }

        function obterTodosMiniCursosInscritos($idUsuario, $idEvento){
            return $this->persistencia->obterTodosMiniCursosInscritos($idUsuario,$idEvento);
        }

        function obterInscritosNoEvento($idEvento){
            return $this->persistencia->obterInscritosNoEvento($idEvento);
        }
    }
?>