<?php
/**
 * Created by PhpStorm.
 * User: Rafael Silveira
 * Date: 17/07/2017
 * Time: 16:48
 */
class Frequencia{

    // Atributos
    private $idEventoFrequencia;
    private $dataHoraFrequencia;
    private $idUsuarioFrequencia;

    // Método Construtor
    function __construct($idEventoFrequencia=null, $dataHoraFrequencia=null, $idUsuarioFrequencia=null )
    {
        $this->idEventoFrequencia = $idEventoFrequencia;
        $this->dataHoraFrequencia = $dataHoraFrequencia;
        $this->idUsuarioFrequencia = $idUsuarioFrequencia;
    }

    // Método Getters
    function getidEventoFrequencia (){
        return $this->idEventoFrequencia;
    }

    function getdataHoraFrequencia (){
        return $this->dataHoraFrequencia;
    }

    function getidUsuarioFrequencia(){
        return $this->idUsuarioFrequencia;
    }

    // Método Setters
    function setidEventoFrequencia ($idEventoFrequencia){
        $this->idEventoFrequencia = $idEventoFrequencia;
    }

    function  setdataHoraFrequencia ($dataHoraFrequencia){
        $this->dataHoraFrequencia = $dataHoraFrequencia;
    }

    function setidUsuarioFrequencia ($idUsuarioFrequencia){
        $this->idUsuarioFrequencia = $idUsuarioFrequencia;
    }
}
?>