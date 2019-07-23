<?php
    /**
     * Autor: Felipe Santos
     * Date: 22/02/2017
     * Time: 17:31
	 * === Atualização 1 ===
	 * Autor: Daniel Lima
	 * Date: 22/02/2017
	 * Message: Passei nomes das funções para camel case
     */
    class Cidade{

        // Atributos
        private $idCidade;
        private $nomeCidade;
		private $idEstado;

        // Método Construtor
        function __construct($idCidade = null, $nomeCidade = null, $idEstado = null) {
            $this->idCidade = $idCidade;
            $this->nomeCidade = $nomeCidade;
			$this->idEstado = $idEstado;
        }

        // Métodos Getters
        function getIdCidade(){
            return $this->idCidade;
        }

        function getNomeCidade(){
            return $this->nomeCidade;
        }
		
		function getIdEstado(){
			return $this->idEstado;
		}

        // Métodos Setters
        function setIdCidade($idCidade){
            $this->idCidade = $idCidade;
        }

        function setNomeCidade($nomeCidade){
            $this->nomeCidade = $nomeCidade;
        }
		function setIdEstado($idEstado){
			$this->idEstado = $idEstado;
		}

    }
?>