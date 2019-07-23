<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 04/09/2017
 * Time: 14:14
 */

    require_once '../persistencia/PersistenciaInfoFrequencia.php';
    require_once '../model/InfoFrequencia.php';

class GerenciadorInfoFrequencia {
    private $persistencia;

    function __construct(){
        $this->persistencia = new PersistenciaInfoFrequencia();
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

    function obterQuantByDiaEvento($dia, $evento){
        return $this->persistencia->obterQuantByDiaEvento($dia, $evento);
    }
}