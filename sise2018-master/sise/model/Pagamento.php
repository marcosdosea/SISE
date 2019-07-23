<?php
    /**
     * Autor: Felipe Santos
     * Date: 21/02/2017
     * Time: 17:05
	 * === Atualização 1 ===
	 * Autor: Daniel Lima
	 * Date: 22/02/2017
	 * Message: Passei nomes das funções para camel case
     */
    class Pagamento{

        // Atributos
        private $idPagamento;
		private $valorPagamento;
		private $quantidadeParcelasPagamento;
		private $statusPagamento;
		private $idUsuario;
		private $idEvento;
		private $tipoPagamento;

		// Método Construtor
		function __construct($idPagamento = null, $valorPagamento = null, $quantidadeParcelasPagamento = null, $statusPagamento = null, $idUsuario = null, $idEvento = null, $tipoPagamento = null){
			$this->idPagamento = $idPagamento;
			$this->valorPagamento = $valorPagamento;
			$this->quantidadeParcelasPagamento = $quantidadeParcelasPagamento;
			$this->statusPagamento = $statusPagamento;
			$this->idUsuario = $idUsuario;
			$this->idEvento = $idEvento;
			$this->tipoPagamento = $tipoPagamento;
		}

		// Métodos Getters
		function getIdPagamento(){
			return $this->idPagamento;
		}

		function getValorPagamento(){
			return $this->valorPagamento;
		}
		
		function getQuantidadeParcelasPagamento(){
			return $this->quantidadeParcelasPagamento;
		}

		function getStatusPagamento(){
			return $this->statusPagamento;
		}
		
		function getIdUsuario(){
			return $this->idUsuario;
		}

		function getIdEvento(){
			return $this->idEvento;
		}

		function getTipoPagamento(){
			return $this->tipoPagamento;
		}
		
		// Métodos Setters
		function setIdPagamento($idPagamento){
			$this->idPagamento = $idPagamento;
		}

		function setValorPagamento($valorPagamento){
			$this->valorPagamento = $valorPagamento;
		}
		
		function setQuantidadeParcelasPagamento($quantidadeParcelasPagamento){
			$this->quantidadeParcelasPagamento = $quantidadeParcelasPagamento;
		}

		function setStatusPagamento($statusPagamento){
			$this->statusPagamento = $statusPagamento;
		}
		
		function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
		}

		function setIdEvento($idEvento){
			$this->idEvento = $idEvento;
		}

		function setTipoPagamento($tipoPagamento){
			$this->tipoPagamento = $tipoPagamento;
		}
	}
?>