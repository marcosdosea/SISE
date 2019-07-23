<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 04/09/2017
 * Time: 16:35
 */

    require_once '../persistencia/PersistenciaQualidade.php';
    require_once '../model/Qualidade.php';

class GerenciadorQualidade{
    private $persistencia;

    function __construct(){
        $this->persistencia = new PersistenciaQualidade();
    }

    function inserir($Objeto){
        return $this->persistencia->inserir($Objeto);
    }

    function atualizar($Objeto){
        return $this->persistencia->atualizar($Objeto);
    }

    function remover($Objeto){
        return $this->persistencia->remover($Objeto);
    }

    function obterTodos(){
        return $this->persistencia->obterTodos();
    }

    function obterById($idObjeto){
        return $this->persistencia->obterById($idObjeto);
    }
}