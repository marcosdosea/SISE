<?php
/**
 * Created by PhpStorm.
 * User: Ednilson MCS
 * Date: 31/07/2017
 * Time: 16:14
 */

class InfoFrequencia
{
    // Atributos
    private $idInfoFrequencia;//não preciso
    private $diaInfo;//array
    private $quantInfoFrequencia;
    private $idEvento;
    // Método Construtor
    function __construct($idInfoFrequencia = null, $diaInfo = null, $quantInfoFrequencia = null, $idEvento = null)
    {
        $this->idInfoFrequencia = $idInfoFrequencia;
        $this->diaInfo = $diaInfo;
        $this->quantInfoFrequencia = $quantInfoFrequencia;
        $this->idEvento = $idEvento;
    }

    public function getIdInfoFrequencia()
    {
        return $this->idInfoFrequencia;
    }

    public function setIdInfoFrequencia($idInfoFrequencia)
    {
        $this->idInfoFrequencia = $idInfoFrequencia;
    }

    public function getDiaInfo()
    {
        return $this->diaInfo;
    }

    public function setDiaInfo($diaInfo)
    {
        $this->diaInfo = $diaInfo;
    }

    public function getQuantInfoFrequencia()
    {
        return $this->quantInfoFrequencia;
    }

    public function setQuantInfoFrequencia($quantInfoFrequencia)
    {
        $this->quantInfoFrequencia = $quantInfoFrequencia;
    }

    public function getIdEvento()
    {
        return $this->idEvento;
    }

    public function setIdEvento($idEvento)
    {
        $this->idEvento = $idEvento;
    }

}