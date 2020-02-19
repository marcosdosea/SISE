<?php
    /**
     * Autor: Amanda
     * Date: 21/02/2017
     * Time: 20:51
	 * === Atualização 1 ===
	 * Autor: Daniel Lima
	 * Date: 22/02/2017
	 * Message: Adicionei variáveis $idFederacao, $idAsaasUsuario;
     * troquei $ejUsuario para $empresaUsuario de acordo com o banco;
     * coloquei o $ que faltava em algumas variáveis
     *  === Atualização 2 ===
     * Autor: John Hed
     * Date: 27/07/2017
     * Description: Adição do atributo  $imagemUsuario
     */
    class Usuario{

        // Atributos
        private $idUsuario;
        private $nomeUsuario;
		private $cpfUsuario;
		private $emailUsuario;
		private $senhaUsuario;
        private $idAsaasUsuario;
        private $tipoUsuario;

        // Método Construtor
        function __construct($idUsuario = null, $nomeUsuario = null, $cpfUsuario = null, $emailUsuario = null, $senhaUsuario = null, $idAsaasUsuario = null, $tipoUsuario = null){
            $this->idUsuario = $idUsuario;
            $this->nomeUsuario = $nomeUsuario;
			$this->cpfUsuario = $cpfUsuario;
			$this->emailUsuario = $emailUsuario;
			$this->senhaUsuario = $senhaUsuario;
			$this->idAsaasUsuario = $idAsaasUsuario;
            $this->tipoUsuario = $tipoUsuario;
        }

        // Métodos Getters
        function getIdUsuario(){
            return $this->idUsuario;
        }

        function getNomeUsuario(){
            return $this->nomeUsuario;
        }
		
        function getCpfUsuario(){
            return $this->cpfUsuario;
        }

        function getEmailUsuario(){
            return $this->emailUsuario;
        }
		
        function getSenhaUsuario(){
            return $this->senhaUsuario;
        }

        function getIdAsaasUsuario(){
            return $this->idAsaasUsuario;
        }

        function getTipoUsuario(){
            return $this->tipoUsuario;
        }

        // Métodos Setters
        function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }

        function setNomeUsuario($nomeUsuario){
            $this->nomeUsuario = $nomeUsuario;
        }
		
		function setCpfUsuario($cpfUsuario){
            $this->cpfUsuario = $cpfUsuario;
        }
		
		function setEmailUsuario($emailUsuario){
            $this->emailUsuario = $emailUsuario;
        }

		function setSexoUsuario($sexoUsuario){
            $this->sexoUsuario = $sexoUsuario;
        }
		
		function setSenhaUsuario($senhaUsuario){
            $this->senhaUsuario = $senhaUsuario;
        }

        public function setIdAsaasUsuario($idAsaasUsuario){
            $this->idAsaasUsuario = $idAsaasUsuario;
        }

        public function setTipoUsuario($tipoUsuario){
            $this->tipoUsuario = $tipoUsuario;
        }
    }
?>