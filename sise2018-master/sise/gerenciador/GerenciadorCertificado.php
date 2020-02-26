<?php
/**
 * Created by PhpStorm.
 * User: Rafael Silveira
 * Date: 19/07/2017
 * Time: 16:19
 */
    require_once '../persistencia/PersistenciaCertificado.php';
    require_once '../model/Certificado.php';

    class GerenciadorCertificado{
        private $persistencia;

        function __construct()
        {
            $this->persistencia = new PersistenciaCertificado();
        }

        function inserir(){
            return $this->persistencia->inserir();
        }

        function atualizar($idCertificado){
            return $this->persistencia->atualizar($idCertificado);
        }

        function remover($idCertificado){
            return $this->persistencia->remover($idCertificado);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obterById($idCertificado){
            return $this->persistencia->obterById($idCertificado);
        }
    function obterByIdEvento($idEventoCertificado){
            return $this->persistencia->obterByIdEvento($idEventoCertificado);
        }
    }
?>