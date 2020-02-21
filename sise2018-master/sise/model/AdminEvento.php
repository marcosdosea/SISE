<?php
    /**
     * Autor: John Hed
     * Date: 14/08/2017
     */
    class AdminEvento{

        // Atributos
        private $idUsuario;
        private $idEvento;

        // Método Construtor
        function __construct($idUsuario = null,$idEvento = null){
            $this->idUsuario = $idUsuario;
            $this->idEvento = $idEvento;
        }

        // Metodos Getters
        public function getIdUsuario(){
            return $this->idUsuario;
        }

        public function getIdEvento(){
            return $this->idEvento;
        }

        // Metodos Setters
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }

        public function setIdEvento($idEvento){
            $this->idEvento = $idEvento;
        }
    }
?>