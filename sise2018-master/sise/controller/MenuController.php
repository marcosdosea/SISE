<?php
    /**
     * Autor: Daniel Lima
     * Date: 14/03/2017
     */

    require_once '../gerenciador/GerenciadorInscricaoEvento.php';
	//require_once '../gerenciador/GerenciadorUsuaio.php'

    $gerenciadorInscricaoEvento = new GerenciadorInscricaoEvento();
	$qntEventosInscritos = $gerenciadorInscricaoEvento->obterTodosByIdUsuario($_SESSION['codigo']);
	if($qntEventosInscritos == null)
		$qntEventosInscritos = 0;
	else
		$qntEventosInscritos = sizeof($qntEventosInscritos);
	
    //$qntEventosInscritos = sizeOf($gerenciadorInscricaoEvento->obterTodosByIdUsuario($_SESSION['codigo']));
    //$gerenciadorUsuario = new GerenciadorUsuario();
	//$qntEventosInscritos = sizeOf($gerenciadorUsuario->obter($_SESSION['codigo']));
	require_once '../view/Menu/menu.php';
