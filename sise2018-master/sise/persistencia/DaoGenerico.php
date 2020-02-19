<?php
    /**
     * Autor: Daniel Lima Oliveira
     * Date: 16/02/2017
     * Time: 20:08
     */
	interface DaoGenerico {
		function inserir($Objeto);
		function atualizar($Objeto);
		function remover($Objeto);
		function obterTodos();
		function obterById($IdObjeto);
	}
?>