<?php
    /**
     * Autor: John Hed
     * Date: 14/08/2017
     */
    require_once '../model/AdminEvento.php';
    require_once '../persistencia/PersistenciaAdminEvento.php';

    class GerenciadorAdminEvento {

        private $persistencia;

        function __construct(){
            $this->persistencia = new PersistenciaAdminEvento();
        }

        function adicionar(AdminEvento $AdminEvento){
            return $this->persistencia->inserir($AdminEvento);
        }

        function atualizar(AdminEvento $AdminEvento){
            return $this->persistencia->atualizar($AdminEvento);
        }

        function remover(AdminEvento $AdminEvento){
            return $this->persistencia->remover($AdminEvento);
        }
        function obter($idUsuario){
            return $this->persistencia->obterById($idUsuario);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

    }
?>