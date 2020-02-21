<?php
    /**
     * Autor: Amanda
     * Date: 21/02/2017
     * Time: 20:42
	 * === Atualização 1 ===
	 * Autor: Daniel Lima
	 * Date: 22/02/2017
	 * Message: Adicionei variáveis $idEndereco e $idEventoPai
     * === Atualização 2 ===
     * Autor: Gabriel Santana
     * Date: 24/07/2017
     * Message: Variável $PartMinEvento adicionada
     */
    class Evento{

        // Atributos
        private $idEvento;
        private $nomeEvento;
		private $siglaEvento;
		private $descricaoEvento;
		private $inicioIscricoesEvento;
		private $fimInscricoesEvento;
		private $dataInicioEvento;
		private $dataFimEvento;
		private $idEndereco;
		private $idEventoPai;
		private $urlImagem;
		private $valorEvento;
		private $qntdParcelasPermitidas;
		private $partMinEvento;
		private $ativoEvento;

        // Método Construtor
        function __construct($idEvento = null, $nomeEvento = null, $siglaEvento = null, $descricaoEvento = null, $inicioIscricoesEvento = null, $fimInscricoesEvento = null, $dataInicioEvento = null, $dataFimEvento = null, $idEndereco = null, $idEventoPai = null,$urlImagem = null, $valorEvento = null, $qntdParcelasPermitidas = null, $partMinEvento = null, $ativoEvento = null){
            $this->idEvento = $idEvento;
            $this->nomeEvento = $nomeEvento;
			$this->siglaEvento = $siglaEvento;
			$this->descricaoEvento = $descricaoEvento;
			$this->inicioIscricoesEvento = $inicioIscricoesEvento;
			$this->fimInscricoesEvento = $fimInscricoesEvento;
			$this->dataInicioEvento = $dataInicioEvento;
			$this->dataFimEvento = $dataFimEvento;
			$this->idEndereco = $idEndereco;
			$this->idEventoPai = $idEventoPai;
			$this->urlImagem = $urlImagem;
			$this->valorEvento = $valorEvento;
			$this->qntdParcelasPermitidas = $qntdParcelasPermitidas;
			$this->partMinEvento = $partMinEvento;
			$this->ativoEvento = $ativoEvento;
        }

        // Métodos Getters
        function getIdEvento(){
            return $this->idEvento;
        }

        function getNomeEvento(){
            return $this->nomeEvento;
        }
		
		function getSiglaEvento(){
			return $this->siglaEvento;
		}
		
		
		function getDescricaoEvento(){
			return $this->descricaoEvento;
		}
		
		function getInicioInscricoesEvento(){
			return $this->inicioIscricoesEvento;
		}
		
		function getFimInscricoesEvento(){
			return $this->fimInscricoesEvento;
		}
		
		function getDataInicioEvento(){
			return $this->dataInicioEvento;
		}
		
		function getDataFimEvento(){
			return $this->dataFimEvento;
		}
		
		function getIdEndereco(){
			return $this->idEndereco;
		}

		function getIdEventoPai(){
			return $this->idEventoPai;
		}

		function getUrlImagem(){
            return $this->urlImagem;
        }

        function getValorEvento(){
            return $this->valorEvento;
        }

        function getQntdParcelasPermitidas(){
            return $this->qntdParcelasPermitidas;
        }

        function getPartMinEvento(){
            return $this->partMinEvento;
        }

        public function getAtivoEvento(){
            return $this->ativoEvento;
        }



        // Métodos Setters
        function setIdEvento($idEvento){
            $this->idEvento = $idEvento;
        }

        function setNomeEvento($nomeEvento){
            $this->nomeEvento = $nomeEvento;
        }
		
		function setSiglaEvento($siglaEvento){
            $this->siglaEvento = $siglaEvento;
        }
		
		function setDescricaoEvento($descricaoEvento){
            $this->descricaoEvento = $descricaoEvento;
        }
		
		function setInicioInscricoesEvento($inicioIscricoesEvento){
            $this->inicioIscricoesEvento = $inicioIscricoesEvento;
        }
		
		function setFimInscricoesEvento($fimInscricoesEvento){
            $this->fimInscricoesEvento = $fimInscricoesEvento;
        }
		
		function setDataInicioEvento($dataInicioEvento){
            $this->dataInicioEvento = $dataInicioEvento;
        }
		
		function setDataFimEvento($dataFimEvento){
            $this->dataFimEvento = $dataFimEvento;
        }

		function setIdEndereco($idEndereco){
            $this->idEndereco = $idEndereco;
        }
		
		function setIdEventoPai($idEventoPai){
            $this->idEventoPai = $idEventoPai;
        }

        function setUrlImagem($urlImagem){
            $this->urlImagem = $urlImagem;
        }

        function setValorEvento($valorEvento){
            $this->valorEvento = $valorEvento;
        }

        function setQntdParcelasPermitidas($qntdParcelasPermitidas){
            $this->qntdParcelasPermitidas = $qntdParcelasPermitidas;
        }

        function setPartMinEvento($partMinEvento){
            $this->partMinEvento = $partMinEvento;
        }

        public function setAtivoEvento($ativoEvento){
            $this->ativoEvento = $ativoEvento;
        }
    }
?>