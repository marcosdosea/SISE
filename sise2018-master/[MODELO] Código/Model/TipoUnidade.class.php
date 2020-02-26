<?php
	class TipoUnidade{
		// Atributos
		private $codigo;
		private $descricao;

		// Método Construtor
		function __construct($codigo = null, $descricao = null){
			$this->codigo = $codigo;
			$this->descricao = $descricao;
		}

		// Métodos Getters
		function getCodigo(){
			return $this->codigo;
		}

		function getDescricao(){
			return $this->descricao;
		}

		// Métodos Setters
		function setCodigo($codigo){
			$this->codigo = $codigo;
		}

		function setDescricao($descricao){
			$this->descricao = $descricao;
		}
	}
?>