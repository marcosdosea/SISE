<?php
    /**
     * Autor: Daniel Lima
     * Date: 14/03/2017
     */

    require_once '../gerenciador/GerenciadorInscricaoEvento.php';

    $gerenciadorInscricaoEvento = new GerenciadorInscricaoEvento();
    $qntEventosInscritos = sizeOf($gerenciadorInscricaoEvento->obterTodosByIdUsuario($_SESSION['codigo']));
    require_once '../view/Menu/menu.php';