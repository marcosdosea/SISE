<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 04/09/2017
 * Time: 23:37
 */

    require_once '../persistencia/PersistenciaRecuperarSenha.php';
    require_once '../model/RecuperarSenha.php';

class GerenciadorRecuperarSenha
{
    private $persistencia;
    // Validade de 1 dia

        function __construct(){
            $this->persistencia = new PersistenciaRecuperarSenha();
        }

        function adicionar($senha){
            $this->persistencia->inserir($senha);
        }

        function atualizar($senha){
            $this->persistencia->atualizar($senha);
        }

        function obterValidoByIdUser($idUsuario){
            return $this->persistencia->obterValidoByIdUser($idUsuario);
        }
}