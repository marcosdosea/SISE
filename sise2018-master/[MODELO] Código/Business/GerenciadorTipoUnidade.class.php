<?php
	require_once '../../Model/TipoUnidade.class.php';
	require_once '../../Persistencia/PersistenciaTipoUnidade.class.php';

	class GerenciadorTipoUnidade{
		private $persistencia;

		function __construct(){
			$this->persistencia = new PersistenciaTipoUnidade();
		}

		function adicionar(TipoUnidade $tipoUnidade){
			return $this->persistencia->inserir($tipoUnidade);
		}

		function atualizar(TipoUnidade $tipoUnidade){
			return $this->persistencia->atualizar($tipoUnidade);
		}

		function remover(TipoUnidade $tipoUnidade){
			return $this->persistencia->remover($tipoUnidade);
		}

		function obterTodos(){
			return $this->persistencia->obterTodos();
		}

		function obter($idTipoUnidade){
			return $this->persistencia->obterById($idTipoUnidade);
		}
	}
?>