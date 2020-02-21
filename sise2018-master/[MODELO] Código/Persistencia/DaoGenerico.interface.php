<?php
	interface DaoGenerico {
		function inserir($Objeto);
		function atualizar($Objeto);
		function remover($Objeto);
		function obterTodos();
		function obterById($IdObjeto);
	}
?>