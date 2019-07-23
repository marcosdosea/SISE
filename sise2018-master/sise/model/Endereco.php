<?php
    /**
     * Autor: Felipe Santos
     * Date: 22/02/2017
     * Time: 17:23
	 * === Atualização 1 ===
	 * Autor: Daniel Lima
	 * Date: 22/02/2017
	 * Message: Passei nomes das funções para camel case
     * === Atualização 2 ===
     * Autor: Gabriel Santana
     * Date: 04/09/2017
     * Message: Remoção de funções referentes a variavel $idUsuario, devido a atualização da tabela no banco
     */
     class Endereco{

        // Atributos
		private $idEndereco;
		private $logradouroEndereco;
		private $numeroEndereco;
		private $bairroEndereco;
		private $idCidade;
		private $cepEndereco;

		// Método Construtor
		function __construct($idEndereco = null, $logradouroEndereco = null, $numeroEndereco = null, $bairroEndereco = null, $idCidade = null, $cepEndereco = null) {
			$this->idEndereco = $idEndereco;
			$this->logradouroEndereco = $logradouroEndereco;
			$this->numeroEndereco = $numeroEndereco;
			$this->bairroEndereco = $bairroEndereco;
			$this->idCidade = $idCidade;
			$this->cepEndereco = $cepEndereco;
		}

		// Métodos Getters
		function getIdEndereco(){
			return $this->idEndereco;
		}

		function getLogradouroEndereco(){
			return $this->logradouroEndereco;
		}
		
		function getNumeroEndereco(){
			return $this->numeroEndereco;
		}

		function getBairroEndereco(){
			return $this->bairroEndereco;
		}

		function getIdCidade(){
			return $this->idCidade;
		}

		function getCepEndereco(){
			return $this->cepEndereco;
		}
		
		// Métodos Setters
		function setIdEndereco($idEndereco){
			$this->idEndereco = $idEndereco;
		}

		function setLogradouroEndereco($logradouroEndereco){
			$this->logradouroEndereco = $logradouroEndereco;
		}
		
		function setNumeroEndereco($numeroEndereco){
			$this->numeroEndereco = $numeroEndereco;
		}

		function setBairroEndereco($bairroEndereco){
			$this->bairroEndereco = $bairroEndereco;
		}

		function setIdCidade($idCidade){
			$this->idCidade = $idCidade;
		}

		function setCepEndereco($cepEndereco){
			$this->cepEndereco = $cepEndereco;
		}
	}
?>