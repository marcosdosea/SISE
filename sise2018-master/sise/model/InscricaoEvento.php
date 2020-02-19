<?php
    /**
     * Autor: Kaic
     * Date: 21/02/2017
     * Time: 14:44
     */
    class InscricaoEvento{

        // Atributos
        private $idUsuario;
        private $idEvento;
        private $dataHoraInscricaoEvento;

        //Método Construtor
        function __construct($idUsuario = null, $idEvento = null, $dataHoraInscricaoEvento = null){
            $this->idUsuario = $idUsuario;
            $this->idEvento = $idEvento;
            $this->dataHoraInscricaoEvento = $dataHoraInscricaoEvento;
        }

        // Métodos Getters
        public function getIdUsuario(){
            return $this->idUsuario;
        }

        public function getIdEvento(){
            return $this->idEvento;
        }

        public function getDataHoraInscricaoEvento(){
            return $this->dataHoraInscricaoEvento;
        }

        // Métodos Setters
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }

        public function setIdEvento($idEvento){
            $this->idEvento = $idEvento;
        }

        public function setDataHoraInscricaoEvento($dataHoraInscricaoEvento){
            $this->dataHoraInscricaoEvento = $dataHoraInscricaoEvento;
        }

    }
?>