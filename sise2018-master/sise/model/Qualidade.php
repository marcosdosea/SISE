<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 04/09/2017
 * Time: 16:23
 */

class Qualidade
{
    // Atributos
    private $idQualidade;
    private $nomeQualidade;

    // Método Construtor
    function __construct($idQualidade = null, $nomeQualidade = null){
        $this->idQualidade = $idQualidade;
        $this->nomeQualidade = $nomeQualidade;
    }

    // Metodos Getters
    public function getIdQualidade(){
        return $this->idQualidade;
    }

    public function getNomeQualidade(){
        return $this->nomeQualidade;
    }


    // Metodos Setters
    public function setIdQualidade($idQualidade){
        $this->idQualidade = $idQualidade;
    }

    public function setNomeQualidade($nomeQualidade){
        $this->nomeQualidade = $nomeQualidade;
    }


}