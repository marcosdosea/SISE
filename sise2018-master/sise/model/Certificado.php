<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 13/07/2017
 * Time: 17:18
 */
    class Certificado
    {
        // Atributos
        private $idCertificado;
        private $chCertificado;
        private $statusCertificado;
        private $urlImagemCertificado;
        private $tipoCertificado;
        private $idEvento;

        // Método Construtor
        function __construct($idCertificado = null, $chCertificado = null, $statusCertificado = null, $urlImagemCertificado = null, $tipoCertificado = null, $idEvento = null) {

            $this->idCertificado = $idCertificado;
            $this->chCertificado = $chCertificado;
            $this->statusCertificado = $statusCertificado;
            $this->urlImagemCertificado = $urlImagemCertificado;
            $this->tipoCertificado = $tipoCertificado;
            $this->idEvento = $idEvento;
        }

        // Métodos Getters
        function getIdCertificado(){
            return $this->idCertificado;
        }

        function getChCertificado(){
            return $this->chCertificado;
        }

        function  getStatusCertificado(){
            return $this->statusCertificado;
        }

        function getTipoCertificado(){
            return $this->tipoCertificado;
        }

        function getUrlImagemCertificado(){
            return $this->urlImagemCertificado;
        }

        function getIdEvento(){
            return $this->idEvento;
        }

        // Métodos Setters
        function setIdCertificado($idCertificado){
            $this->idCertificado = $idCertificado;
        }

        function setChCertificado($chCertificado){
            $this->chCertificado = $chCertificado;
        }

        function setStatusCertificado($statusCertificado){
            $this->statusCertificado = $statusCertificado;
        }

        function setTipoCertificado($tipoCertificado){
            $this->tipoCertificado = $tipoCertificado;
        }

        function setUrlImagemCertificado($urlImagemCertificado){
            $this->urlImagemCertificado = $urlImagemCertificado;
        }

        function setIdEvento($idEvento){
            $this->idEvento = $idEvento;
        }
    }
?>