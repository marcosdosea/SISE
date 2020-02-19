<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 04/09/2017
 * Time: 23:18
 */

class RecuperarSenha
{
    // Atributos
    private $idRecuperarSenha;
    private $token;
    private $dataRequisicao;
    private $dataValidade;
    private $utilizado;
    private $idUsuario;

    // Método Construtor
    function __construct($idRecuperarSenha = null, $token = null, $dataRequisicao = null, $dataValidade = null, $utilizado = null, $idUsuario = null){

        $this->idRecuperarSenha = $idRecuperarSenha;
        $this->token = $token;
        $this->dataRequisicao = $dataRequisicao;
        $this->dataValidade = $dataValidade;
        $this->utilizado = $utilizado;
        $this->idUsuario = $idUsuario;
    }


    // Metodos Geters
    public function getIdRecuperarSenha(){
        return $this->idRecuperarSenha;
    }

    public function getToken(){
        return $this->token;
    }

    public function getDataRequisicao(){
        return $this->dataRequisicao;
    }

    public function getDataValidade(){
        return $this->dataValidade;
    }

    public function getUtilizado(){
        return $this->utilizado;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    // Metodos Setters
    public function setIdRecuperarSenha($idRecuperarSenha){
        $this->idRecuperarSenha = $idRecuperarSenha;
    }

    public function setToken($token){
        $this->token = $token;
    }

    public function setDataRequisicao($dataRequisicao){
        $this->dataRequisicao = $dataRequisicao;
    }

    public function setDataValidade($dataValidade){
        $this->dataValidade = $dataValidade;
    }

    public function setUtilizado($utilizado){
        $this->utilizado = $utilizado;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
}