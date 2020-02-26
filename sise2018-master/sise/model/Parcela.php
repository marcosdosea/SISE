<?php
    /**
     * Autor: Felipe Santos
     * Date: 22/02/2017
     * Time: 17:17
	 * === Atualização 1 ===
	 * Autor: Daniel Lima
	 * Date: 22/02/2017
	 * Message: Passei nomes das funções para camel case
     */
    class Parcela{

        // Atributos
        private $idParcela;
		private $valorParcela;
		private $vencimentoParcela;
		private $statusParcela;
		private $referenciaParcela;
		private $idPagamento;
		private $idParcelaAsaas;
		

		// Método Construtor
		function __construct($idParcela = null, $valorParcela = null, $vencimentoParcela = null, $statusParcela = null, $referenciaParcela = null, $idPagamento = null, $idParcelaAsaas = null){
			$this->idParcela= $idParcela;
			$this->valorParcela = $valorParcela;
			$this->vencimentoParcela = $vencimentoParcela;
			$this->statusParcela = $statusParcela;
			$this->referenciaParcela = $referenciaParcela;
			$this->idPagamento = $idPagamento;
			$this->idParcelaAsaas = $idParcelaAsaas;
		}

		// Métodos Getters
		function getIdParcela(){
			return $this->idParcela;
		}

		function getValorParcela(){
			return $this->valorParcela;
		}
		
		function getVencimentoParcela(){
			return $this->vencimentoParcela;
		}

		function getStatusParcela(){
			return $this->statusParcela;
		}
		
		function getReferenciaParcela(){
			return $this->referenciaParcela;
		}

		function getIdPagamento(){
			return $this->idPagamento;
		}

        function getIdParcelaAsaas(){
            return $this->idParcelaAsaas;
        }

		// Métodos Setters
		function setIdParcela($idParcela){
			$this->idParcela = $idParcela;
		}

		function setValorParcela($valorParcela){
			$this->valorParcela = $valorParcela;
		}
		
		function setVencimentoParcela($vencimentoParcela){
			$this->vencimentoParcela = $vencimentoParcela;
		}

		function setStatusParcela($statusParcela){
			$this->statusParcela = $statusParcela;
		}
		
		function setReferenciaParcela($referenciaParcela){
			$this->referenciaParcela = $referenciaParcela;
		}

		function setIdPagamento($idPagamento){
			$this->idPagamento = $idPagamento;
		}

        function setIdParcelaAsaas($idParcelaAsaas){
            $this->idParcelaAsaas = $idParcelaAsaas;
        }
	}
?>