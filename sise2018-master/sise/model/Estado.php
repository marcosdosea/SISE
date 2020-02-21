<?php
    /**
     * Autor: Kaic
     * Date: 21/02/2017
     * Time: 14:26
     */
    class Estado{

        // Atributos
        private $idEstado;
        private $siglaEstado;
        private $nomeEstado;

        // Método Construtor
        function __construct($idEstado = null, $siglaEstado = null, $nomeEstado = null){
            $this->idEstado = $idEstado;
            $this->siglaEstado = $siglaEstado;
            $this->nomeEstado = $nomeEstado;
        }

        // Métodos Getters
        public function getIdEstado(){
            return $this->idEstado;
        }

        public function getSiglaEstado(){
            return $this->siglaEstado;
        }

        public function getNomeEstado(){
            return $this->nomeEstado;
        }

        // Métodos Setters
        public function setIdEstado($idEstado){
            $this->idEstado = $idEstado;
        }

        public function setSiglaEstado($siglaEstado){
            $this->siglaEstado = $siglaEstado;
        }

        public function setNomeEstado($nomeEstado){
            $this->nomeEstado = $nomeEstado;
        }

    }
?>